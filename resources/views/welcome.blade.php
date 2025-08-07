<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>

<body class="bg-gray-100 dark:bg-zinc-900">
    <div class="flex w-full">
        <flux:header container
            class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 mb-12 flex-1 order-1">

            <a href="{{ route('endpoints.index') }}"
                class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
                <x-app-logo />
            </a>

            <flux:spacer />

            <flux:navbar class="-mb-px max-lg:hidden">
                <!--<flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navbar.item>-->
                @auth
                    <flux:navbar.item :href="route('endpoints.index')" :current="request()->routeIs('endpoints.index')"
                        wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:navbar.item>
                @else
                    <flux:navbar.item :href="route('login')" :current="request()->routeIs('login')" wire:navigate>
                        {{ __('Login') }}
                    </flux:navbar.item>
                @endauth

            </flux:navbar>

            <!-- Mobile Menu Toggle -->
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar stashable sticky
            class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse"
                wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')">
                    <flux:navlist.item icon="layout-grid" :href="route('dashboard')"
                        :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit"
                    target="_blank">
                    {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire"
                    target="_blank">
                    {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>
        </flux:sidebar>
    </div>

    <main class="max-w-[1320px] mx-auto p-4">

        <!-- Hero Section -->
        <section class="flex flex-col gap-4 mb-24 text-center">
            <h1 class="text-foreground text-3xl md:text-4xl lg:text-6xl font-semibold leading-tight">
                Forge Mock APIs Quickly
            </h1>
            <p class="dark:text-gray-200 text-gray-800 lg:text-lg font-medium leading-relaxed max-w-lg mx-auto">
                MockForge helps developers simulate powerful, customizable APIs in seconds - no backend
                required.
            </p>
            <p class="dark:text-gray-200 text-gray-800 lg:text-lg font-medium leading-relaxed max-w-lg mx-auto">
                Design, test, and iterate faster with production-grade mock data tailored to
                your
                needs.
            </p>

            <flux:button href="{{ route('endpoints.index') }}" color="sky" variant="primary" class="self-center">
                Start Forging Now</flux:button>

        </section>

        <!-- Dashboard preview -->
        <img src="dashboard-preview.png" alt="Dashboard preview" width={1160} height={700}
                class="md:w-[80%] h-full object-cover rounded-xl shadow-xl shadow-black/30 mx-auto" />
    </main>
    @fluxScripts
</body>

</html>
