<?php

namespace Ashraful\OnlinePayment\Payment;

use Webkul\Payment\Payment\Payment;

class OnlinePayment extends Payment
{
    protected $code = 'online_payment';

    public function getRedirectUrl()
    {
        return route('online.payment.redirect');
    }

    public function getPaymentDetails()
    {
        $gateway = core()->getConfigData('sales.paymentmethods.online_payment.gateway');

        return [
            'gateway' => $gateway,
            'title' => $this->getGatewayTitle($gateway),
            'description' => $this->getGatewayDescription($gateway)
        ];
    }

    private function getGatewayTitle($gateway)
    {
        $titles = [
            'sslcommerz' => 'SSLCommerz',
            'bkash' => 'bKash',
            'nagad' => 'Nagad',
            'rocket' => 'Rocket'
        ];

        return $titles[$gateway] ?? 'Online Payment';
    }

    private function getGatewayDescription($gateway)
    {
        $descriptions = [
            'sslcommerz' => 'Pay securely with SSLCommerz',
            'bkash' => 'Pay with bKash mobile banking',
            'nagad' => 'Pay with Nagad mobile banking',
            'rocket' => 'Pay with Rocket mobile banking'
        ];

        return $descriptions[$gateway] ?? 'Pay with online payment gateway';
    }

    public function isAvailable()
    {
        $gateway = core()->getConfigData('sales.paymentmethods.online_payment.gateway');

        if (!$gateway) {
            return false;
        }

        // Check if gateway credentials are configured
        switch ($gateway) {
            case 'sslcommerz':
                return core()->getConfigData('sales.paymentmethods.online_payment.ssl_store_id') &&
                       core()->getConfigData('sales.paymentmethods.online_payment.ssl_password');

            case 'bkash':
                return core()->getConfigData('sales.paymentmethods.online_payment.bkash_key') &&
                       core()->getConfigData('sales.paymentmethods.online_payment.bkash_secret');

            case 'nagad':
                return core()->getConfigData('sales.paymentmethods.online_payment.nagad_merchant');

            case 'rocket':
                return core()->getConfigData('sales.paymentmethods.online_payment.rocket_merchant') &&
                       core()->getConfigData('sales.paymentmethods.online_payment.rocket_key');

            default:
                return false;
        }
    }

    /**
     * Get payment method additional information.
     *
     * @return array
     */
    public function getAdditionalDetails()
    {
        $gateway = core()->getConfigData('sales.paymentmethods.online_payment.gateway');

        return [
            'title' => 'Selected Gateway',
            'value' => $this->getGatewayTitle($gateway),
        ];
    }
}
