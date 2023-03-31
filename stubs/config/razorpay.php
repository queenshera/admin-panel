<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is used for storing the credentials for third party services of Razorpay Payment Gateway
    |
    */

    'key' => env('RAZORPAY_KEY'),
    'secret' => env('RAZORPAY_SECRET'),
    'account' => env('RAZORPAY_ACCOUNT'),
    'url' => env('RAZORPAY_URL','https://api.razorpay.com/v1/'),
];
