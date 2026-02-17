<div class="bg-white dark:bg-zinc-900 rounded-2xl p-6 border border-zinc-200 dark:border-zinc-700 shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ $title }}</p>
        <div class="p-2 rounded-xl
            {{ $color === 'emerald' ? 'bg-emerald-500/10' : '' }}
            {{ $color === 'red' ? 'bg-red-500/10' : '' }}
        ">
            <flux:icon name="{{ $icon }}"
                class="
                    {{ $color === 'emerald' ? 'text-emerald-600 dark:text-emerald-400' : '' }}
                    {{ $color === 'red' ? 'text-red-500 dark:text-red-400' : '' }}
                "
            />
        </div>
    </div>
    <p class="text-3xl font-bold text-zinc-900 dark:text-white mb-1">{{ $number }}</p>
    <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $lower_text }}</p>
</div>
