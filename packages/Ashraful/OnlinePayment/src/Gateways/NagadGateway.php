<?php

namespace Ashraful\OnlinePayment\Gateways;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Webkul\Checkout\Facades\Cart;

class NagadGateway implements GatewayInterface
{
    private $merchant_id;
    private $merchant_private_key;
    private $nagad_public_key;
    private $is_sandbox;

    public function __construct()
    {
        $this->merchant_id = core()->getConfigData('sales.paymentmethods.online_payment.nagad_merchant');
        $this->merchant_private_key = core()->getConfigData('sales.paymentmethods.online_payment.nagad_private_key');
        $this->nagad_public_key = core()->getConfigData('sales.paymentmethods.online_payment.nagad_public_key');
        $this->is_sandbox = core()->getConfigData('sales.paymentmethods.online_payment.nagad_sandbox');
    }

    public function redirect()
    {
        $cart = Cart::getCart();

        // Initialize Nagad payment
        $init_data = [
            'merchantId' => $this->merchant_id,
            'datetime' => now()->format('YmdHis'),
            'orderId' => uniqid('NAGAD-'),
            'challenge' => uniqid(),
            'orderAmount' => $cart->grand_total,
            'currencyCode' => 'BDT',
            'merchantCallbackURL' => route('online.payment.success'),
            'additionalMerchantInfo' => [
                'customerName' => $cart->customer_first_name . ' ' . $cart->customer_last_name,
                'customerEmail' => $cart->customer_email,
                'customerMobile' => $cart->customer_phone ?? ''
            ]
        ];

        $url = $this->is_sandbox
            ? 'https://api.mynagad.com/ck-merchant/api/initialize'
            : 'https://api.mynagad.com/ck-merchant/api/initialize';

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-KM-IP-V4' => request()->ip(),
            'X-KM-ApiKey' => $this->merchant_private_key
        ])->post($url, $init_data)->json();

        if (isset($response['paymentURL'])) {
            return redirect($response['paymentURL']);
        }

        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'Nagad payment initialization failed: ' . ($response['message'] ?? 'Unknown error'));
    }

    public function success(Request $request)
    {
        if ($request->payment_ref_id) {
            // Verify payment with Nagad
            $verify_data = [
                'merchantId' => $this->merchant_id,
                'orderId' => $request->order_id,
                'paymentRefId' => $request->payment_ref_id,
                'amount' => $request->amount,
                'currency' => 'BDT',
                'status' => $request->status
            ];

            $url = $this->is_sandbox
                ? 'https://api.mynagad.com/ck-merchant/api/verify'
                : 'https://api.mynagad.com/ck-merchant/api/verify';

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-KM-IP-V4' => request()->ip(),
                'X-KM-ApiKey' => $this->merchant_private_key
            ])->post($url, $verify_data)->json();

            return isset($response['status']) && $response['status'] === 'Success';
        }

        return false;
    }

    public function fail()
    {
        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'Nagad payment failed. Please try again.');
    }

    public function cancel()
    {
        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'Nagad payment was cancelled.');
    }

    private function encryptData($data)
    {
        // Implementation for data encryption based on Nagad's requirements
        // This is a placeholder - actual implementation would use OpenSSL
        return base64_encode(json_encode($data));
    }

    private function decryptData($encryptedData)
    {
        // Implementation for data decryption based on Nagad's requirements
        // This is a placeholder - actual implementation would use OpenSSL
        return json_decode(base64_decode($encryptedData), true);
    }
}
