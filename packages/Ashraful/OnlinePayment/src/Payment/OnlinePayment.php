<?php

namespace Ashraful\OnlinePayment\Payment;

use Webkul\Payment\Payment\Payment;
use Illuminate\Support\Facades\Storage;

class OnlinePayment extends Payment
{
    protected $code = 'online_payment';

    public function getRedirectUrl()
    {
        return route('online.payment.redirect');
    }

    /**
     * Is available.
     *
     * @return bool
     */
    public function isAvailable()
    {
        // Always return true to allow payment method selection
        // Credential validation will happen during actual payment processing
        return true;
    }

    /**
     * Get payment method image.
     *
     * @return array
     */
    public function getImage()
    {
        $url = $this->getConfigData('image');

        return $url ? Storage::url($url) : null;
    }

    /**
     * Get payment method sort order.
     *
     * @return string
     */
    public function getSortOrder()
    {
        return $this->getConfigData('sort');
    }

    /**
     * Get payment method additional information.
     *
     * @return array
     */
    public function getAdditionalDetails()
    {
        $gateway = core()->getConfigData('payment_methods.online_payment.gateway');

        return [
            'title' => 'Selected Gateway',
            'value' => $this->getGatewayTitle($gateway),
        ];
    }

    public function getPaymentDetails()
    {
        $gateway = core()->getConfigData('payment_methods.online_payment.gateway');

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
}
