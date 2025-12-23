<?php

namespace Ashraful\OnlinePayment\Gateways;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Webkul\Checkout\Facades\Cart;

class BkashGateway implements GatewayInterface
{
    private $app_key;
    private $app_secret;
    private $username;
    private $password;
    private $is_sandbox;

    public function __construct()
    {
        $this->app_key = core()->getConfigData('sales.paymentmethods.online_payment.bkash_key');
        $this->app_secret = core()->getConfigData('sales.paymentmethods.online_payment.bkash_secret');
        $this->username = core()->getConfigData('sales.paymentmethods.online_payment.bkash_username');
        $this->password = core()->getConfigData('sales.paymentmethods.online_payment.bkash_password');
        $this->is_sandbox = core()->getConfigData('sales.paymentmethods.online_payment.bkash_sandbox');
    }

    public function redirect()
    {
        $cart = Cart::getCart();

        // Get grant token
        $grant_token = $this->getGrantToken();

        if (!$grant_token) {
            return redirect()->route('shop.checkout.cart.index')
                ->with('error', 'Failed to connect to bKash payment gateway.');
        }

        // Create payment
        $payment_data = [
            'mode' => '0011',
            'payerReference' => $cart->customer_email,
            'callbackURL' => route('online.payment.success'),
            'amount' => $cart->grand_total,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => uniqid('INV-'),
        ];

        $url = $this->is_sandbox
            ? 'https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized/checkout/create'
            : 'https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/checkout/create';

        $response = Http::withHeaders([
            'Authorization' => $grant_token,
            'X-APP-Key' => $this->app_key,
            'Content-Type' => 'application/json'
        ])->post($url, $payment_data)->json();

        if (isset($response['bkashURL'])) {
            return redirect($response['bkashURL']);
        }

        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'Payment gateway error: ' . ($response['statusMessage'] ?? 'Unknown error'));
    }

    public function success(Request $request)
    {
        if ($request->paymentID) {
            $grant_token = $this->getGrantToken();

            if (!$grant_token) {
                return false;
            }

            // Execute payment
            $execute_data = [
                'paymentID' => $request->paymentID,
            ];

            $url = $this->is_sandbox
                ? 'https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized/checkout/execute'
                : 'https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/checkout/execute';

            $response = Http::withHeaders([
                'Authorization' => $grant_token,
                'X-APP-Key' => $this->app_key,
                'Content-Type' => 'application/json'
            ])->post($url, $execute_data)->json();

            return isset($response['transactionStatus']) && $response['transactionStatus'] === 'Completed';
        }

        return false;
    }

    public function fail()
    {
        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'bKash payment failed. Please try again.');
    }

    public function cancel()
    {
        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'bKash payment was cancelled.');
    }

    private function getGrantToken()
    {
        $token_data = [
            'app_key' => $this->app_key,
            'app_secret' => $this->app_secret,
        ];

        $url = $this->is_sandbox
            ? 'https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized/checkout/grant-token'
            : 'https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/checkout/grant-token';

        $response = Http::withHeaders([
            'username' => $this->username,
            'password' => $this->password,
            'Content-Type' => 'application/json'
        ])->post($url, $token_data)->json();

        return isset($response['id_token']) ? $response['id_token'] : null;
    }
}
