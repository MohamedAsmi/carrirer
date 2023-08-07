<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'client_id'         => env('PAYPAL_SANDBOX_CLIENT_ID', 'AVaQAZ4CMWLw0atRqYDjg0WLjLyE8vO4WVQ31klWKVirmQhsSXjezdb7Z9-IN5GlK1ohPIz4N1ucxzPc'),
        'client_secret'     => env('PAYPAL_SANDBOX_CLIENT_SECRET', 'ED0Pk3fTfsp0S00SB2cQYD30ssuYEuNioDFbOG-wCJDNRA78PKuu30t7DkqsXN3GJnRVPB5tyjHBJas7'),
        'app_id'            => 'F2LUJD9C6Z5DW',
    ],
    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'            => env('PAYPAL_LIVE_APP_ID', ''),
    ],

    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', 'https://sandbox.paypal.com'), // Change this accordingly for your application.
    'locale'         => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
];
