<x-layouts.app :title="__('Endpoints')">
    <h1 class="font-bold text-2xl">Endpoint Dashboard</h1>
    <p class="dark:text-gray-300 text-gray-800">Monitor the status and performance of your API endpoints.</p>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl mt-4">
        <div class="auto-rows-min gap-4 md:grid-cols-2 hidden md:grid">
            <livewire:dashboard-card title="Active Endpoints" icon="check-circle" :number="$endpoints->where('is_public', '=', 'true')->count()" color="green" lower_text="Running normally" />
            <livewire:dashboard-card title="Inactive Endpoints" icon="minus-circle" :number="$endpoints->where('is_public', '!=', 'true')->count()" color="red" lower_text="Not accepting requests"/>
        </div>
        <livewire:dashboard-endpoint-list :endpoints="$endpoints" />
    </div>
</x-layouts.app>
