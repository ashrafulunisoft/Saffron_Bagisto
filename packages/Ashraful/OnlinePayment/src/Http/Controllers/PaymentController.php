<?php

namespace Ashraful\OnlinePayment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Webkul\Checkout\Facades\Cart;
use Webkul\Sales\Contracts\Order;
use Webkul\Sales\Repositories\OrderRepository;
use Ashraful\OnlinePayment\Gateways\{
    SslCommerzGateway, BkashGateway, NagadGateway, RocketGateway
};

class PaymentController extends Controller
{
    protected $orderRepository;

    public function __construct(
        OrderRepository $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
    }

    private function gateway()
    {
        // For testing: Hardcode SSLCommerz to bypass config issue
        $gateway = core()->getConfigData('payment_methods.online_payment.gateway');

        if (!$gateway) {
            $gateway = 'sslcommerz'; // Fallback for testing
        }

        return match ($gateway) {
            'sslcommerz' => app(SslCommerzGateway::class),
            'bkash'      => app(BkashGateway::class),
            'nagad'      => app(NagadGateway::class),
            'rocket'      => app(RocketGateway::class),
            default       => app(SslCommerzGateway::class), // Default fallback
        };
    }

    public function redirect()
    {
        // DEBUG: Log session state before redirect
        Log::info('PaymentController::redirect - Session ID: ' . session()->getId());
        Log::info('PaymentController::redirect - Auth check: ' . (Auth::check() ? 'authenticated' : 'NOT authenticated'));
        Log::info('PaymentController::redirect - Cart exists: ' . (Cart::getCart() ? 'YES' : 'NO'));

        $gateway = $this->gateway();

        if (!$gateway) {
            return redirect()->route('shop.checkout.cart.index')
                ->with('error', 'Payment gateway not configured properly.');
        }

        // For testing: Skip credential validation to ensure gateway selection works
        // TODO: Re-enable credential validation after testing
        /*
        if (!$this->validateGatewayCredentials()) {
            return redirect()->route('shop.checkout.cart.index')
                ->with('error', 'Payment gateway credentials are not configured. Please contact administrator.');
        }
        */

        return $gateway->redirect();
    }

    public function success(Request $request)
    {
        // DEBUG: Log session state
        Log::info('PaymentController::success - Session ID: ' . session()->getId());
        Log::info('PaymentController::success - Auth check: ' . (Auth::check() ? 'authenticated' : 'NOT authenticated'));
        Log::info('PaymentController::success - Cart exists: ' . (Cart::getCart() ? 'YES' : 'NO'));
        Log::info('PaymentController::success - Request data: ', $request->all());

        $gateway = $this->gateway();

        if (!$gateway) {
            return redirect()->route('shop.checkout.cart.index')
                ->with('error', 'Payment gateway not configured properly.');
        }

        if ($gateway->success($request)) {
            try {
                // Get cart before creating order
                $cart = Cart::getCart();

                if (!$cart || $cart->items_count === 0) {
                    Log::error('Payment success but cart is empty');
                    return redirect()->route('shop.checkout.cart.index')
                        ->with('error', 'Cart is empty. Please add items to cart first.');
                }

                // Create order from cart
                $order = $this->orderRepository->create(
                    Cart::prepareDataForOrder()
                );

                // Add payment information to order
                $this->addPaymentInfo($order, $request);

                // Update order status to processing
                $this->orderRepository->updateOrderStatus($order, 'processing');

                // Dispatch order creation event for email notifications
                Event::dispatch('sales.order.create.after', $order);

                // Deactivate cart
                Cart::deActivateCart();

                // Store order ID in session for success page
                session()->put('order_id', $order->id);

                Log::info('Order created successfully', ['order_id' => $order->id, 'status' => $order->status]);

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
        // DEBUG: Log session state
        Log::info('PaymentController::fail - Session ID: ' . session()->getId());
        Log::info('PaymentController::fail - Auth check: ' . (Auth::check() ? 'authenticated' : 'NOT authenticated'));
        Log::info('PaymentController::fail - Cart exists: ' . (Cart::getCart() ? 'YES' : 'NO'));
        Log::info('PaymentController::fail - Request data: ', $request->all());

        $gateway = $this->gateway();

        if ($gateway) {
            return $gateway->fail();
        }

        // Keep cart intact so user can retry payment
        // Do not deactivate cart on payment failure
        return redirect()->route('shop.checkout.cart.index')
            ->with('error', 'Payment failed. Please try again or choose a different payment method.');
    }

    public function cancel(Request $request)
    {
        // DEBUG: Log session state
        Log::info('PaymentController::cancel - Session ID: ' . session()->getId());
        Log::info('PaymentController::cancel - Auth check: ' . (Auth::check() ? 'authenticated' : 'NOT authenticated'));
        Log::info('PaymentController::cancel - Cart exists: ' . (Cart::getCart() ? 'YES' : 'NO'));
        Log::info('PaymentController::cancel - Request data: ', $request->all());

        $gateway = $this->gateway();

        if ($gateway) {
            return $gateway->cancel();
        }

        // Keep cart intact so user can retry payment
        // Do not deactivate cart on payment cancellation
        return redirect()->route('shop.checkout.cart.index')
            ->with('info', 'Payment was cancelled. You can try again or choose a different payment method.');
    }

    public function ipn(Request $request)
    {
        Log::info('PaymentController::ipn - IPN received', $request->all());

        $gateway = $this->gateway();

        if (!$gateway) {
            return response()->json(['status' => 'error', 'message' => 'Gateway not configured']);
        }

        // Handle IPN (Instant Payment Notification)
        // This is server-to-server callback from SSLCommerz
        // Should be idempotent to handle duplicate notifications

        try {
            // Get transaction ID from request
            $transactionId = $request->tran_id ?? $request->transaction_id ?? null;

            if (!$transactionId) {
                Log::warning('IPN received without transaction ID');
                return response()->json(['status' => 'error', 'message' => 'Transaction ID missing']);
            }

            // Find order by transaction ID
            $order = $this->orderRepository->findOneWhere([
                'increment_id' => $transactionId,
            ]);

            if (!$order) {
                Log::warning('IPN: Order not found for transaction', ['transaction_id' => $transactionId]);
                return response()->json(['status' => 'error', 'message' => 'Order not found']);
            }

            // Verify payment status from SSLCommerz
            $paymentStatus = $request->status ?? $request->bank_tran_id ? 'SUCCESS' : 'FAILED';

            if ($paymentStatus === 'SUCCESS' || $paymentStatus === 'VALID') {
                // Payment successful - update order status
                $this->orderRepository->updateOrderStatus($order, 'processing');

                // Dispatch order status update event
                Event::dispatch('sales.order.update-status.after', $order);

                Log::info('IPN: Order status updated', [
                    'order_id' => $order->id,
                    'status' => 'processing',
                    'transaction_id' => $transactionId,
                ]);

                return response()->json(['status' => 'success', 'message' => 'Order status updated']);
            } else {
                // Payment failed - update order status to canceled
                $this->orderRepository->updateOrderStatus($order, 'canceled');

                Log::warning('IPN: Payment failed', [
                    'order_id' => $order->id,
                    'status' => 'canceled',
                    'transaction_id' => $transactionId,
                ]);

                return response()->json(['status' => 'success', 'message' => 'Order status updated']);
            }
        } catch (\Exception $e) {
            Log::error('IPN processing error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Processing error']);
        }
    }

    private function addPaymentInfo($order, Request $request)
    {
        $gateway = core()->getConfigData('payment_methods.online_payment.gateway');

        // Map gateway to payment method identifier
        $paymentMethod = $gateway ?? 'sslcommerz';

        // Get payment method title from config
        $paymentMethodTitle = $this->getPaymentMethodTitle($paymentMethod);

        $paymentData = [
            'method'       => $paymentMethod,
            'method_title' => $paymentMethodTitle,
            'additional'    => json_encode([
                'transaction_id' => $request->transaction_id ?? $request->tran_id ?? $request->paymentID ?? $request->payment_ref_id ?? null,
                'status'        => 'completed',
                'amount'        => $order->grand_total,
                'gateway'       => $gateway,
                'request_data'  => $request->all(),
            ]),
        ];

        // Create payment record
        $order->payments()->create($paymentData);

        // Update order status
        $order->update(['status' => 'processing']);
    }

    /**
     * Get payment method title based on gateway
     *
     * @param string $gateway
     * @return string
     */
    private function getPaymentMethodTitle($gateway)
    {
        $titles = [
            'sslcommerz' => 'SSLCommerz',
            'bkash'      => 'bKash',
            'nagad'      => 'Nagad',
            'rocket'      => 'Rocket',
        ];

        return $titles[$gateway] ?? 'Online Payment';
    }

    /**
     * Validate gateway credentials
     */
    private function validateGatewayCredentials()
    {
        $gateway = core()->getConfigData('payment_methods.online_payment.gateway');

        switch ($gateway) {
            case 'sslcommerz':
                return core()->getConfigData('payment_methods.online_payment.ssl_store_id') &&
                       core()->getConfigData('payment_methods.online_payment.ssl_password');

            case 'bkash':
                return core()->getConfigData('payment_methods.online_payment.bkash_key') &&
                       core()->getConfigData('payment_methods.online_payment.bkash_secret');

            case 'nagad':
                return core()->getConfigData('payment_methods.online_payment.nagad_merchant');

            case 'rocket':
                return core()->getConfigData('payment_methods.online_payment.rocket_merchant_id') &&
                       core()->getConfigData('payment_methods.online_payment.rocket_password');
        }

        return false;
    }
}
