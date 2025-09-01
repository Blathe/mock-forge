<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MockForge | Build and Test Mock APIs Qucikly</title>

    <meta name="description"
        content="MockForge is a tool for rapidly creating mock API endpoints to test front-end applications." />

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
            class="animate-drop-down border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 mb-12 flex-1 order-1">

            <a href="{{ route('endpoints.index') }}"
                class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
                <x-app-logo />
            </a>

            <flux:spacer />


            <nav class="flex flex-row gap-2">
                @auth
                    <a href="{{ route('endpoints.index') }}" class="dark:hover:text-white dark:text-gray-200 transition-all">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endauth
            </nav>
        </flux:header>
    </div>

    <main class="max-w-[1320px] mx-auto p-4">

        <!-- Hero Section -->
        <section class="flex flex-col gap-4 mb-24 text-center animate-fade-in">
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

            <flux:button href="{{ route('endpoints.index') }}" color="emerald" variant="primary" class="self-center">
                Start Forging Now</flux:button>

        </section>

        <!-- Dashboard preview -->
        <img src="dashboard-preview.png" alt="Dashboard preview" width={1160} height={700}
            class="animate-fade-in-up md:w-[80%] h-full object-cover rounded-xl shadow-xl shadow-black/30 mx-auto" />
    </main>
    @fluxScripts
</body>

</html>
