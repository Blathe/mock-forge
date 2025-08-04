<x-layouts.app :title="__('Endpoints')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-center h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <livewire:create-endpoint-form />
        </div>
    </div>
</x-layouts.app>
