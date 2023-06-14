<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Chat Settings
    |--------------------------------------------------------------------------
    |
    | Chitty chitty chat chat. Let's all chat.
    |
    | Available types: hubspot
    | Set to "null" to just ingore all other chat-type setup and config.
    |
    | Endpoint is required for "hubspot"
    |
    | Identity allows you to map User blueprint field handles (the values) to key email and name
    | properties to pre-set identity within the chat widget. If the type supports it.
    |
    */
    'chat' => [
        'type' => env('SUPPORTAMIC_CHAT', null),

        'endpoint' => env('SUPPORTAMIC_CHAT_ENDPOINT', null),

        'identity' => [
            'email' => 'email',
            'name' => 'name'
        ]
    ],


    /*
    |--------------------------------------------------------------------------
    | Widget Settings
    |--------------------------------------------------------------------------
    |
    | Not all sites have a docs guide - and this is governed by Statamic's STATAMIC_LINK_TO_DOCS
    | configuration option in your .env file (if you use it). If you have this set, and want to
    | include the "guide" section, make sure SUPPORTAMIC_WIDGET_SHOW_GUIDE is true.
    |
    | The section will be hidden when false, or if your STATAMIC_SUPPORT_URL starts with "https://statamic.com".
    |
    | The contact options will appear/disappear automatically based on your configuration.
    |
    | Chat will be shown if chat is configured above.
    | Email will be shown when SUPPORTAMIC_EMAIL is set
    | Website will be shown when SUPPORTAMIC_WEBSITE is set
    |
    */
    'widget' => [
        'email' => env('SUPPORTAMIC_EMAIL', null),

        'show_guide' => env('SUPPORTAMIC_WIDGET_SHOW_GUIDE', false),

        'website' => env('SUPPORTAMIC_WEBSITE', null),
    ]
];
