<?php

namespace MityDigital\Supportamic\Widgets;

use Illuminate\Support\Facades\Blade;
use Statamic\Widgets\Widget;

class Supportamic extends Widget
{
    /**
     * The HTML that should be shown in the widget.
     *
     * @return string|\Illuminate\View\View
     */
    public function html()
    {
        // set up the Supportamic directive. We only need it here
        Blade::directive('supportamic_svg', function ($expression) {
            return "<?php echo \MityDigital\Supportamic\Support\Supportamic::svg({$expression}) ?>";
        });

        // should we show the guide
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

        return view('supportamic::widgets.supportamic', [
            'showGuide' => $showGuide,

            'actionChat' => $actionChat,
            'actionGuide' => $actionGuide,
            'actionEmail' => $actionEmail,
            'actionWebsite' => $actionWebsite
        ]);
    }
}
