<?php

namespace MityDigital\Supportamic;

use Illuminate\Support\Facades\Auth;
use MityDigital\Supportamic\Middleware\ChatMiddleware;
use MityDigital\Supportamic\Widgets\Supportamic;
use Statamic\Facades\Icon;
use Statamic\Facades\User;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;
use Illuminate\Support\Facades\Blade;

class ServiceProvider extends AddonServiceProvider
{
    protected $middlewareGroups = [
        'statamic.cp.authenticated' => [
            ChatMiddleware::class
        ]
    ];

    protected $vite = [
        'input' => [
            'resources/js/support.js',
            'resources/css/support.css'
        ],
        'publicDirectory' => 'resources/dist',
    ];

    protected $widgets = [
        Supportamic::class
    ];

    public function bootAddon()
    {
        Icon::register('supportamic', __DIR__.'/../resources/icons');
    }
}
