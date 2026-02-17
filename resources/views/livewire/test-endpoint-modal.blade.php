<div class="space-y-5">

    <!-- Header -->
    <div>
        <p class="text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-widest mb-1">Test Endpoint</p>
        <h2 class="text-xl font-bold text-zinc-900 dark:text-white">{{ $endpoint->description }}</h2>
    </div>

    <!-- Endpoint pill -->
    <div class="flex flex-wrap items-center gap-2 px-3 py-2.5 bg-zinc-100 dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700">
        <flux:badge size="sm" color="{{ $endpoint->getMethodColor() }}">{{ $endpoint->method }}</flux:badge>
        <code class="text-xs font-mono text-zinc-600 dark:text-zinc-400 break-all flex-1">{{ $endpoint->getFullUrl() }}</code>
        <span class="flex items-center gap-1.5 text-xs font-medium {{ $endpoint->is_public ? 'text-emerald-600 dark:text-emerald-400' : 'text-zinc-400 dark:text-zinc-500' }} flex-shrink-0">
            <span class="size-1.5 rounded-full {{ $endpoint->is_public ? 'bg-emerald-500' : 'bg-zinc-400 dark:bg-zinc-600' }}"></span>
            {{ $endpoint->is_public ? 'Active' : 'Inactive' }}
        </span>
    </div>

    @if (!$endpoint->is_public)
        <div class="px-4 py-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-700 dark:text-amber-400 text-sm font-medium">
            This endpoint is not currently accepting requests. Activate it from the dashboard first.
        </div>
    @endif

    <!-- Action -->
    <form wire:submit="makeRequest">
        <flux:button variant="primary" color="emerald" type="submit" icon="play" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="makeRequest">Make Request</span>
            <span wire:loading wire:target="makeRequest">Sending...</span>
        </flux:button>
    </form>

    <!-- Response -->
    @if ($statusCode || $payload)
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <div class="flex items-center justify-between px-4 py-3 bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
                <p class="text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-widest">Response</p>
                @if ($statusCode)
                    <flux:badge size="sm" color="{{ $statusCode >= 200 && $statusCode < 300 ? 'green' : ($statusCode >= 400 && $statusCode < 500 ? 'orange' : 'red') }}">
                        {{ $statusCode }}
                    </flux:badge>
                @endif
            </div>
            @if ($payload)
                <pre class="text-xs font-mono text-zinc-700 dark:text-zinc-300 p-4 overflow-auto max-h-80 bg-white dark:bg-zinc-950 leading-relaxed">{{ $payload }}</pre>
            @else
                <p class="text-sm text-zinc-500 dark:text-zinc-400 p-4">No response body.</p>
            @endif
        </div>
    @endif

</div>
