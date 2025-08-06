<div>
    <flux:heading class="mb-6" size="xl">
        {{ __('Endpoint History') }}
        <flux:text>Displaying up to the last 20 requests made to this endpoint.</flux:text>
    </flux:heading>
    @foreach ($histories as $history)
        <x-card class="flex flex-row items-center justify-between gap-4 mb-4">
            <div class="flex flex-col gap-2 flex-1">
                <flux:heading class="flex flex-row gap-2 items-center">
                    {{ $history->created_at }}
                </flux:heading>
            </div>
            <div class="flex flex-col items-end mr-8">
                <span class="flex flex-row gap-2 font-semibold items-center">
                    <flux:icon class="size-5" color="gray" name="clock" />
                    {{ (int) $history->response_time_ms }}ms
                </span>
            </div>
            <flux:badge color="green">{{ $history->status_code }}</flux:badge>
        </x-card>
    @endforeach
</div>
