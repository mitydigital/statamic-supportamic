<?php

namespace MityDigital\Supportamic\Widgets;

use Illuminate\Support\Facades\Blade;
use Statamic\Widgets\VueComponent;
use Statamic\Widgets\Widget;

class Supportamic extends Widget
{
    public function component()
    {
        $showGuide = config('supportamic.widget.show_guide', false);
        $actionGuide = config('statamic.cp.support_url', false);
        if (!$actionGuide || str_starts_with($actionGuide, 'https://statamic.com'))
        {
            $showGuide = false;
            $actionGuide = null;
        }

        // do we have chat configured?
        $actionChat = \MityDigital\Supportamic\Support\Supportamic::hasChat();

        // do we have contact options for email and website?
        $actionEmail = config('supportamic.widget.email', null);
        $actionWebsite = config('supportamic.widget.website', null);

        // should we show the widget?
        // if there is nothing to show, return nothing
        if (!$showGuide && !$actionChat && !$actionEmail && !$actionWebsite) {
            return;
        }

        return VueComponent::render('Supportamic', [
            'show_guide' => $showGuide,

            'action_chat' => $actionChat,
            'action_email' => $actionEmail,
            'action_guide' => $actionGuide,
            'action_website' => $actionWebsite,
        ]);
    }
}
