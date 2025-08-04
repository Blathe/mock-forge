<x-card>
    <div class="flex items-center justify-between">
        <flux:heading>{{ $title }}</flux:heading>
        <span><flux:icon name="{{ $icon }}" color="{{ $color }}"/></span>
    </div>
    <div class="">
        <flux:heading size="xl" class="text-{{ $color }}-600 font-bold text-3xl">{{ $number }}</flux:heading>
        <flux:text class="text-sm text-gray-800 dark:text-gray-300">{{ $lower_text }}</flux:text>
    </div>
</x-card>