<div>
    <!-- Toolbar -->
    <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-5">
        <form wire:input.debounce.750ms="search" class="flex-1">
            <flux:input wire:model="search_string" kbd="⌘K" icon="magnifying-glass" placeholder="Search endpoints..." />
        </form>
        <div class="flex gap-2 items-center flex-none">
            <flux:select class="w-40" placeholder="By status">
                <flux:select.option>Active</flux:select.option>
                <flux:select.option>Disabled</flux:select.option>
            </flux:select>
            <flux:modal.trigger name="create-endpoint">
                <flux:button color="emerald" variant="primary" icon="plus">New Endpoint</flux:button>
            </flux:modal.trigger>
            <flux:modal name="create-endpoint" class="w-screen">
                <livewire:create-endpoint-form />
            </flux:modal>
        </div>
    </div>

    <!-- Empty State -->
    @if ($endpoints->isEmpty())
        <div class="flex flex-col items-center justify-center h-64 rounded-2xl border border-dashed border-zinc-300 dark:border-zinc-700 text-center px-4">
            <div class="p-3 bg-zinc-100 dark:bg-zinc-800 rounded-xl mb-4">
                <flux:icon name="globe-americas" class="text-zinc-400 dark:text-zinc-500" />
            </div>
            <p class="font-medium text-zinc-700 dark:text-zinc-300 mb-1">No endpoints yet</p>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-4">Create your first mock endpoint to get started.</p>
            <flux:modal.trigger name="create-endpoint">
                <flux:button color="emerald" variant="primary" size="sm" icon="plus">Create Endpoint</flux:button>
            </flux:modal.trigger>
        </div>
    @endif

    <!-- Endpoint List -->
    <div class="flex flex-col gap-3">
        @foreach ($endpoints as $endpoint)
            <div class="group bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-700 px-5 py-4 flex items-center gap-4 hover:border-zinc-300 dark:hover:border-zinc-700 transition-all duration-150 hover:shadow-sm">

                <!-- Status dot -->
                <div class="flex-shrink-0">
                    <span class="block size-2.5 rounded-full {{ $endpoint->is_public ? 'bg-emerald-500' : 'bg-zinc-400 dark:bg-zinc-600' }}"></span>
                </div>

                <!-- Main info -->
                <div class="flex flex-col gap-1 flex-1 min-w-0">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="font-semibold text-zinc-900 dark:text-white truncate">
                            {{ $endpoint->description }}
                        </span>
                        <flux:badge size="sm" color="{{ $endpoint->getMethodColor() }}">{{ $endpoint->method }}</flux:badge>
                        @if ($endpoint->require_auth)
                            <flux:badge size="sm" color="orange" icon="lock-closed">Auth</flux:badge>
                        @endif
                    </div>
                    <p class="text-xs font-mono text-zinc-400 dark:text-zinc-500 truncate">
                        {{ $endpoint->getUrlSuffix() }}
                    </p>
                </div>

                <!-- Metadata -->
                <div class="hidden md:flex items-center gap-5 flex-shrink-0">
                    @if($endpoint->delay_ms)
                        <div class="flex flex-col items-end">
                            <span class="flex items-center gap-1 text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                <flux:icon name="clock" class="size-3.5 text-zinc-400" />
                                {{ $endpoint->delay_ms }}ms
                            </span>
                            <span class="text-xs text-zinc-400 dark:text-zinc-500">Delay</span>
                        </div>
                    @endif

                    <div class="flex flex-col items-end">
                        <flux:badge size="sm" color="{{ $endpoint->getVisibilityColor() }}">
                            {{ $endpoint->getVisibilityLabel() }}
                        </flux:badge>
                        @if ($endpoint->histories->last())
                            <span class="text-xs text-zinc-400 dark:text-zinc-500 mt-1">
                                {{ $endpoint->histories->last()->created_at->diffForHumans() }}
                            </span>
                        @else
                            <span class="text-xs text-zinc-400 dark:text-zinc-500 mt-1">No requests yet</span>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <flux:dropdown>
                    <flux:button variant="ghost" icon:trailing="ellipsis-horizontal" size="sm"></flux:button>
                    <flux:menu>
                        <flux:menu.item icon="adjustments-horizontal" href="/endpoints/{{ $endpoint->id }}">Details</flux:menu.item>
                        @if ($endpoint->getVisibilityLabel() == "Listening")
                            <flux:menu.item wire:click="toggleEndpointVisibility({{ $endpoint->id }})" icon="eye-slash" color="red">Deactivate</flux:menu.item>
                        @else
                            <flux:menu.item wire:click="toggleEndpointVisibility({{ $endpoint->id }})" icon="eye" color="green">Activate</flux:menu.item>
                        @endif
                        <flux:menu.separator />
                        <flux:modal.trigger name="delete-endpoint-{{ $endpoint->id }}">
                            <flux:menu.item variant="danger" icon="trash">Delete</flux:menu.item>
                        </flux:modal.trigger>
                    </flux:menu>
                </flux:dropdown>
            </div>

            <!-- Delete Confirmation Modal -->
            <flux:modal name="delete-endpoint-{{ $endpoint->id }}" class="w-96">
                <div class="space-y-6">
                    <div>
                        <flux:heading size="lg">Delete endpoint?</flux:heading>
                        <flux:text class="mt-2">
                            <p>You're about to delete <strong>{{ $endpoint->description }}</strong>.</p>
                            <p>This action cannot be reversed.</p>
                        </flux:text>
                    </div>
                    <div class="flex gap-2">
                        <flux:spacer />
                        <flux:modal.close>
                            <flux:button variant="ghost">Cancel</flux:button>
                        </flux:modal.close>
                        <flux:button variant="danger" wire:click="deleteEndpoint({{ $endpoint->id }})">Delete Endpoint</flux:button>
                    </div>
                </div>
            </flux:modal>
        @endforeach
    </div>
</div>
