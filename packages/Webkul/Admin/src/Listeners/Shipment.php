<?php

namespace Webkul\Admin\Listeners;

use Webkul\Admin\Mail\Order\InventorySourceNotification;
use Webkul\Admin\Mail\Order\ShippedNotification;
use Webkul\Admin\Services\SmsService;
use Webkul\Sales\Contracts\Shipment as ShipmentContract;

class Shipment extends Base
{
    /**
     * After order is created
     *
     * @return void
     */
    public function afterCreated(ShipmentContract $shipment)
    {
        try {
            if (core()->getConfigData('emails.general.notifications.emails.general.notifications.new_shipment_mail_to_admin')) {
                $this->prepareMail($shipment, new ShippedNotification($shipment));
            }

            // Send SMS notification for shipment
            if ($shipment->order->customer_phone) {
                $smsMessage = "Dear {$shipment->order->customer_name}, your order #{$shipment->order->increment_id} has been shipped. Tracking: {$shipment->tracking_number}. Thank you for shopping with us!";
                $smsService = new SmsService();
                $smsService->sendSms($shipment->order->customer_phone, $smsMessage);
            }

            if (core()->getConfigData('emails.general.notifications.emails.general.notifications.new_inventory_source')) {
                $this->prepareMail($shipment, new InventorySourceNotification($shipment));
            }
        } catch (\Exception $e) {
            report($e);
        }
    }
}
