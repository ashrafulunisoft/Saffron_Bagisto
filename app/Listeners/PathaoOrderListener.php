<?php

namespace App\Listeners;

use App\Models\PathaoOrder;
use App\Services\PathaoOrderService;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * Pathao Order Listener
 *
 * Listens for shipment creation events and automatically creates
 * Pathao orders when Pathao is selected as the delivery partner.
 */
class PathaoOrderListener
{
    /**
     * Pathao Order Service instance
     *
     * @var \App\Services\PathaoOrderService
     */
    protected $pathaoOrderService;

    /**
     * Create a new listener instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->pathaoOrderService = new PathaoOrderService();
    }

    /**
     * Handle the shipment created event.
     *
     * This method is called when a shipment is created.
     * It checks if Pathao is the selected carrier and creates
     * a Pathao order automatically.
     *
     * @param  \Webkul\Sales\Contracts\Shipment  $shipment
     * @return void
     */
    public function afterShipmentCreated($shipment)
    {
        try {
            // Log shipment details with comprehensive information
            Log::info('PathaoOrderListener: Shipment created event received', [
                'shipment_id' => $shipment->id,
                'order_id' => $shipment->order_id,
                'carrier_code' => $shipment->carrier_code,
                'carrier_title' => $shipment->carrier_title,
                'track_number' => $shipment->track_number,
                'pathao_enabled' => config('pathao.enabled', false),
                'pathao_base_url' => config('pathao.base_url'),
                'pathao_client_id' => config('pathao.client_id') ? 'set' : 'not set',
            ]);

            // Check if Pathao is enabled globally
            if (!config('pathao.enabled', false)) {
                Log::info('PathaoOrderListener: Pathao is not enabled globally', [
                    'shipment_id' => $shipment->id,
                    'reason' => 'PATHAO_ENABLED config is false or not set',
                ]);
                return;
            }

            // Check if carrier_code is set and is pathao (handle null case)
            if (empty($shipment->carrier_code)) {
                Log::info('PathaoOrderListener: Carrier code is empty', [
                    'shipment_id' => $shipment->id,
                    'carrier_code' => $shipment->carrier_code,
                    'carrier_title' => $shipment->carrier_title,
                    'reason' => 'carrier_code is null or empty. Please select Pathao as the carrier when creating the shipment.',
                ]);
                return;
            }

            if ($shipment->carrier_code !== 'pathao') {
                Log::info('PathaoOrderListener: Carrier is not Pathao', [
                    'shipment_id' => $shipment->id,
                    'carrier_code' => $shipment->carrier_code,
                    'carrier_title' => $shipment->carrier_title,
                    'reason' => 'Only shipments with carrier_code="pathao" will create Pathao orders',
                ]);
                return;
            }

            // Check if Pathao order was already created for this order
            $pathaoOrder = PathaoOrder::where('order_id', $shipment->order_id)->first();
            if ($pathaoOrder) {
                Log::info('PathaoOrderListener: Pathao order already exists for this order', [
                    'shipment_id' => $shipment->id,
                    'order_id' => $shipment->order_id,
                    'pathao_order_id' => $pathaoOrder->id,
                    'consignment_id' => $pathaoOrder->consignment_id,
                    'reason' => 'Skipping duplicate Pathao order creation'
                ]);
                return;
            }

            // Also check if order already has pathao_consignment_id
            if ($shipment->order && $shipment->order->pathao_consignment_id) {
                Log::info('PathaoOrderListener: Order already has pathao_consignment_id', [
                    'shipment_id' => $shipment->id,
                    'order_id' => $shipment->order->id,
                    'consignment_id' => $shipment->order->pathao_consignment_id,
                    'reason' => 'Skipping - Pathao order already created'
                ]);
                return;
            }

            // Log attempt to create Pathao order
            Log::info('PathaoOrderListener: Attempting to create Pathao order', [
                'shipment_id' => $shipment->id,
                'order_id' => $shipment->order_id,
            ]);

            // Create Pathao order
            $result = $this->pathaoOrderService->createPathaoOrderFromShipment($shipment);

            if ($result['success']) {
                Log::info('PathaoOrderListener: Pathao order created successfully', [
                    'shipment_id' => $shipment->id,
                    'order_id' => $shipment->order_id,
                    'consignment_id' => $result['consignment_id'] ?? null,
                    'track_number' => $result['track_number'] ?? null,
                ]);
            } else {
                Log::warning('PathaoOrderListener: Failed to create Pathao order', [
                    'shipment_id' => $shipment->id,
                    'order_id' => $shipment->order_id,
                    'error' => $result['message'] ?? 'Unknown error',
                    'error_details' => $result['error_details'] ?? null,
                ]);
            }

        } catch (Exception $e) {
            Log::error('PathaoOrderListener Exception', [
                'shipment_id' => $shipment->id ?? null,
                'order_id' => $shipment->order_id ?? null,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Don't throw exception - we don't want to break the shipment creation
            // Log the error and allow the shipment to be created
        }
    }
}