<?php


return [

    'grant_type' => env('GRANT_TYPE', 'password'),
    'client_id' => env('CLIENT_ID', ''),
    'client_secret' => env('CLIENT_SECRET', ''),
    'scope' => env('SCOPE', '*'),
];
