<?php

namespace MityDigital\Supportamic\Middleware;

use Illuminate\Http\Request;
use Statamic\Statamic;

class ChatMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        // do we have chat?
        if (!\MityDigital\Supportamic\Support\Supportamic::hasChat()) {
            return $this; // just return
        }

        // what sort of chat are we meant to use?
        $engine = config('supportamic.chat.type');

        // configure chat based on the engine
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

        return $next($request);
    }
}
