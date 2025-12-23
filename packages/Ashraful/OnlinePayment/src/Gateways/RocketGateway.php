<?php

namespace Ashraful\OnlinePayment\Gateways;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Webkul\Checkout\Facades\Cart;

class RocketGateway implements GatewayInterface
{
    private $merchant_id;
    private $merchant_key;
    private $merchant_secret;
    private $is_sandbox;

    public function __construct()
    {
        $this->merchant_id = core()->getConfigData('sales.paymentmethods.online_payment.rocket_merchant');
        $this->merchant_key = core()->getConfigData('sales.paymentmethods.online_payment.rocket_key');
        $this->merchant_secret = core()->getConfigData('sales.paymentmethods.online_payment.rocket_secret');
        $this->is_sandbox = core()->getConfigData('sales.paymentmethods.online_payment.rocket_sandbox');
    }

    public function redirect()
    {
        $cart = Cart::getCart();

        // Initialize Rocket payment
        $payment_data = [
            'merchantId' => $this->merchant_id,
            'transactionId' => uniqid('ROCKET-'),
            'amount' => $cart->grand_total,
            'currency' => 'BDT',
            'customerName' => $cart->customer_first_name . ' ' . $cart->customer_last_name,
            'customerEmail' => $cart->customer_email,
            'customerMobile' => $cart->customer_phone ?? '',
            'callbackUrl' => route('online.payment.success'),
            'failUrl' => route('online.payment.fail'),
            'cancelUrl' => route('online.payment.cancel'),
            'description' => 'Payment for order #' . uniqid(),
            'timestamp' => now()->timestamp
        ];

        // Generate signature
        $signature = $this->generateSignature($payment_data);
        $payment_data['signature'] = $signature;

        $url = $this->is_sandbox
            ? 'https://sandbox.rocket-bd.com/api/payment/create'
            : 'https://api.rocket-bd.com/api/payment/create';

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Merchant-Key' => $this->merchant_key
        ])->post($url, $payment_data)->json();

        if (isset($response['paymentUrl'])) {
            return redirect($response['paymentUrl']);
        }

        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'Rocket payment initialization failed: ' . ($response['message'] ?? 'Unknown error'));
    }

    public function success(Request $request)
    {
        if ($request->transactionId && $request->status === 'SUCCESS') {
            // Verify payment with Rocket
            $verify_data = [
                'merchantId' => $this->merchant_id,
                'transactionId' => $request->transactionId,
                'amount' => $request->amount,
                'currency' => 'BDT'
            ];

            $signature = $this->generateSignature($verify_data);
            $verify_data['signature'] = $signature;

            $url = $this->is_sandbox
                ? 'https://sandbox.rocket-bd.com/api/payment/verify'
                : 'https://api.rocket-bd.com/api/payment/verify';

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Merchant-Key' => $this->merchant_key
            ])->post($url, $verify_data)->json();

            return isset($response['status']) && $response['status'] === 'SUCCESS';
        }

        return false;
    }

    public function fail()
    {
        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'Rocket payment failed. Please try again.');
    }

    public function cancel()
    {
        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'Rocket payment was cancelled.');
    }

    private function generateSignature($data)
    {
        // Remove signature from data if present
        unset($data['signature']);

        // Sort the data by key
        ksort($data);

        // Create query string
        $queryString = http_build_query($data, '', '&');

        // Generate hash using merchant secret
        return hash_hmac('sha256', $queryString, $this->merchant_secret);
    }

    private function verifySignature($data, $receivedSignature)
    {
        $computedSignature = $this->generateSignature($data);
        return hash_equals($computedSignature, $receivedSignature);
    }
}
