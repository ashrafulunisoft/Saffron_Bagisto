<?php

return [
    // Legacy online_payment for backward compatibility
    'online_payment' => [
        'code'        => 'online_payment',
        'title'       => 'Online Payment',
        'description' => 'Pay via SSLCommerz, bKash, Nagad or Rocket',
        'class'       => 'Ashraful\OnlinePayment\Payment\OnlinePayment',
        'active'      => true,
        'sort'        => 5,
        'fields' => [
            [
                'name'  => 'gateway',
                'title' => 'Select Gateway',
                'type'  => 'select',
                'options' => [
                    ['title' => 'SSLCommerz', 'value' => 'sslcommerz'],
                    ['title' => 'bKash', 'value' => 'bkash'],
                    ['title' => 'Nagad', 'value' => 'nagad'],
                    ['title' => 'Rocket', 'value' => 'rocket'],
                ],
            ],
        ],
    ],
];
