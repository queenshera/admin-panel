<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Set credentials for Text Local
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for Text Local
    |
    */

    'key' => env('MSG91_KEY'),
    'sender' => env('MSG91_SENDER'),
    'url' => env('MSG91_URL','https://control.msg91.com/api/v5/')

];
