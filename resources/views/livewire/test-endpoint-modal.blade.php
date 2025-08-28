<form wire:submit="makeRequest">
    <flux:heading size="xl" class="mb-4">
        {{ __('Test Endpoint: /' . $endpoint->slug) }}
        <flux:text>{{ $endpoint->getFullUrl() }}</flux:text>
    </flux:heading>

    <flux:button variant="primary" color="blue" type="submit" class="mb-4">Make Request</flux:button>

    <flux:heading>{{ __('Results') }}</flux:heading>
    <flux:textarea label="Payload Results" wire:model="payload" disabled />
</form>
