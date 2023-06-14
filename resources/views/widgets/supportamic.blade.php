<div id="supportamic-widget" class="card p-0 overflow-hidden h-full">
    <div class="border-b">
        <div class="flex justify-between items-center p-4">
            <h2 class="flex">
                <div class="h-6 w-6 mr-2 text-gray-800">
                    @supportamic_svg('supportamic')
                </div>
                <div class="-mt-px">
                    <div>{{ __('supportamic::supportamic.widget.title') }}</div>
                    <div class="content">
                        <p>{{ __('supportamic::supportamic.widget.intro') }}</p>
                    </div>
                </div>
            </h2>
        </div>
    </div>

    @if ($showGuide)
    <div class="border-b p-4">
        <div class="content">
            <h3>{{ __('supportamic::supportamic.widget.guide.title') }}</h3>
            <p>{{ __('supportamic::supportamic.widget.guide.intro') }}</p>
        </div>
        <div class="text-center mt-4">
            <a href="{{ $actionGuide }}"
               class="btn-primary"
               target="_blank"
               title="{{ __('supportamic::supportamic.widget.guide.view') }}">{{ __('supportamic::supportamic.widget.guide.view') }}</a>
        </div>
    </div>
    @endif

    @if ($actionChat || $actionEmail || $actionWebsite)
    <div>
        <div class="content p-4">
            <h3>{{ __('supportamic::supportamic.widget.support.title') }}</h3>
            <p>{{ __('supportamic::supportamic.widget.support.intro') }}</p>
            <p>{{ __('supportamic::supportamic.widget.support.intro_2') }}</p>
            <p>{{ __('supportamic::supportamic.widget.support.intro_3') }}</p>
        </div>

        <div class="flex flex-wrap justify-center text-sm mb-4">

            @if ($actionChat)
            <div class="action">
                <button class="supportamic-chat-trigger
                               disabled
                               h-full w-full flex flex-col text-center block p-4 rounded-md group hover:bg-gray-200"
                        disabled
                        title="{{ __('supportamic::supportamic.widget.support.action_chat') }}">
                    <span class="mb-2 inline-block h-8 w-8 mx-auto text-gray-800">
                        @supportamic_svg('conversation')
                    </span>
                    <div class="label text-blue font-semibold">{{ __('supportamic::supportamic.widget.support.action_chat') }}</div>
                </button>
            </div>
            @endif

            @if ($actionEmail)
            <div class="action">
                <a href="mailto:{{ $actionEmail }}"
                   class="h-full w-full flex flex-col text-center block p-4 rounded-md group hover:bg-gray-200"
                   title="{{ __('supportamic::supportamic.widget.support.action_email') }}">
                    <span class="mb-2 inline-block h-8 w-8 mx-auto text-gray-800">
                        @supportamic_svg('email')
                    </span>
                    <div class="text-blue font-semibold">{{ __('supportamic::supportamic.widget.support.action_email') }}</div>
                </a>
            </div>
            @endif

            @if ($actionWebsite)
            <div class="action">
                <a href="{{ $actionWebsite }}"
                   class="h-full w-full flex flex-col text-center block p-4 rounded-md group hover:bg-gray-200"
                   target="_blank"
                   title="{{ __('supportamic::supportamic.widget.support.action_website') }}">
                    <span class="mb-2 inline-block h-8 w-8 mx-auto text-gray-800">
                        @supportamic_svg('website')
                    </span>
                    <div class="text-blue font-semibold">{{ __('supportamic::supportamic.widget.support.action_website') }}</div>
                </a>
            </div>
            @endif
        </div>

    </div>
    @endif
</div>
