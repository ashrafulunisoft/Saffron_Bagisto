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
                    ['title' => 'Rocket',      'value' => 'rocket'],
                ],
            ],

            // SSLCommerz Configuration
            ['name' => 'ssl_store_id', 'title' => 'SSL Store ID', 'type' => 'text', 'channel_based' => true],
            ['name' => 'ssl_password', 'title' => 'SSL Store Password', 'type' => 'password', 'channel_based' => true],
            ['name' => 'ssl_sandbox',  'title' => 'SSL Sandbox Mode', 'type' => 'boolean', 'channel_based' => true],

            // bKash Configuration
            ['name' => 'bkash_key',    'title' => 'bKash App Key', 'type' => 'text', 'channel_based' => true],
            ['name' => 'bkash_secret','title' => 'bKash App Secret', 'type' => 'password', 'channel_based' => true],
            ['name' => 'bkash_username', 'title' => 'bKash Username', 'type' => 'text', 'channel_based' => true],
            ['name' => 'bkash_password', 'title' => 'bKash Password', 'type' => 'password', 'channel_based' => true],
            ['name' => 'bkash_sandbox',  'title' => 'bKash Sandbox Mode', 'type' => 'boolean', 'channel_based' => true],

            // Nagad Configuration
            ['name' => 'nagad_merchant', 'title' => 'Nagad Merchant ID', 'type' => 'text', 'channel_based' => true],
            ['name' => 'nagad_private_key', 'title' => 'Nagad Private Key', 'type' => 'password', 'channel_based' => true],
            ['name' => 'nagad_public_key', 'title' => 'Nagad Public Key', 'type' => 'text', 'channel_based' => true],
            ['name' => 'nagad_sandbox',  'title' => 'Nagad Sandbox Mode', 'type' => 'boolean', 'channel_based' => true],

            // Rocket Configuration
            ['name' => 'rocket_merchant', 'title' => 'Rocket Merchant ID', 'type' => 'text', 'channel_based' => true],
            ['name' => 'rocket_key', 'title' => 'Rocket Merchant Key', 'type' => 'text', 'channel_based' => true],
            ['name' => 'rocket_secret', 'title' => 'Rocket Merchant Secret', 'type' => 'password', 'channel_based' => true],
            ['name' => 'rocket_sandbox',  'title' => 'Rocket Sandbox Mode', 'type' => 'boolean', 'channel_based' => true],
        ],
    ],
];
