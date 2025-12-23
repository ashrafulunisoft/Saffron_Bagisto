<?php

namespace Ashraful\OnlinePayment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Webkul\Checkout\Facades\Cart;
use Webkul\Sales\Repositories\OrderRepository;
use Ashraful\OnlinePayment\Gateways\{
    SslCommerzGateway, BkashGateway, NagadGateway, RocketGateway
};

class PaymentController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    private function gateway()
    {
        return match (
            core()->getConfigData('sales.paymentmethods.online_payment.gateway')
        ) {
            'sslcommerz' => app(SslCommerzGateway::class),
            'bkash'      => app(BkashGateway::class),
            'nagad'      => app(NagadGateway::class),
            'rocket'      => app(RocketGateway::class),
            default       => null,
        };
    }

    public function redirect()
    {
        $gateway = $this->gateway();

        if (!$gateway) {
            return redirect()->route('shop.checkout.cart.index')
                ->with('error', 'Payment gateway not configured properly.');
        }

        return $gateway->redirect();
    }

    public function success(Request $request)
    {
        $gateway = $this->gateway();

        if (!$gateway) {
            return redirect()->route('shop.checkout.cart.index')
                ->with('error', 'Payment gateway not configured properly.');
        }

        if ($gateway->success($request)) {
            try {
                // Create order
                $order = $this->orderRepository->create(
                    Cart::prepareDataForOrder()
                );

                // Add payment information to order
                $this->addPaymentInfo($order, $request);

                // Deactivate cart
                Cart::deActivateCart();

                return redirect()->route('shop.checkout.success');
            } catch (\Exception $e) {
                Log::error('Payment success but order creation failed: ' . $e->getMessage());

                return redirect()->route('shop.checkout.cart.index')
                    ->with('error', 'Payment successful but order creation failed. Please contact support.');
            }
        }

        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'Payment verification failed.');
    }

    public function fail(Request $request)
    {
        $gateway = $this->gateway();

        if ($gateway) {
            return $gateway->fail();
        }

        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'Payment failed. Please try again.');
    }

    public function cancel(Request $request)
    {
        $gateway = $this->gateway();

        if ($gateway) {
            return $gateway->cancel();
        }

        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'Payment was cancelled.');
    }

    public function ipn(Request $request)
    {
        $gateway = $this->gateway();

        if (!$gateway) {
            return response()->json(['status' => 'error', 'message' => 'Gateway not configured']);
        }

        // Handle IPN (Instant Payment Notification)
        // This is typically used for server-to-server communication
        // Implementation depends on the specific gateway

        Log::info('IPN received', $request->all());

        return response()->json(['status' => 'success']);
    }

    private function addPaymentInfo($order, Request $request)
    {
        $gateway = core()->getConfigData('sales.paymentmethods.online_payment.gateway');

        $paymentData = [
            'transaction_id' => $request->transaction_id ?? $request->tran_id ?? $request->paymentID ?? $request->payment_ref_id ?? null,
            'gateway' => $gateway,
            'amount' => $order->grand_total,
            'status' => 'completed',
            'additional_data' => json_encode($request->all())
        ];

        // Create payment record
        $order->payments()->create($paymentData);

        // Update order status
        $order->update(['status' => 'processing']);
    }
}
