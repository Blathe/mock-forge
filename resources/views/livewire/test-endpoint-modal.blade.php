<form wire:submit="makeRequest">
    <flux:heading size="xl" class="mb-4">
        {{ __('Test Endpoint: /' . $endpoint->slug) }}
        <flux:text>{{ $endpoint->getFullUrl() }}</flux:text>
    </flux:heading>

    <flux:button variant="primary" color="blue" type="submit" class="mb-4">Make Request</flux:button>

    <!-- <flux:heading>{{ __('Results') }}</flux:heading> -->
    <flux:heading>{{ __('Response Details') }}</flux:heading>
    <flux:heading>{{ __('Status Code') }}</flux:heading>
    <flux:text>
        {{ $statusCode }}
    </flux:text>

    <flux:textarea label="Payload Results" wire:model="payload" disabled />

    @if (!$endpoint->is_public)
        <flux:text class="mt-4 text-red-300">
            This endpoint is currently not accepting requests. Set it to public to test it.
        </flux:text>
    @endif
</form>
