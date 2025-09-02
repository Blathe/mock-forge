<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MockForge | Mock APIs in seconds - no backend required.</title>

    <meta name="description"
        content="MockForge is a tool for rapidly creating mock API endpoints to test front-end applications." />

    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>

<body class="">
    <div class="flex w-full">
        <flux:header container
            class="animate-drop-down shadow-md border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 mb-12 flex-1 order-1">

            <a href="{{ route('endpoints.index') }}"
                class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
                <x-app-logo />
            </a>

            <flux:spacer />


            <nav class="flex flex-row gap-2">
                @auth
                    <a href="{{ route('endpoints.index') }}"
                        class="dark:hover:text-white dark:text-gray-200 transition-all">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endauth
            </nav>
        </flux:header>
    </div>

    <main class="max-w-[1200px] mx-auto p-4">

        <!-- Hero Section -->
        <section class="flex flex-col gap-4 mb-24 text-center animate-fade-in">
            <h1 class="text-foreground text-3xl md:text-4xl lg:text-5xl font-semibold leading-tight">
                Mock APIs in seconds. No backend needed.
            </h1>
            <p class="dark:text-gray-200 text-gray-800 lg:text-lg font-medium leading-relaxed max-w-lg mx-auto">
                Create realistic mock endpoints with custom JSON for prototyping, testing, and front-end development.
            </p>

            <flux:button href="{{ route('endpoints.index') }}" color="emerald" variant="primary" class="self-center">
                Start Forging Now</flux:button>

            <!-- Dashboard preview -->
            <img src="/DashboardPreview.webp" alt="Dashboard preview" width={1160} height={700}
                class="animate-fade-in-up md:w-[80%] h-full object-cover rounded-xl shadow-xl shadow-black/30 mx-auto mt-8" />
        </section>

        <!-- Key Features Section -->
        <section class="mt-24 animate-fade-in">
            <flux:heading size="xl">Key Features</flux:heading>
            <hr class="mb-6" />
            <div class="flex flex-col md:flex-row flex-wrap gap-4">
                <x-card class="hover:dark:bg-zinc-700 hover:bg-gray-50 transition-all">
                    <div class="p-2 dark:bg-zinc-600 bg-zinc-900 dark:bg-zinc-900 rounded-md self-start">
                        <flux:icon name="globe-americas" color="white" />
                    </div>
                    <flux:heading size="lg" class="flex flex-row gap-2">Custom Endpoints</flux:heading>
                    <flux:text size="lg">Quickly create mock URLs with your own JSON structure.
                    </flux:text>
                </x-card>
                <x-card class="hover:dark:bg-zinc-700 hover:bg-gray-50 transition-all">
                    <div class="p-2 dark:bg-zinc-600 bg-zinc-900 dark:bg-zinc-900 rounded-md self-start">
                        <flux:icon name="pencil-square" color="white" />
                    </div>
                    <flux:heading size="lg" class="flex flex-row gap-2">Dynamic JSON Editor</flux:heading>
                    <flux:text size="lg">Built in editor with optional dynamic value generation.
                    </flux:text>
                </x-card>
                <x-card class="hover:dark:bg-zinc-700 hover:bg-gray-50 transition-all">
                    <div class="p-2 dark:bg-zinc-600 bg-zinc-900 dark:bg-zinc-900 rounded-md self-start">
                        <flux:icon name="lock-closed" color="white" />
                    </div>
                    <flux:heading size="lg" class="flex flex-row gap-2">Endpoint Auth</flux:heading>
                    <flux:text size="lg">Add a custom auth token to simulate an authenticated
                        endpoint.
                    </flux:text>
                </x-card>
                <x-card class="hover:dark:bg-zinc-700 hover:bg-gray-50 transition-all">
                    <div class="p-2 dark:bg-zinc-600 bg-zinc-900 dark:bg-zinc-900 rounded-md self-start">
                        <flux:icon name="clock" color="white" />
                    </div>
                    <flux:heading size="lg" class="flex flex-row gap-2">Simulated Delays</flux:heading>
                    <flux:text size="lg">Simulate slow endpoint responses - great for testing
                        animations and placeholders.
                    </flux:text>
                </x-card>
                <x-card class="hover:dark:bg-zinc-700 hover:bg-gray-50 transition-all">
                    <div class="p-2 dark:bg-zinc-600 bg-zinc-900 dark:bg-zinc-900 rounded-md self-start">
                        <flux:icon name="calendar" color="white" />
                    </div>
                    <flux:heading size="lg" class="flex flex-row gap-2">Endpoint History</flux:heading>
                    <flux:text size="lg">View the history of your endpoints, including payload
                        size and response times.
                    </flux:text>
                </x-card>
            </div>
        </section>

        <!-- Built With -->
        <section class="mt-24 animate-fade-in">
            <flux:heading size="xl">Built With</flux:heading>
            <hr class="mb-6" />
            <div class="flex flex-row flex-wrap gap-2">
                <p class="p-4 border border-zinc-800/25 dark:border-gray-100/25 rounded-md shadow-md w-fit font-semibold">Laravel</p>
                <p class="p-4 border border-zinc-800/25 dark:border-gray-100/25 rounded-md shadow-md w-fit font-semibold">Livewire</p>
                <p class="p-4 border border-zinc-800/25 dark:border-gray-100/25 rounded-md shadow-md w-fit font-semibold">AlpineJS</p>
                <p class="p-4 border border-zinc-800/25 dark:border-gray-100/25 rounded-md shadow-md w-fit font-semibold">TailwindCSS</p>
            </div>
        </section>

    </main>
    <footer class="flex w-full border-t mt-24 p-8">
        <div class="max-w-[1320px] mx-auto">
            <p>&copy; 2025 - MockForge
        </div>
    </footer>
    @fluxScripts
</body>

</html>
