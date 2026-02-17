<div class="space-y-4">

    <!-- Header -->
    <div>
        <p class="text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-widest mb-1">Request History</p>
        <p class="text-sm text-zinc-500 dark:text-zinc-400">
            Last {{ $modal_history_count }} requests to this endpoint. Test requests are not included.
        </p>
    </div>

    @if ($histories->isEmpty())
        <div class="flex flex-col items-center justify-center py-12 text-center">
            <div class="p-3 bg-zinc-100 dark:bg-zinc-800 rounded-xl mb-3">
                <flux:icon name="clock" class="text-zinc-400 dark:text-zinc-500" />
            </div>
            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-300">No requests yet</p>
            <p class="text-xs text-zinc-400 dark:text-zinc-500 mt-1">Requests will appear here once the endpoint is hit.</p>
        </div>
    @else
        <div class="flex flex-col gap-2">
            @foreach ($histories as $history)
                <div class="flex items-center gap-4 px-4 py-3 bg-zinc-50 dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700">
                    <span class="text-xs font-mono text-zinc-400 dark:text-zinc-500 flex-1">
                        {{ $history->created_at->format('Y-m-d H:i:s') }}
                    </span>
                    <div class="flex items-center gap-4">
                        <span class="text-xs text-zinc-400 dark:text-zinc-500">{{ number_format($history->payload_size) }}B</span>
                        <span class="flex items-center gap-1 text-xs font-medium text-zinc-600 dark:text-zinc-300">
                            <flux:icon name="clock" class="size-3.5 text-zinc-400" />
                            {{ (int) $history->response_time_ms }}ms
                        </span>
                        <flux:badge size="sm" color="{{ $history->getStatusCodeColor() }}">{{ $history->status_code }}</flux:badge>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
