<div>
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-2 mb-4">
        <form>
            <flux:input kbd="⌘K" icon="magnifying-glass" placeholder="Search..." />
        </form>
        <div class="flex gap-2 items-center">
            <flux:select placeholder="By status">
                <flux:select.option>Active</flux:select.option>
                <flux:select.option>Disabled</flux:select.option>
            </flux:select>
            <flux:modal.trigger name="create-endpoint">
                <flux:button color="green" variant="primary" icon="plus">Create Endpoint</flux:button>
            </flux:modal.trigger>
            <flux:modal name="create-endpoint" class="md:w-full w-full">
                <livewire:create-endpoint-form />
            </flux:modal>
        </div>
    </div>
    @if ($endpoints->isEmpty())
        <div class="text-center text-gray-500 dark:text-gray-400 items-center flex flex-col justify-center h-64">
            <p>No endpoints found. Create one to get started.</p>
        </div>
    @endif
    @foreach ($endpoints as $endpoint)
        <x-card class="flex flex-row items-center justify-between gap-4 mb-4">
            <flux:icon name="check-circle" color="{{$endpoint->getVisibilityColor()}}" />
            <div class="flex flex-col gap-2 flex-1">
                <flux:heading size="lg" class="flex flex-row gap-2 items-center">
                        {{ $endpoint->description }}
                        <flux:badge variant="solid" color="{{ $endpoint->getMethodColor() }}">{{ $endpoint->method }} </flux:badge>
                        @if ($endpoint->require_auth)
                            <flux:icon variant="solid" name="lock-closed" color="orange">Public</flux:badge>
                        @endif
                </flux:heading>
                <p class="text-sm dark:text-gray-300 text-gray-800">/api/userid/{{ $endpoint->slug }}</p>
            </div>
            <div class="flex flex-col items-end mr-8">
                <flux:badge variant="solid" color="{{ $endpoint->getVisibilityColor()}}">{{ $endpoint->getVisibility() }}</flux:badge>
                <p class="text-xs dark:text-gray-300 text-gray-800 mt-1">Last request: 2m</p>
            </div>
            <flux:dropdown>
                <flux:button icon:trailing="ellipsis-horizontal"></flux:button>
                <flux:menu>
                    <flux:menu.item icon="plus">Details</flux:menu.item>
                    <flux:menu.separator />
                    <flux:modal.trigger name="delete-endpoint-{{ $endpoint->id }}">
                        <flux:menu.item variant="danger" icon="trash">Delete</flux:menu.item>
                    </flux:modal.trigger>
                </flux:menu>
            </flux:dropdown>
        </x-card>

        <flux:modal name="delete-endpoint-{{ $endpoint->id }}" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Delete endpoint?</flux:heading>
                    <flux:text class="mt-2">
                        <p>You're about to delete this endpoint.</p>
                        <p>This action cannot be reversed.</p>
                    </flux:text>
                </div>
                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="danger" wire:click="deleteEndpoint({{ $endpoint->id }})">Delete Endpoint</flux:button>
                </div>
            </div>
        </flux:modal>
    @endforeach
</div>
