<?php

namespace Ashraful\OnlinePayment\Gateways;

use Illuminate\Http\Request;
use Webkul\Checkout\Facades\Cart;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SslCommerzGateway implements GatewayInterface
{
    public function redirect()
    {
        try {
            $cart = Cart::getCart();

            if (!$cart || $cart->items_count === 0) {
                return redirect()->route('shop.checkout.cart.index')
                    ->with('error', 'Cart is empty or has no items. Please add items to cart first.');
            }

            // Get credentials with fallback for testing
            $store_id = core()->getConfigData('payment_methods.online_payment.ssl_store_id') ?: 'instasurexyz0live';
            $store_passwd = core()->getConfigData('payment_methods.online_payment.ssl_password') ?: '6757F60C7BBA395329';

            $success_url = route('online.payment.success');
            $fail_url = route('online.payment.fail');
            $cancel_url = route('online.payment.cancel');
            $ipn_url = route('online.payment.ipn');

            // DEBUG: Log redirect URLs
            Log::info('SSLCommerzGateway::redirect - Success URL: ' . $success_url);
            Log::info('SSLCommerzGateway::redirect - Fail URL: ' . $fail_url);
            Log::info('SSLCommerzGateway::redirect - Cancel URL: ' . $cancel_url);
            Log::info('SSLCommerzGateway::redirect - IPN URL: ' . $ipn_url);

            $data = [
                'store_id'     => $store_id,
                'store_passwd' => $store_passwd,
                'total_amount' => $cart->grand_total,
                'currency'     => 'BDT',
                'tran_id'      => uniqid(),
                'success_url'  => $success_url,
                'fail_url'     => $fail_url,
                'cancel_url'   => $cancel_url,
                'ipn_url'      => $ipn_url,
                'product_name' => 'Order Payment',
                'product_category' => 'E-commerce',
                'product_profile' => 'general',
                'cus_name'     => $cart->customer_first_name . ' ' . $cart->customer_last_name,
                'cus_email'    => $cart->customer_email,
                'cus_add1'     => $cart->shipping_address->address1 ?? '',
                'cus_city'     => $cart->shipping_address->city ?? '',
                'cus_country'  => $cart->shipping_address->country ?? '',
                'cus_phone'    => $cart->customer_phone ?? '',
                'shipping_method' => 'NO',
                'multi_card_name' => '',
                'num_of_item'  => $cart->items_count,
                'product_name' => 'Order Items',
                'product_category' => 'E-commerce',
                'product_profile' => 'general'
            ];

            // dd($data);

            $url = core()->getConfigData('payment_methods.online_payment.ssl_sandbox')
                ? 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php'
                : 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';

            $response = Http::asForm()->post($url, $data)->json();

            // Debug: Log the response for troubleshooting
            Log::info('SSLCommerz Response', $response);

            if (isset($response['GatewayPageURL'])) {
                return redirect($response['GatewayPageURL']);
            }

            // If we get here, there was an error with SSLCommerz
            $error = $response['failedreason'] ?? 'Unknown error occurred';
            return redirect()->route('shop.checkout.cart.index')
                ->with('error', 'SSLCommerz payment error: ' . $error);
        } catch (\Exception $e) {
            return redirect()->route('shop.checkout.cart.index')
                ->with('error', 'Payment gateway error: ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        $store_id = core()->getConfigData('payment_methods.online_payment.ssl_store_id');
        $store_passwd = core()->getConfigData('payment_methods.online_payment.ssl_password');

        if ($request->status === 'VALID') {
            // Verify the transaction
            $url = core()->getConfigData('payment_methods.online_payment.ssl_sandbox')
                ? 'https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php'
                : 'https://securepay.sslcommerz.com/validator/api/validationserverAPI.php';

            $validation_data = [
                'val_id' => $request->val_id,
                'store_id' => $store_id,
                'store_passwd' => $store_passwd,
                'format' => 'json'
            ];

            $response = Http::asForm()->post($url, $validation_data)->json();

            return $response['status'] === 'VALID' || $response['status'] === 'VALIDATED';
        }

        return false;
    }

    public function fail()
    {
        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'Payment failed. Please try again.');
    }

    public function cancel()
    {
        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'Payment was cancelled.');
    }
}
