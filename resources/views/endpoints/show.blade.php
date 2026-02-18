<x-layouts.app :title="__('Endpoint Details')">

    @if (session()->has('success'))
        <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
        <div class="flex flex-col gap-1.5">
            <a href="{{ route('endpoints.index') }}"
                class="flex items-center gap-1 text-xs font-medium text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200 transition-colors w-fit">
                <flux:icon name="arrow-left" class="size-3.5" />
                Back to Endpoints
            </a>
            <div class="flex flex-wrap items-center gap-2 mt-1">
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $endpoint->description }}</h1>
                <flux:badge size="sm" color="{{ $endpoint->getMethodColor() }}">{{ $endpoint->method }}</flux:badge>
                @if ($endpoint->require_auth)
                    <flux:badge size="sm" color="orange" icon="lock-closed">Auth</flux:badge>
                @endif
            </div>
            <div class="flex items-center gap-1.5">
                <span class="size-2 rounded-full {{ $endpoint->is_public ? 'bg-emerald-500' : 'bg-zinc-400 dark:bg-zinc-600' }}"></span>
                <span class="text-xs font-medium {{ $endpoint->is_public ? 'text-emerald-600 dark:text-emerald-400' : 'text-zinc-400 dark:text-zinc-500' }}">
                    {{ $endpoint->getVisibilityLabel() }}
                </span>
            </div>
        </div>
        <div class="flex gap-2 flex-shrink-0">
            <flux:modal.trigger name="view-history-modal">
                <flux:button icon="clock">History</flux:button>
            </flux:modal.trigger>
            <flux:modal.trigger name="edit-endpoint">
                <flux:button icon="pencil-square">Edit</flux:button>
            </flux:modal.trigger>
            <flux:modal.trigger name="test-endpoint">
                <flux:button variant="primary" color="emerald" icon="play">Test Endpoint</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        <!-- JSON Editor — takes up left 2/3 -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                <livewire:json-editor :endpoint="$endpoint" />
            </div>
        </div>

        <!-- Right Sidebar — 1/3 -->
        <div class="flex flex-col gap-4">

            <!-- Endpoint URL -->
            <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-700 p-5">
                <p class="text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-widest mb-3">Endpoint URL</p>
                <div x-data="{ copied: false }" class="flex gap-2 items-start">
                    <code x-ref="fullUrl"
                        class="flex-1 text-xs font-mono text-zinc-700 dark:text-zinc-300 bg-zinc-100 dark:bg-zinc-800 px-3 py-2.5 rounded-lg break-all leading-relaxed">{{ route('api.user.show', ['user_id' => $endpoint->user_id, 'slug' => $endpoint->slug]) }}</code>
                    <button
                        @click="navigator.clipboard.writeText($refs.fullUrl.innerText); copied = true; setTimeout(() => copied = false, 2000)"
                        class="flex-shrink-0 p-2 rounded-lg bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors">
                        <flux:icon x-show="!copied" name="clipboard" class="size-4 text-zinc-500" />
                        <flux:icon x-show="copied" name="check" class="size-4 text-emerald-500" />
                    </button>
                </div>
            </div>

            <!-- Details -->
            <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-700 p-5">
                <p class="text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-widest mb-1">Details</p>
                <div class="flex flex-col divide-y divide-zinc-100 dark:divide-zinc-800">
                    <div class="flex items-center justify-between py-3">
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">Status</span>
                        <flux:badge size="sm" color="{{ $endpoint->getVisibilityColor() }}">{{ $endpoint->getVisibilityLabel() }}</flux:badge>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">Method</span>
                        <flux:badge size="sm" color="{{ $endpoint->getMethodColor() }}">{{ $endpoint->method }}</flux:badge>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">Status Code</span>
                        <span class="text-sm font-semibold text-zinc-900 dark:text-white">{{ $endpoint->status_code }}</span>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">Total Requests</span>
                        <span class="text-sm font-semibold text-zinc-900 dark:text-white">{{ number_format($endpoint->request_count) }}</span>
                    </div>
                    @if ($endpoint->delay_ms)
                        <div class="flex items-center justify-between py-3">
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">Delay</span>
                            <span class="text-sm font-semibold text-zinc-900 dark:text-white">{{ $endpoint->delay_ms }}ms</span>
                        </div>
                    @endif
                    @if ($endpoint->require_auth)
                        <div class="flex flex-col gap-1.5 py-3">
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">Auth Token</span>
                            <code class="text-xs font-mono text-zinc-700 dark:text-zinc-300 bg-zinc-100 dark:bg-zinc-800 px-2.5 py-2 rounded-lg break-all">{{ $endpoint->auth_token }}</code>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Response Headers -->
            <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-700 p-5">
                <p class="text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-widest mb-1">Response Headers</p>
                <div class="flex flex-col divide-y divide-zinc-100 dark:divide-zinc-800">
                    <div class="flex items-center justify-between py-3">
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">Content-Type</span>
                        <code class="text-xs font-mono text-zinc-700 dark:text-zinc-300">application/json</code>
                    </div>
                    @if ($endpoint->require_auth)
                        <div class="flex items-center justify-between py-3">
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">Authorization</span>
                            <code class="text-xs font-mono text-zinc-700 dark:text-zinc-300">Bearer</code>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- Edit Endpoint Modal -->
    <flux:modal name="edit-endpoint" class="w-full md:max-w-lg">
        <livewire:edit-endpoint-modal :endpoint="$endpoint" />
    </flux:modal>

    <!-- Test Endpoint Modal -->
    <flux:modal name="test-endpoint" class="md:w-screen">
        <livewire:test-endpoint-modal :endpoint="$endpoint" />
    </flux:modal>

    <!-- History Modal -->
    <flux:modal name="view-history-modal" class="md:w-full">
        <livewire:endpoint-history-modal :endpoint="$endpoint" />
    </flux:modal>

</x-layouts.app>
