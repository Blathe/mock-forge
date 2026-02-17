<div class="space-y-5">

    <!-- Header -->
    <div>
        <p class="text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-widest mb-1">Test Endpoint</p>
        <h2 class="text-xl font-bold text-zinc-900 dark:text-white">{{ $endpoint->description }}</h2>
        <code class="text-xs font-mono text-zinc-500 dark:text-zinc-400 break-all">{{ $endpoint->getFullUrl() }}</code>
    </div>

    @if (!$endpoint->is_public)
        <div class="px-4 py-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-700 dark:text-amber-400 text-sm font-medium">
            This endpoint is not currently accepting requests. Activate it from the dashboard first.
        </div>
    @endif

    <form wire:submit="makeRequest">
        <flux:button variant="primary" color="emerald" type="submit" icon="play">Make Request</flux:button>
    </form>

    <!-- Response -->
    @if ($statusCode || $payload)
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <div class="flex items-center justify-between px-4 py-3 bg-zinc-50 dark:bg-zinc-800 border-b border-zinc-200 dark:border-zinc-700">
                <p class="text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-widest">Response</p>
                @if ($statusCode)
                    <flux:badge size="sm" color="{{ $statusCode == 200 ? 'green' : ($statusCode >= 400 && $statusCode < 500 ? 'orange' : 'red') }}">
                        {{ $statusCode }}
                    </flux:badge>
                @endif
            </div>
            @if ($payload)
                <pre class="text-xs font-mono text-zinc-700 dark:text-zinc-300 p-4 overflow-auto max-h-72 bg-white dark:bg-zinc-900 leading-relaxed">{{ $payload }}</pre>
            @else
                <p class="text-sm text-zinc-500 dark:text-zinc-400 p-4">No response body.</p>
            @endif
        </div>
    @endif

</div>
