<?php

namespace Webkul\Admin\Http\Controllers\Sales;

use App\Services\PathaoOrderService;
use Illuminate\Support\Facades\Log;
use Webkul\Admin\DataGrids\Sales\OrderShipmentDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\ShipmentRepository;

class ShipmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected OrderRepository $orderRepository,
        protected OrderItemRepository $orderItemRepository,
        protected ShipmentRepository $shipmentRepository,
        protected PathaoOrderService $pathaoOrderService
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return datagrid(OrderShipmentDataGrid::class)->process();
        }

        return view('admin::sales.shipments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(int $orderId)
    {
        $order = $this->orderRepository->findOrFail($orderId);

        if (! $order->channel || ! $order->canShip()) {
            session()->flash('error', trans('admin::app.sales.shipments.create.creation-error'));

            return redirect()->back();
        }

        return view('admin::sales.shipments.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(int $orderId)
    {
        $order = $this->orderRepository->findOrFail($orderId);

        if (! $order->canShip()) {
            session()->flash('error', trans('admin::app.sales.shipments.create.order-error'));

            return redirect()->back();
        }

        $this->validate(request(), [
            'shipment.source'    => 'required',
            'shipment.items.*.*' => 'required|numeric|min:0',
        ]);

        $data = request()->only(['shipment']);

        if (! $this->isInventoryValidate($data)) {
            session()->flash('error', trans('admin::app.sales.shipments.create.quantity-invalid'));

            return redirect()->back();
        }

        $shipment = $this->shipmentRepository->create(array_merge($data, [
            'order_id' => $orderId,
        ]));

        // Check if Pathao order should be created
        $carrierCode = $data['shipment']['carrier_code'] ?? null;
        $source = $data['shipment']['source'] ?? null;

        // Log shipment courier update by admin
        Log::info('Shipment courier updated by admin', [
            'shipment_id' => $shipment->id,
            'order_id' => $shipment->order_id,
            'carrier_code' => $carrierCode,
            'source' => $source
        ]);

        if ($carrierCode === 'pathao' && $source === 'default') {
            // Log Pathao order creation initiation
            Log::info('Pathao order creation initiated', [
                'shipment_id' => $shipment->id,
                'order_id' => $shipment->order_id,
                'carrier_code' => $carrierCode,
                'source' => $source
            ]);

            // Create Pathao order
            $pathaoResult = $this->pathaoOrderService->createPathaoOrderFromShipment($shipment);

            if (!$pathaoResult['success']) {
                // Log Pathao order creation failure
                Log::error('Pathao order creation failed', [
                    'shipment_id' => $shipment->id,
                    'order_id' => $shipment->order_id,
                    'error' => $pathaoResult['message'] ?? 'Unknown error'
                ]);

                session()->flash('error', $pathaoResult['message'] ?? 'Failed to create Pathao order');

                return redirect()->back();
            }

            // Log Pathao order creation success
            Log::info('Pathao order created successfully', [
                'shipment_id' => $shipment->id,
                'order_id' => $shipment->order_id,
                'pathao_consignment_id' => $pathaoResult['consignment_id'] ?? null,
                'pathao_order_id' => $pathaoResult['pathao_order_id'] ?? null
            ]);
        }

        session()->flash('success', trans('admin::app.sales.shipments.create.success'));

        return redirect()->route('admin.sales.orders.view', $orderId);
    }

    /**
     * Checks if requested quantity available or not.
     *
     * @param  array  $data
     * @return bool
     */
    public function isInventoryValidate(&$data)
    {
        if (! isset($data['shipment']['items'])) {
            return;
        }

        $valid = false;

        $inventorySourceId = $data['shipment']['source'];

        foreach ($data['shipment']['items'] as $itemId => $inventorySource) {
            $qty = $inventorySource[$inventorySourceId];

            if ((int) $qty) {
                $orderItem = $this->orderItemRepository->find($itemId);

                if ($orderItem->qty_to_ship < $qty) {
                    return false;
                }

                if ($orderItem->getTypeInstance()->isComposite()) {
                    foreach ($orderItem->children as $child) {
                        if (! $child->qty_ordered) {
                            continue;
                        }

                        $finalQty = ($child->qty_ordered / $orderItem->qty_ordered) * $qty;

                        $availableQty = $child->product->inventories()
                            ->where('inventory_source_id', $inventorySourceId)
                            ->sum('qty');

                        if (
                            $child->qty_to_ship < $finalQty
                            || $availableQty < $finalQty
                        ) {
                            return false;
                        }
                    }
                } else {
                    $availableQty = $orderItem->product->inventories()
                        ->where('inventory_source_id', $inventorySourceId)
                        ->sum('qty');

                    if (
                        $orderItem->qty_to_ship < $qty
                        || $availableQty < $qty
                    ) {
                        return false;
                    }
                }

                $valid = true;
            } else {
                unset($data['shipment']['items'][$itemId]);
            }
        }

        return $valid;
    }

    /**
     * Show the view for the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function view(int $id)
    {
        $shipment = $this->shipmentRepository->findOrFail($id);

        return view('admin::sales.shipments.view', compact('shipment'));
    }
}
