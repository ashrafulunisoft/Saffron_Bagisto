<?php

return [
    'online_payment' => [
        'code'        => 'online_payment',
        'title'       => 'Online Payment',
        'description' => 'Pay via SSLCommerz, bKash, Nagad or Rocket',
        'class'       => 'Ashraful\OnlinePayment\Payment\OnlinePayment',
        'active'      => true,
        'sort'        => 1,

        'fields' => [
            [
                'name'  => 'gateway',
                'title' => 'Select Gateway',
                'type'  => 'select',
                'options' => [
                    ['title' => 'SSLCommerz', 'value' => 'sslcommerz'],
                    ['title' => 'bKash',      'value' => 'bkash'],
                    ['title' => 'Nagad',      'value' => 'nagad'],
                    ['title' => 'Rocket',     'value' => 'rocket'],
                ],
            ],

            ['name' => 'ssl_store_id', 'title' => 'SSL Store ID', 'type' => 'text'],
            ['name' => 'ssl_password', 'title' => 'SSL Password', 'type' => 'password'],
            ['name' => 'ssl_sandbox',  'title' => 'SSL Sandbox', 'type' => 'boolean'],

            ['name' => 'bkash_key',    'title' => 'bKash App Key', 'type' => 'text'],
            ['name' => 'bkash_secret','title' => 'bKash Secret', 'type' => 'password'],
            ['name' => 'bkash_username','title' => 'bKash Username', 'type' => 'text'],
            ['name' => 'bkash_password','title' => 'bKash Password', 'type' => 'password'],

            ['name' => 'nagad_merchant','title' => 'Nagad Merchant ID', 'type' => 'text'],
            ['name' => 'nagad_public_key','title' => 'Nagad Public Key', 'type' => 'text'],
            ['name' => 'nagad_private_key','title' => 'Nagad Private Key', 'type' => 'password'],

            ['name' => 'rocket_merchant_id','title' => 'Rocket Merchant ID', 'type' => 'text'],
        ],
    ],
];
