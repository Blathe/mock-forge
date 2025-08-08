<x-layouts.app :title="__('Endpoint Details')">
    <div class="flex flex-col items-start md:flex-row md:justify-between mb-4 gap-y-8">
        @if (session()->has('success'))
            <p class="text-green-600">{{ session('success') }}</p>
        @endif
        <flux:button class="order-1" href="{{ route('endpoints.index') }}">
            <x-icon name="arrow-left" />
            {{ __('Back to Endpoints') }}
        </flux:button>
        <flux:heading size="xl" class="order-2">
            <span class="flex flex-row gap-2 items-center">
                {{ $endpoint->description }}
                <flux:badge size="sm" color="{{ $endpoint->getMethodColor() }}">{{ $endpoint->method }}
                </flux:badge>
                @if ($endpoint->require_auth)
                    <flux:icon.lock-closed variant="solid" color="orange" />
                @endif
            </span>
            <flux:text>{{ $endpoint->getUrlSuffix() }}</flux:text>
        </flux:heading>
        <flux:button variant="primary" color="blue" class="w-full order-3 md:w-auto "
            href="{{ route('api.user.show', ['user_id' => $endpoint->user_id, 'slug' => $endpoint->slug]) }}">
            <x-icon name="play" />
            {{ __('Test Endpoint') }}
        </flux:button>
    </div>

    <div class="grid md:grid-rows-* md:grid-cols-3 gap-3">
        <!----------- Endpoint Info Card ------------>
        <x-card class="md:col-span-2">
            <div class="w-full">
                <flux:heading size="lg" class="mb-6 flex flex-row justify-between items-center">
                    {{ __('Endpoint Information') }}

                    <!-- Endpoint History Trigger -->
                    <flux:modal.trigger name="view-history-modal">
                        <flux:button icon="clock">History</flux:button>
                    </flux:modal.trigger>

                </flux:heading>
            </div>
            <flux:text class="font-semibold">URL</flux:text>
            <div class="flex flex-row gap-2 mb-2" x-data="{ copied: false, tooltip: 'Copy URL' }">
                <flux:text x-ref="fullUrl"
                    class="flex-1 font-semibold text-gray-800 dark:text-gray-300 bg-gray-100 dark:bg-zinc-700 p-2 rounded-lg transition-all">
                    {{ route('api.user.show', ['user_id' => $endpoint->user_id, 'slug' => $endpoint->slug]) }}
                </flux:text>
                <flux:tooltip x-bind:content="tooltip" position="top" class="transition-all">
                    <flux:button size="base" x-bind:disabled="copied ? true : false"
                        @click="navigator.clipboard.writeText($refs.fullUrl.innerText); copied = true;"
                        x-text="copied ? 'Copied!' : 'Copy'">
                        Copied
                    </flux:button>
                </flux:tooltip>
            </div>

            <flux:text class="font-semibold">Visibility</flux:text>
            @if ($endpoint->is_public)
                <flux:badge class="self-start" color="green">Listening</flux:badge>
            @else
                <flux:badge class="self-start" color="red">Not Listening</flux:badge>
            @endif

            <flux:text class="font-semibold">Method</flux:text>
            <flux:badge class="self-start" color="{{ $endpoint->getMethodColor() }}">{{ $endpoint->method }}
            </flux:badge>

            <flux:text class="font-semibold">Request Count</flux:text>
            <flux:text class="font-semibold">{{ $endpoint->request_count }}</flux:text>

            @if ($endpoint->require_auth)
                <flux:text class="font-semibold">Authorization Token</flux:text>
                <flux:text class="font-semibold">{{ $endpoint->auth_token }}</flux:text>
            @endif
        </x-card>

        <!----------- Header Info Card ------------>
        <x-card class="md:col-span-1 flex justify-start">
            <flux:heading size="lg">
                {{ __('Headers') }}
            </flux:heading>

            <div class="flex flex-row justify-between">
                <flux:text class="font-semibold">Content-Type</flux:text>
                <flux:text>application/json</flux:text>
            </div>
            @if ($endpoint->require_auth)
                <flux:separator />
                <div class="flex flex-row justify-between">
                    <flux:text class="font-semibold">Authorization</flux:text>
                    <flux:text>Bearer</flux:text>
                </div>
            @endif
        </x-card>

        <!----------- JSON Editor Card ------------>
        <x-card class="justify-start md:col-span-3">
            <livewire:json-editor :endpoint="$endpoint"/>
        </x-card>
    </div>

    <!-- Endpoint History Modal -->
    <flux:modal name="view-history-modal" class="md:w-full">
        <livewire:endpoint-history-modal :endpoint="$endpoint" />
    </flux:modal>
</x-layouts.app>
