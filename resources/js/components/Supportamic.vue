<script setup>
import { Badge, Widget, Icon, Button, Text } from '@statamic/cms/ui';
import { ref } from 'vue';

const props = defineProps([
    'show_guide',

    'action_chat',
    'action_email',
    'action_guide',
    'action_website',

    'server_ip',
    'server_hostname'
]);

const copied = ref(null);
const isHttps = window.location.protocol === 'https:';

async function copyToClipboard(property) {
    try {
        await navigator.clipboard.writeText(props[property]);
        copied.value = property;
        setTimeout(() => copied.value = null, 2500);
    } catch (error) {
        console.error('Failed to copy:', error);
    }
}
</script>

<template>

    <Widget icon="supportamic::supportamic"
            :title="__('supportamic::supportamic.widget.title')">

        <template #actions>
            <template v-if="server_ip">
                <button class="relative"
                        :class="{
                            'cursor-pointer' : isHttps,
                            'pointer-events-none' : !isHttps,
                        }"
                        @click.prevent="copyToClipboard('server_ip')">
                    <Badge :class="{ '!text-transparent' : copied === 'server_ip' }"
                           color="lime">{{ server_ip }}</Badge>
                    <Text class="absolute inset-0 flex items-center justify-center transition-opacity opacity-0"
                          :class="{ 'opacity-100' : copied === 'server_ip' }"
                          size="sm"
                          variant="subtle">
                        Copied!
                    </Text>
                </button>
            </template>
            <template v-if="server_hostname">
                <button class="relative"
                        :class="{
                            'cursor-pointer' : isHttps,
                            'pointer-events-none' : !isHttps,
                        }"
                        @click.prevent="copyToClipboard('server_hostname')">
                    <Badge :class="{ '!text-transparent' : copied === 'server_hostname' }"
                           color="sky">{{ server_hostname }}</Badge>
                    <Text class="absolute inset-0 flex items-center justify-center transition-opacity opacity-0"
                          :class="{ 'opacity-100' : copied === 'server_hostname' }"
                          size="sm"
                          variant="subtle">
                        Copied!
                    </Text>
                </button>
            </template>
        </template>

        <div v-if="show_guide"
             class="border-b border-gray-200 dark:border-gray-700 px-4.5 py-4">
            <div class="prose prose-sm max-w-full dark:prose-invert">
                <h3>{{ __('supportamic::supportamic.widget.guide.title') }}</h3>
                <p>{{ __('supportamic::supportamic.widget.guide.intro') }}</p>
            </div>
            <div class="text-center mt-4">
                <Button
                    :href="action_guide"
                    variant="primary"
                    target="_blank"
                    :text="__('supportamic::supportamic.widget.guide.view')"
                    iconAppend="arrow-up-right"
                ></Button>
            </div>
        </div>

        <div v-if="action_chat || action_email || action_website"
             class="px-4.5 py-4">
            <div class="prose prose-sm max-w-full dark:prose-invert">
                <h3>{{ __('supportamic::supportamic.widget.support.title') }}</h3>
                <p>{{ __('supportamic::supportamic.widget.support.intro') }}</p>
                <p>{{ __('supportamic::supportamic.widget.support.intro_2') }}</p>
                <p>{{ __('supportamic::supportamic.widget.support.intro_3') }}</p>
            </div>

            <div class="flex flex-wrap gap-x-4 gap-y-4 justify-center text-sm pt-4">

                <div v-if="action_chat"
                     class="w-full sm:!w-1/2 lg:!w-1/3 xl:!w-1/5">
                    <Button
                        class="supportamic-chat-trigger disabled flex w-full h-auto p-3"
                        target="_blank"
                        disabled
                    >
                        <div class="flex flex-col items-center gap-y-2 w-full">
                            <Icon :name="action_chat === 'action_ticket' ? 'lifebuoy' : 'conversation'" set="supportamic" class="size-8"/>
                            <div class="font-semibold">{{ __('supportamic::supportamic.widget.support.' + action_chat) }}</div>
                        </div>
                    </Button>
                </div>

                <div v-if="action_email"
                     class="w-full sm:!w-1/2 lg:!w-1/3 xl:!w-1/5">
                    <Button
                        :href="action_email"
                        class="flex w-full h-auto p-3"
                        target="_blank"
                    >
                        <div class="flex flex-col items-center gap-y-2 w-full">
                            <Icon name="email" set="supportamic" class="size-8"/>
                            <div class="font-semibold">{{ __('supportamic::supportamic.widget.support.action_email') }}</div>
                        </div>
                    </Button>
                </div>

                <div v-if="action_website"
                     class="w-full sm:!w-1/2 lg:!w-1/3 xl:!w-1/5">
                    <Button
                        :href="action_website"
                        class="flex w-full h-auto p-3"
                        target="_blank"
                    >
                        <div class="flex flex-col items-center gap-y-2 w-full">
                            <Icon name="website" set="supportamic" class="size-8"/>
                            <div class="font-semibold">{{ __('supportamic::supportamic.widget.support.action_website') }}</div>
                        </div>
                    </Button>
                </div>

            </div>
        </div>
    </Widget>
</template>