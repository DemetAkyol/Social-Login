<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '337192723491074', // 15 karakterli Facebook uygulamasının "App ID"si
        'client_secret' => 'da048480d5c27c33f8744b711625bc73', // 32 karakteli Facebook uygulamasının "App Secret"ı

        'redirect' => 'http://localhost:8000/callback', // .env file'da APP_URL belirtilmiş ise onu çek, belirtilmemiş ise  localhost
    ],
    'google' => [
        'app_name' => 'Laravel Gplus',
        'client_id' => '97800960767-cnt4m96obpci5mv7o87p0tqq77rra8q9.apps.googleusercontent.com',
        'client_secret' => 'o6PfIlJdVSBKBNSN0Ep8Pk21'
        //   '.api_key'=>
    ]
];
