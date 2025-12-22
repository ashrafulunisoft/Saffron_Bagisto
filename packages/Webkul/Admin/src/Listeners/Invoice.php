<?php

namespace Webkul\Admin\Listeners;

use Webkul\Admin\Mail\Order\InvoicedNotification;
use Webkul\Sales\Repositories\OrderTransactionRepository;
use Webkul\Admin\Services\SmsService;

class Invoice extends Base
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected OrderTransactionRepository $orderTransactionRepository,
    ) {}

    /**
     * After order is created
     *
     * @param  \Webkul\Sale\Contracts\Invoice  $invoice
     * @return void
     */
    public function afterCreated($invoice)
    {
        $this->sendMail($invoice);

        if ($invoice->can_create_transaction) {
            $this->createTransaction($invoice);
        }
    }

    /**
     * Send Transaction mail.
     *
     * @param  \Webkul\Sale\Contracts\Invoice  $invoice
     * @return void
     */
    public function sendMail($invoice)
    {
        try {
            if (! core()->getConfigData('emails.general.notifications.emails.general.notifications.new_invoice_mail_to_admin')) {
                return;
            }

            $this->prepareMail($invoice, new InvoicedNotification($invoice));

            // Send SMS notification for invoice
            if ($invoice->order->customer_phone) {
                $smsMessage = "Dear {$invoice->order->customer_name}, your invoice #{$invoice->increment_id} has been generated successfully. Total amount: {$invoice->grand_total}. Thank you for shopping with us!";
                $smsService = new SmsService();
                $smsService->sendSms($invoice->order->customer_phone, $smsMessage);
            }


            // Send SMS notification for invoice
            if ($invoice->order->customer_phone) {
                $smsMessage = "Dear {$invoice->order->customer_name}, your invoice #{$invoice->increment_id} has been generated successfully. Total amount: {$invoice->grand_total}. Thank you for shopping with us!";
                $smsService = new SmsService();
                $smsService->sendSms($invoice->order->customer_phone, $smsMessage);
            }
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Create the transaction data for Money-transfer and Cash-on-delivery.
     *
     * @param  \Webkul\Sale\Contracts\Invoice  $invoice
     * @return void
     */
    public function createTransaction($invoice)
    {
        $transactionId = md5(uniqid());

        $transactionData = [
            'transaction_id' => $transactionId,
            'status'         => $invoice->state,
            'type'           => $invoice->order->payment->method,
            'payment_method' => $invoice->order->payment->method,
            'order_id'       => $invoice->order->id,
            'invoice_id'     => $invoice->id,
            'amount'         => $invoice->grand_total,
        ];

        $this->orderTransactionRepository->create($transactionData);
    }
}
