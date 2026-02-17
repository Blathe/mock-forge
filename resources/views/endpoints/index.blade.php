<x-layouts.app :title="__('Endpoints')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-widest mb-1">Dashboard</p>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Endpoints</h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Monitor the status and performance of your mock API endpoints.</p>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="auto-rows-min gap-4 md:grid-cols-2 hidden md:grid">
            <livewire:dashboard-card
                title="Active Endpoints"
                icon="check-circle"
                :number="$endpoints->where('is_public', '=', 'true')->count()"
                color="emerald"
                lower_text="Currently listening for requests" />
            <livewire:dashboard-card
                title="Inactive Endpoints"
                icon="minus-circle"
                :number="$endpoints->where('is_public', '!=', 'true')->count()"
                color="red"
                lower_text="Not accepting requests" />
        </div>

        <!-- Endpoint List -->
        <livewire:dashboard-endpoint-list :endpoints="$endpoints" />

    </div>
</x-layouts.app>
