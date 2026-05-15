<?php

namespace MityDigital\Supportamic\Widgets;

use Statamic\Facades\User;
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

        $server_hostname = null;
        $server_ip = null;

        if (User::current()?->isSuper()) {
            $server_ip = $this->serverIp();
            if ($server_ip) {
                $server_hostname = $this->reverseDnsHostname($server_ip);
            }
            else {
                $server_ip = 'Unavailable';
            }
        }

        return VueComponent::render('Supportamic', [
            'show_guide' => $showGuide,

            'action_chat' => $actionChat,
            'action_email' => $actionEmail,
            'action_guide' => $actionGuide,
            'action_website' => $actionWebsite,

            'server_ip' => $server_ip,
            'server_hostname' => $server_hostname,
        ]);
    }

    protected function serverIp(): ?string
    {
        return $this->normalizeIp($_SERVER['SERVER_ADDR'] ?? null)
            ?? $this->normalizeIp(request()->server('SERVER_ADDR'))
            ?? $this->normalizeIp($this->hostnameIp());
    }

    protected function reverseDnsHostname(?string $ip): string
    {
        if (! $ip) {
            return 'No reverse DNS found';
        }

        $hostname = $this->reverseDnsLookup($ip);

        if (! $hostname || $hostname === $ip) {
            return 'No reverse DNS found';
        }

        return $hostname;
    }

    protected function hostnameIp(): string|false
    {
        $hostname = gethostname();

        if (! $hostname) {
            return false;
        }

        return gethostbyname($hostname);
    }

    protected function reverseDnsLookup(string $ip): string|false
    {
        return gethostbyaddr($ip);
    }

    private function normalizeIp(mixed $ip): ?string
    {
        if (! is_string($ip) || $ip === '') {
            return null;
        }

        if (! filter_var($ip, FILTER_VALIDATE_IP)) {
            return null;
        }

        return $ip;
    }
}
