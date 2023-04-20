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

    'key' => env('TEXTLOCAL_KEY'),
    'sender' => env('TEXTLOCAL_SENDER'),
    'url' => env('TEXTLOCAL_URL','https://api.textlocal.in/')

];
