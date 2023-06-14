<?php

namespace MityDigital\Supportamic;

use MityDigital\Supportamic\Widgets\Supportamic;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;

class ServiceProvider extends AddonServiceProvider
{
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
        // publishable views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/supportamic'),
        ], 'supportamic-views');

        // boot supportamic
        $this->bootSupportamic();
    }

    protected function bootSupportamic() {
        //
        // CONFIGURE CHAT
        // Only run if we are a CP route
        //
        if (Statamic::isCpRoute()) {

            if (!\MityDigital\Supportamic\Support\Supportamic::hasChat())
            {
                return $this; // just return
            }

            // what sort of chat are we meant to use?
            $engine = config('supportamic.chat.type');

            switch ($engine) {
                case 'hubspot':
                    /*
                     * Hubspot requires a chat endpoint, so let's make sure we have that.
                     */
                    $key = 'supportamic.chat.endpoint';
                    if (!config($key)) {
                        throw new \Exception('Missing config value for '.$key.'. HubSpot requires this.');
                    }

                    // pass the config options to
                    Statamic::provideToScript([
                        'supportamic' => [
                            'chat' => [
                                'type' => $engine,
                                'endpoint' => config($key),
                                'identity' => [
                                    'email' => config('supportamic.chat.identity.email', null),
                                    'name' => config('supportamic.chat.identity.name', null)
                                ]
                            ],
                        ]
                    ]);
                    break;
            }
        }

        return $this;
    }

}
