<?php

return [
    /*
     |--------------------------------------------------------------------------
     | JWT Authentication Configuration
     |--------------------------------------------------------------------------
     |
     | Here you may configure your settings for JWT authentication. You can
     | learn more about JWT authentication at:
     | https://jwt.io/
     |
     */

    'secret' => env('JWT_SECRET'),

    'ttl' => env('JWT_TTL', 60),  // Token Life Time (in minutes)

    'algo' => env('JWT_ALGO', 'HS256'),

    'keys' => [
        'public' => env('JWT_PUBLIC_KEY'),
        'private' => env('JWT_PRIVATE_KEY'),
    ],

    'user' => [
        'model' => App\Models\User::class,
        'table' => 'users', // Table where your users are stored
    ],

    // Other configuration options can be added here based on your needs
];
