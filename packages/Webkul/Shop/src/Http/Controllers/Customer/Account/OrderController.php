<?php

namespace Webkul\Shop\Http\Controllers\Customer\Account;

use App\Services\PathaoService;
use Webkul\Checkout\Facades\Cart;
use Webkul\Core\Traits\PDFHandler;
use Webkul\Sales\Repositories\InvoiceRepository;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Shop\DataGrids\OrderDataGrid;
use Webkul\Shop\Http\Controllers\Controller;

class OrderController extends Controller
{
    use PDFHandler;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected OrderRepository $orderRepository,
        protected InvoiceRepository $invoiceRepository,
        protected PathaoService $pathaoService
    ) {}

    /**
     * Display a listing of resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return datagrid(OrderDataGrid::class)->process();
        }

        return view('shop::customers.account.orders.index');
    }

    /**
     * Show view for specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $order = $this->orderRepository->findOneWhere([
            'customer_id' => auth()->guard('customer')->id(),
            'id'          => $id,
        ]);

        abort_if(! $order, 404);

        return view('shop::customers.account.orders.view', compact('order'));
    }

    /**
     * Reorder action for specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reorder(int $id)
    {
        $order = $this->orderRepository->findOrFail($id);

        foreach ($order->items as $item) {
            try {
                Cart::addProduct($item->product, $item->additional);
            } catch (\Exception $e) {
                // do nothing
            }
        }

        return redirect()->route('shop.checkout.cart.index');
    }

    /**
     * Print and download for specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printInvoice($id)
    {
        $invoice = $this->invoiceRepository->where('id', $id)
            ->whereHas('order', function ($query) {
                $query->where('customer_id', auth()->guard('customer')->id());
            })
            ->firstOrFail();

        return $this->downloadPDF(
            view('shop::customers.account.orders.pdf', compact('invoice'))->render(),
            'invoice-'.$invoice->created_at->format('d-m-Y')
        );
    }

    /**
     * Track order with live location.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */


    public function track($id)
    {
        $order = $this->orderRepository->findOneWhere([
            'customer_id' => auth()->guard('customer')->id(),
            'id'          => $id,
        ]);

        abort_if(! $order, 404);

        // Initialize the PathaoService
        $service = app(PathaoService::class);

        // Initialize courier status as null
        $courier_status = null;

        // dd($order->pathao_consignment_id);

        // Check if consignment_id exists
        if ($order->pathao_consignment_id) {
            // Fetch order information using getOrderInfo() from PathaoService
            $result = $service->getOrderInfo($order->pathao_consignment_id);

            // dd($result);

            // ---------------------------------
            // array:3 [▼ // packages/Webkul/Shop/src/Http/Controllers/Customer/Account/OrderController.php:130
            // "success" => true
            // "data" => array:3 [▼
            //     "type" => "success"
            //     "code" => 200
            //     "data" => array:6 [▼
            //     "consignment_id" => "DT311225JEPFQS"
            //     "invoice_id" => null
            //     "merchant_order_id" => "16"
            //     "order_status" => "Pending"
            //     "order_status_slug" => "pending"
            //     "updated_at" => "2025-12-31 16:19:13"
            //     ]
            // ]
            // "message" => "Request successful"
            // ]
            // ---------------------------------

            // Check if the response is successful
            if ($result['success']) {
                // Use isset() to check if 'order_status' exists in the response
                if (isset($result['data']['data']['order_status'])) {
                    // Extract courier status from the result
                    $courier_status = $result['data']['data']['order_status'];
                } else {
                    // Log or handle the case where 'order_status' is missing
                    \Log::warning('Order status missing from Pathao response at data.data.order_status', ['consignment_id' => $order->pathao_consignment_id]);
                    $courier_status = 'unknown';  // Default value
                }
            } else {
                // Log if Pathao API request fails
                \Log::error('Failed to fetch order info from Pathao', [
                    'consignment_id' => $order->pathao_consignment_id,
                    'message' => $result['message'] ?? 'No message available'
                ]);
            }
        }

        // dd($courier_status); //" Accepted,  Picked,  In Transit,  Out for Delivery,  Delivered " or null , 'In Transit', 'Out For Delivery', 'Delivered'

        // Initialize location variables
        $shop_location = null;
        $liveGeoLocation = null;



        // Handle courier status and location logic
        if (in_array($courier_status, ['Pending','Accepted','Picked'])) {

            $shop_location = [
                'latitude' => env('SHOP_LATITUDE', 23.8103),
                'longitude' => env('SHOP_LONGITUDE', 90.4125)
            ];
            // dd($shop_location);
        } elseif (in_array($courier_status, ['In Transit', 'Out For Delivery', 'Delivered'])) {

            // Get city name, zone name, and area name
            $cityName = $order->shipping_address->city ?? null;
            $zoneName = $order->shipping_address->state ?? null;
            $areaName = null; // Area is typically not in standard address

            // dd ($cityName, $zoneName, $areaName);

            // Try to get geolocation data using location names
            if ($cityName || $zoneName) {
                // Build address string for geocoding
                $addressParts = array_filter([$cityName, $zoneName]);
                $address = implode(', ', $addressParts);

                // Get coordinates using Nominatim (OpenStreetMap) directly
                $coordinates = $this->getCoordinatesFromAddress($address);

                if ($coordinates) {
                    $liveGeoLocation = [
                        'latitude' => $coordinates['lat'],
                        'longitude' => $coordinates['lng'],
                        'city_name' => $cityName,
                        'zone_name' => $zoneName,
                        'area_name' => $areaName,
                        'address' => $address,
                    ];
                }
            }
            else {
                $liveGeoLocation =  [
                'latitude' => env('SHOP_LATITUDE', 23.8103),
                'longitude' => env('SHOP_LONGITUDE', 90.4125)
            ];
            }
        }

        // dd($shop_location, $liveGeoLocation); // Debug liveGeoLocation

        // dd($order, $courier_status, $shop_location, $liveGeoLocation); // Debug order, courier_status, shop_location, liveGeoLocation

        return view('shop::customers.account.orders.track', compact('order', 'courier_status', 'liveGeoLocation', 'shop_location'));
    }

    //------------------------------------------------
    // public function track($id)
    // {
    //     $order = $this->orderRepository->findOneWhere([
    //         'customer_id' => auth()->guard('customer')->id(),
    //         'id'          => $id,
    //     ]);

    //     abort_if(! $order, 404);

    //     // Fetch Pathao order status from the database
    //     $courier_status = null;
    //     $pathaoOrder = \App\Models\PathaoOrder::where('consignment_id', $order->pathao_consignment_id)->first();

    //     if ($pathaoOrder) {
    //         $courier_status = $pathaoOrder->order_status ?? 'N/A';
    //     }

    //     // dd($courier_status); // Debug the courier status

    //     // Initialize location variables
    //     $shop_location = null;
    //     $liveGeoLocation = null;

    //     if (in_array($courier_status, ['pending', 'picked'])) {
    //         $shop_location = [
    //             'latitude' => env('SHOP_LATITUDE', 23.8103),
    //             'longitude' => env('SHOP_LONGITUDE', 90.4125)
    //         ];
    //     } elseif (in_array($courier_status, ['transit', 'out for delivery', 'delivered'])) {
    //         $liveGeoLocation = $order->shipping_address
    //             ? [
    //                 'latitude' => $order->shipping_address->latitude,
    //                 'longitude' => $order->shipping_address->longitude,
    //                 'address' => $order->shipping_address->address
    //             ]
    //             : null;
    //     }

    //     dd($order, $courier_status, $shop_location, $liveGeoLocation); // Debug here

    //     return view('shop::customers.account.orders.track', compact('order', 'courier_status', 'liveGeoLocation', 'shop_location'));
    // }


    //previous function : _______________________________________________
    // public function track($id)
    // {
    //     $order = $this->orderRepository->findOneWhere([
    //         'customer_id' => auth()->guard('customer')->id(),
    //         'id'          => $id,
    //     ]);

    //     abort_if(! $order, 404);

    //     dd($order);

    //     // follow my instructions: __________________

    //     // here use function from  PathaoService.php to find the order_status and save it to $courier_status, if getting error, set $courier_status to null;

    //     // if courier_status is not null/pending/picked/, then show the shop_location from .env variable set the shop location langitude and latitude value.

    //     // if courier_staus is transit/out for delivery/delivered then show the live location as customer address location langitude and latitude value

    //     // in the view show the courier_status and live location

    //     // Initialize live geolocation data
    //     $liveGeoLocation = null;

    //     // Check if order has Pathao tracking enabled and has a shipping address
    //     if ($order->pathao_tracking_enabled && $order->shipping_address) {
    //         // Extract location names from shipping address
    //         $cityName = $order->shipping_address->city ?? null;
    //         $zoneName = $order->shipping_address->state ?? null;
    //         $areaName = null; // Area is typically not in standard address

    //         // dd ($cityName, $zoneName, $areaName);

    //         // Try to get geolocation data using location names
    //         if ($cityName || $zoneName) {
    //             // Build address string for geocoding
    //             $addressParts = array_filter([$cityName, $zoneName]);
    //             $address = implode(', ', $addressParts);

    //             // Get coordinates using Nominatim (OpenStreetMap) directly
    //             $coordinates = $this->getCoordinatesFromAddress($address);

    //             if ($coordinates) {
    //                 $liveGeoLocation = [
    //                     'latitude' => $coordinates['lat'],
    //                     'longitude' => $coordinates['lng'],
    //                     'city_name' => $cityName,
    //                     'zone_name' => $zoneName,
    //                     'area_name' => $areaName,
    //                     'address' => $address,
    //                 ];
    //             }
    //         }
    //     }

    //     // dd($order);
    //     // dd($liveGeoLocation);
    //     // dd($order, $liveGeoLocation);

    //     return view('shop::customers.account.orders.track', compact('order', 'liveGeoLocation'));
    // }

    /**
     * Get coordinates from address using Nominatim (OpenStreetMap) Geocoding API
     *
     * @param string $address
     * @return array|null
     */
    private function getCoordinatesFromAddress(string $address): ?array
    {
        try {
            if (empty($address)) {
                return null;
            }

            $url = 'https://nominatim.openstreetmap.org/search';
            $response = \Illuminate\Support\Facades\Http::timeout(10)
                ->withHeaders([
                    'User-Agent' => 'Saffron-Backend/1.0',
                    'Accept' => 'application/json',
                ])
                ->get($url, [
                    'q' => $address,
                    'format' => 'json',
                    'limit' => 1,
                ]);

            if (!$response->successful()) {
                \Illuminate\Support\Facades\Log::error('Nominatim Geocoding API Failed', [
                    'address' => $address,
                    'status' => $response->status(),
                ]);
                return null;
            }

            $data = $response->json();

            if (empty($data) || !is_array($data)) {
                return null;
            }

            $result = $data[0];

            if (!isset($result['lat']) || !isset($result['lon'])) {
                return null;
            }

            return [
                'lat' => (float) $result['lat'],
                'lng' => (float) $result['lon'],
            ];

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Nominatim Geocoding Exception', [
                'address' => $address,
                'message' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Cancel action for specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $customer = auth()->guard('customer')->user();

        /* find by order id in customer's order */
        $order = $customer->orders()->find($id);

        /* if order id not found then process should be aborted with 404 page */
        if (! $order) {
            abort(404);
        }

        $result = $this->orderRepository->cancel($order);

        if ($result) {
            session()->flash('success', trans('shop::app.customers.account.orders.view.cancel-success', ['name' => trans('admin::app.customers.account.orders.order')]));
        } else {
            session()->flash('error', trans('shop::app.customers.account.orders.view.cancel-error', ['name' => trans('admin::app.customers.account.orders.order')]));
        }

        return redirect()->back();
    }
}