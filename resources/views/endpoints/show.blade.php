<x-layouts.app :title="__('Endpoint Details')">
    <div class="flex flex-col items-start md:flex-row md:justify-between mb-4 gap-y-8">
        <flux:button class="order-1" href="{{ route('endpoints.index') }}">
            <x-icon name="arrow-left" />
            {{ __('Back to Endpoints') }}
        </flux:button>
        <flux:heading size="xl" class="order-2">
            <span class="flex flex-row gap-2 items-center">
                {{ $endpoint->description }}
                <flux:badge size="sm" color="{{ $endpoint->getMethodColor() }}">{{ $endpoint->method }}
                </flux:badge>
            </span>
            <flux:text>{{ $endpoint->getUrlSuffix() }}</flux:text>
        </flux:heading>
        <flux:button variant="primary" color="blue" class="w-full order-3 md:w-auto "
            href="{{ route('endpoints.index') }}">
            <x-icon name="play" />
            {{ __('Test Endpoint') }}
        </flux:button>
    </div>

    <div class="grid grid-rows-auto md:grid-cols-5 md:gap-x-4">
        <x-card class="mb-4 md:col-span-2">
            <flux:heading size="lg" class="mb-6">
                {{ __('Endpoint Information') }}
            </flux:heading>

            <flux:text class="font-semibold">URL</flux:text>
            <div class="flex flex-row gap-2 mb-2" x-data="{ copied: false, tooltip: 'Copy URL' }">
                <flux:text x-ref="fullUrl"
                    class="flex-1 font-semibold text-gray-800 dark:text-gray-300 bg-gray-100 dark:bg-zinc-700 p-2 rounded transition-all">
                    {{ $endpoint->getFullUrl() }}
                </flux:text>
                <flux:tooltip x-bind:content="tooltip" position="top" class="transition-all">
                    <flux:button size="base" class="hover:cursor-pointer" x-bind:disabled="copied ? true : false"
                        @click="navigator.clipboard.writeText($refs.fullUrl.innerText); copied = true;"
                        x-text="copied ? 'Copied!' : 'Copy'">
                        Copied
                    </flux:button>
                </flux:tooltip>
            </div>

            <flux:text class="font-semibold">Method</flux:text>
            <flux:badge class="self-start" color="{{ $endpoint->getMethodColor() }}">{{ $endpoint->method }}
            </flux:badge>
        </x-card>

        <x-card class="mb-4 md:col-span-2 md:row-2">
            <flux:heading size="lg">
                {{ __('Headers') }}
            </flux:heading>

            <div>
                <div class="flex flex-row justify-between">
                    <flux:text class="font-semibold">Content-Type</flux:text>
                    <flux:text>application/json</flux:text>
                </div>
                <flux:separator />
                <div class="flex flex-row justify-between">
                    <flux:text class="font-semibold">Headers</flux:text>
                    <flux:text>Bearer Token</flux:text>
                </div>
            </div>
        </x-card>

        <x-card class="md:col-span-3">
            <flux:heading size="lg">
                {{ __('Payload') }}
            </flux:heading>
        </x-card>
    </div>
</x-layouts.app>
