<?php

// Setup:

require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'http://localhost/apolo', // Your store URL
    'ck_83b7c08267cbf9e97d242f86c64eff35d55080da', // Your consumer key (Nunca passar esse dado direto pelo código, gera vulnerabilidade)
    'cs_e5cdaa506add73bbbfe5908664f84a7b6a143eb6', // Your consumer secret (Nunca passar esse dado direto pelo código, gera vulnerabilidade)
    [
        'wp_api' => true, // Enable the WP REST API integration
        'version' => 'wc/v3' // WooCommerce WP REST API version
    ]
);

print_r( json_encode($woocommerce->get('orders/57')) );
