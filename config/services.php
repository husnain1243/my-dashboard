<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'transport' => 'mailgun',
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
        'transport' => 'postmark',
        'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        'token' => env('AWS_SESSION_TOKEN'),
        'options' => [
            'ConfigurationSetName' => 'MyConfigurationSet',
            'EmailTags' => [
                ['Name' => 'foo', 'Value' => 'bar'],
            ],
        ],
    ],

    //Add Captcha Configurations
    'recaptcha' => [
        'key' => env('6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI'),
        'secret' => env('6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe'),
    ]

];
