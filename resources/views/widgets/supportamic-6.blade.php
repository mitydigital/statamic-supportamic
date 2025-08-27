<ui-card inset id="supportamic-widget">
    <div class="min-h-[49px] border-b border-gray-200 px-4.5 py-2 dark:border-gray-700">
        <header class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="size-5 text-gray-500">@supportamic_svg('supportamic')</div>
                <div>{{ __('supportamic::supportamic.widget.title') }}</div>
            </div>
        </header>
        <div class="ml-8 text-xs text-gray-500">
            <p>{{ __('supportamic::supportamic.widget.intro') }}</p>
        </div>
    </div>

    @if ($showGuide)
    <div class="border-b border-gray-200 dark:border-gray-700 px-4.5 py-4">
        <div class="prose prose-sm max-w-full dark:prose-invert">
            <h3>{{ __('supportamic::supportamic.widget.guide.title') }}</h3>
            <p>{{ __('supportamic::supportamic.widget.guide.intro') }}</p>
        </div>
        <div class="text-center mt-4">
            <ui-button
                    href="{{ $actionGuide }}"
                    variant="primary"
                    target="_blank"
                    text="{{ __('supportamic::supportamic.widget.guide.view') }}"
            ></ui-button>
        </div>
    </div>
    @endif

    @if ($actionChat || $actionEmail || $actionWebsite)
    <div class="px-4.5 py-4">
        <div class="prose prose-sm max-w-full dark:prose-invert">
            <h3>{{ __('supportamic::supportamic.widget.support.title') }}</h3>
            <p>{{ __('supportamic::supportamic.widget.support.intro') }}</p>
            <p>{{ __('supportamic::supportamic.widget.support.intro_2') }}</p>
            <p>{{ __('supportamic::supportamic.widget.support.intro_3') }}</p>
        </div>

        <div class="flex flex-wrap gap-x-4 justify-center text-sm pt-4">

            @if ($actionChat)
            <div class="action">
                <ui-button
                        class="supportamic-chat-trigger disabled flex w-full h-auto py-3"
                        target="_blank"
                        disabled
                >
                    <div class="block flex flex-col w-full">
                        <div class="mb-2 inline-block h-8 w-8 mx-auto text-gray-800 dark:text-dark-175">
                            @switch($actionChat)
                                @case('action_ticket')
                                    @supportamic_svg('lifebuoy')
                                    @break
                                @default
                                    @supportamic_svg('conversation')
                            @endswitch
                        </div>
                        <div class="font-semibold">{{ __('supportamic::supportamic.widget.support.' . $actionChat) }}</div>
                    </div>
                </ui-button>
            </div>
            @endif

            @if ($actionEmail)
            <div class="action">
                <ui-button
                        href="mailto:{{ $actionEmail }}"
                        class="flex w-full h-auto py-3"
                        target="_blank"
                >
                    <div class="block flex flex-col w-full">
                        <div class="mb-2 inline-block h-8 w-8 mx-auto text-gray-800 dark:text-dark-175">
                            @supportamic_svg('email')
                        </div>
                        <div class="font-semibold">{{ __('supportamic::supportamic.widget.support.action_email') }}</div>
                    </div>
                </ui-button>
            </div>
            @endif

            @if ($actionWebsite)
            <div class="action">
                <ui-button
                        href="{{ $actionWebsite }}"
                        class="flex w-full h-auto py-3"
                        target="_blank"
                >
                    <div class="block flex flex-col w-full">
                        <div class="mb-2 inline-block h-8 w-8 mx-auto text-gray-800 dark:text-dark-175">
                            @supportamic_svg('website')
                        </div>
                        <div class="font-semibold">{{ __('supportamic::supportamic.widget.support.action_website') }}</div>
                    </div>
                </ui-button>
            </div>
            @endif
        </div>

    </div>
    @endif
</ui-card>
