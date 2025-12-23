<?php

namespace Ashraful\OnlinePayment\Gateways;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Webkul\Checkout\Facades\Cart;

class SslCommerzGateway implements GatewayInterface
{
    public function redirect()
    {
        $cart = Cart::getCart();

        $data = [
            'store_id'     => core()->getConfigData('sales.paymentmethods.online_payment.ssl_store_id'),
            'store_passwd' => core()->getConfigData('sales.paymentmethods.online_payment.ssl_password'),
            'total_amount' => $cart->grand_total,
            'currency'     => 'BDT',
            'tran_id'      => uniqid(),
            'success_url'  => route('online.payment.success'),
            'fail_url'     => route('online.payment.fail'),
            'cancel_url'   => route('online.payment.cancel'),
            'ipn_url'      => route('online.payment.ipn'),
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

        $url = core()->getConfigData('sales.paymentmethods.online_payment.ssl_sandbox')
            ? 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php'
            : 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';

        $response = Http::asForm()->post($url, $data)->json();

        if (isset($response['GatewayPageURL'])) {
            return redirect($response['GatewayPageURL']);
        }

        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'Payment gateway error: ' . ($response['failedreason'] ?? 'Unknown error'));
    }

    public function success(Request $request)
    {
        $store_id = core()->getConfigData('sales.paymentmethods.online_payment.ssl_store_id');
        $store_passwd = core()->getConfigData('sales.paymentmethods.online_payment.ssl_password');

        if ($request->status === 'VALID') {
            // Verify the transaction
            $url = core()->getConfigData('sales.paymentmethods.online_payment.ssl_sandbox')
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
