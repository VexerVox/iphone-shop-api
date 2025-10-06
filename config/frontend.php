<?php

return [
    'base_url' => env('FRONTEND_BASE_URL', 'http://localhost:3000'),
    'checkout' => [
        'success_url' => env('FRONTEND_CHECKOUT_SUCCESS_URL', '/checkout/success'),
        'cancel_url' => env('FRONTEND_CHECKOUT_CANCEL_URL', '/checkout/cancel'),
    ],
];
