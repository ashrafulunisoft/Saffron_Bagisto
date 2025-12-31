<?php

namespace App\Services;

use App\Models\PathaoOrder;
use App\Models\PathaoTrackingHistory;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * Pathao Order Service
 *
 * Service layer for handling automatic Pathao order creation when
 * admin creates a shipment with Pathao as the delivery partner.
 */
class PathaoOrderService
{
    /**
     * Pathao Service instance
     *
     * @var \App\Services\PathaoService
     */
    protected $pathaoService;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->pathaoService = new PathaoService();
    }

    /**
     * Create a Pathao order from a shipment
     *
     * @param \Webkul\Sales\Contracts\Shipment $shipment
     * @return array
     */
    public function createPathaoOrderFromShipment($shipment): array
    {
        try {
            $order = $shipment->order;

            Log::info('Creating Pathao Order from Shipment', [
                'order_id' => $order->id,
                'shipment_id' => $shipment->id,
                'carrier_code' => $shipment->carrier_code,
            ]);

            // Check if shipment qualifies for Pathao
            if (!$this->canCreatePathaoOrder($shipment)) {
                Log::warning('Shipment does not qualify for Pathao', [
                    'order_id' => $order->id,
                    'shipment_id' => $shipment->id,
                ]);
                return [
                    'success' => false,
                    'message' => 'Shipment does not qualify for Pathao tracking',
                ];
            }

            // Prepare Pathao order data
            $pathaoOrderData = $this->preparePathaoOrderData($order);

            // Create order via Pathao API
            $apiResponse = $this->pathaoService->createOrder($pathaoOrderData);

            if (!$apiResponse['success']) {
                Log::error('Failed to create Pathao order', [
                    'order_id' => $order->id,
                    'shipment_id' => $shipment->id,
                    'error' => $apiResponse['error'] ?? 'Unknown error',
                ]);

                return [
                    'success' => false,
                    'message' => 'Failed to create Pathao order',
                    'error' => $apiResponse['error'] ?? 'Unknown error',
                ];
            }

            $pathaoData = $apiResponse['data'];
            $consignmentId = $pathaoData['data']['consignment_id'] ?? null;

            if (!$consignmentId) {
                Log::error('Pathao API response missing consignment_id', [
                    'order_id' => $order->id,
                    'shipment_id' => $shipment->id,
                    'response' => $pathaoData,
                ]);

                return [
                    'success' => false,
                    'message' => 'Pathao API response missing consignment_id',
                ];
            }

            // Store Pathao order in database
            $pathaoOrder = PathaoOrder::create([
                'order_id' => $order->id,
                'consignment_id' => $consignmentId,
                'merchant_order_id' => (string) $order->id,
                'store_id' => config('pathao.default_store_id'),
                'order_status' => $pathaoData['data']['order_status'] ?? 'Pending',
                'order_status_slug' => $pathaoData['data']['order_status_slug'] ?? 'pending',
                'delivery_fee' => $pathaoData['data']['delivery_fee'] ?? 0,
                'recipient_name' => $pathaoOrderData['recipient_name'],
                'recipient_phone' => $pathaoOrderData['recipient_phone'],
                'recipient_address' => $pathaoOrderData['recipient_address'],
                'tracking_data' => $pathaoData,
            ]);

            // Update order with Pathao tracking info
            $order->update([
                'pathao_consignment_id' => $consignmentId,
                'pathao_tracking_enabled' => true,
            ]);

            // Update shipment with consignment ID
            $shipment->update([
                'track_number' => $consignmentId,
            ]);

            Log::info('Pathao Order Created Successfully', [
                'order_id' => $order->id,
                'shipment_id' => $shipment->id,
                'consignment_id' => $consignmentId,
                'pathao_order_id' => $pathaoOrder->id,
            ]);

            return [
                'success' => true,
                'message' => 'Pathao order created successfully',
                'consignment_id' => $consignmentId,
                'pathao_order_id' => $pathaoOrder->id,
                'data' => $pathaoData,
            ];

        } catch (Exception $e) {
            Log::error('Pathao Order Creation Exception', [
                'shipment_id' => $shipment->id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'message' => 'Failed to create Pathao order',
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Update Pathao tracking data from API
     *
     * @param \Webkul\Sales\Contracts\Order $order
     * @return array
     */
    public function updatePathaoTracking($order): array
    {
        try {
            if (!$order->pathao_consignment_id) {
                return [
                    'success' => false,
                    'message' => 'No Pathao consignment ID found for this order',
                ];
            }

            Log::info('Updating Pathao Tracking', [
                'order_id' => $order->id,
                'consignment_id' => $order->pathao_consignment_id,
            ]);

            // Get tracking data from Pathao API
            $apiResponse = $this->pathaoService->trackOrder($order->pathao_consignment_id);

            if (!$apiResponse['success']) {
                Log::error('Failed to get Pathao tracking data', [
                    'order_id' => $order->id,
                    'consignment_id' => $order->pathao_consignment_id,
                    'error' => $apiResponse['error'] ?? 'Unknown error',
                ]);

                return [
                    'success' => false,
                    'message' => 'Failed to get Pathao tracking data',
                    'error' => $apiResponse['error'] ?? 'Unknown error',
                ];
            }

            $trackingData = $apiResponse['data'];

            // Find Pathao order
            $pathaoOrder = PathaoOrder::where('order_id', $order->id)->first();

            if (!$pathaoOrder) {
                Log::warning('Pathao order not found', ['order_id' => $order->id]);

                return [
                    'success' => false,
                    'message' => 'Pathao order not found',
                ];
            }

            // Update Pathao order with new tracking data
            $pathaoOrder->updateTracking($trackingData);

            // Store tracking history
            if (isset($trackingData['tracking_history']) && is_array($trackingData['tracking_history'])) {
                foreach ($trackingData['tracking_history'] as $historyItem) {
                    PathaoTrackingHistory::create([
                        'pathao_order_id' => $pathaoOrder->id,
                        'status' => $historyItem['status'] ?? null,
                        'status_slug' => $historyItem['status_slug'] ?? null,
                        'latitude' => $historyItem['latitude'] ?? null,
                        'longitude' => $historyItem['longitude'] ?? null,
                        'location_name' => $historyItem['location_name'] ?? null,
                        'remarks' => $historyItem['remarks'] ?? null,
                        'timestamp' => $historyItem['timestamp'] ?? now(),
                    ]);
                }
            }

            Log::info('Pathao Tracking Updated Successfully', [
                'order_id' => $order->id,
                'consignment_id' => $order->pathao_consignment_id,
                'status' => $pathaoOrder->order_status,
            ]);

            return [
                'success' => true,
                'message' => 'Pathao tracking updated successfully',
                'data' => $trackingData,
            ];

        } catch (Exception $e) {
            Log::error('Pathao Tracking Update Exception', [
                'order_id' => $order->id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'message' => 'Failed to update Pathao tracking',
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Check if a shipment qualifies for Pathao tracking
     *
     * @param \Webkul\Sales\Contracts\Shipment $shipment
     * @return bool
     */
    public function canCreatePathaoOrder($shipment): bool
    {
        $order = $shipment->order;

        // Check if Pathao is globally enabled
        if (!config('pathao.enabled', false)) {
            return false;
        }

        // Check if carrier is Pathao
        if ($shipment->carrier_code !== 'pathao') {
            return false;
        }

        // Check if order already has Pathao tracking
        if ($order->pathao_consignment_id) {
            return false;
        }

        // Check if order has shipping address
        if (!$order->shipping_address) {
            return false;
        }

        // Check if order has required fields
        if (empty($order->shipping_address->phone) || empty($order->shipping_address->address)) {
            return false;
        }

        // Check if order has items
        if ($order->items->isEmpty()) {
            return false;
        }

        return true;
    }

    /**
     * Prepare Pathao order data from order
     *
     * @param \Webkul\Sales\Contracts\Order $order
     * @return array
     */
    protected function preparePathaoOrderData($order): array
    {
        $shippingAddress = $order->shipping_address;

        // Calculate total weight from order items (in kg)
        $totalWeight = 0;
        foreach ($order->items as $item) {
            if (isset($item->weight)) {
                $totalWeight += $item->weight;
            }
        }
        $totalWeightKg = $totalWeight / 1000; // Convert grams to kg

        // Build full address
        $addressParts = array_filter([
            $shippingAddress->address ?? '',
            $shippingAddress->city ?? '',
            $shippingAddress->state ?? '',
            $shippingAddress->postcode ?? '',
            $shippingAddress->country ?? '',
        ]);

        $fullAddress = implode(', ', $addressParts);

        return [
            'store_id' => config('pathao.default_store_id'),
            'merchant_order_id' => (string) $order->id,
            'recipient_name' => $shippingAddress->name ?? $order->customer_first_name . ' ' . $order->customer_last_name,
            'recipient_phone' => $shippingAddress->phone,
            'recipient_address' => $fullAddress,
            'delivery_type' => config('pathao.delivery_type', 48), // Normal Delivery
            'item_type' => config('pathao.item_type', 2), // Parcel
            'item_quantity' => $order->items->count(),
            'item_weight' => max(0.1, $totalWeightKg), // Minimum 0.1 kg
            'amount_to_collect' => (float) $order->grand_total,
        ];
    }

    /**
     * Retry creating a Pathao order for a failed shipment
     *
     * @param \Webkul\Sales\Contracts\Shipment $shipment
     * @return array
     */
    public function retryPathaoOrder($shipment): array
    {
        try {
            $order = $shipment->order;

            Log::info('Retrying Pathao Order Creation', [
                'order_id' => $order->id,
                'shipment_id' => $shipment->id,
            ]);

            // Delete existing failed Pathao order if any
            $existingPathaoOrder = PathaoOrder::where('order_id', $order->id)->first();
            if ($existingPathaoOrder) {
                $existingPathaoOrder->delete();
            }

            // Clear consignment ID from order
            $order->update([
                'pathao_consignment_id' => null,
                'pathao_tracking_enabled' => false,
            ]);

            // Clear track number from shipment
            $shipment->update([
                'track_number' => null,
            ]);

            // Create new Pathao order
            return $this->createPathaoOrderFromShipment($shipment);

        } catch (Exception $e) {
            Log::error('Pathao Order Retry Exception', [
                'shipment_id' => $shipment->id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'message' => 'Failed to retry Pathao order creation',
                'error' => $e->getMessage(),
            ];
        }
    }
}
