<?php

namespace MityDigital\Supportamic\Support;

use Statamic\Facades\File;
use Statamic\Facades\Path;
use Stringy\StaticStringy;

class Supportamic
{
    public static function svg($name, $attrs = null): string
    {
        if ($attrs) {
            $attrs = " class=\"{$attrs}\"";
        }

        $svg = StaticStringy::collapseWhitespace(
            File::get(Path::tidy(__DIR__."/../../resources/svg/{$name}.svg"))
        );

        return str_replace('<svg', sprintf('<svg%s', $attrs), $svg);
    }

    public static function hasChat(): bool
    {
        $availableChatEngines = ['hubspot'];

        $engine = config('supportamic.chat.type', null);

        // are we a valid engine?
        if (!in_array($engine, $availableChatEngines)) {
            return false;
        }

        // do we have what the engine needs?
        switch ($engine) {
            case 'hubspot':
                $key = 'supportamic.chat.endpoint';
                if (!config($key)) {
                    return false; // missing endpoint
                }
                break;
            default:
                return false; // unknown engine
        }

        return true;
    }
}
