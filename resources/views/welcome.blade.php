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
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>

<body class="bg-white dark:bg-zinc-950 antialiased">

    <!-- Navigation -->
    <header class="fixed top-0 left-0 right-0 z-50 animate-drop-down px-4 pt-4">
        <div class="max-w-[1200px] mx-auto">
            <div class="backdrop-blur-md bg-white/80 dark:bg-zinc-900/80 border border-zinc-200/70 dark:border-zinc-700/60 rounded-2xl px-5 py-3 flex items-center gap-4 shadow-sm shadow-black/5">
                <a href="/" class="flex items-center gap-2">
                    <x-app-logo />
                </a>

                <div class="flex-1"></div>

                <nav class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('endpoints.index') }}"
                            class="text-sm font-medium text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white transition-colors hidden sm:block">
                            Login
                        </a>
                        <flux:button href="{{ route('register') }}" size="sm" color="emerald" variant="primary">
                            Get Started
                        </flux:button>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <main>

        <!-- Hero Section -->
        <section class="relative flex flex-col items-center justify-center px-4 pt-40 pb-8 overflow-hidden">

            <!-- Background glow -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden">
                <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[500px] rounded-full bg-emerald-500/10 dark:bg-emerald-500/8 blur-3xl"></div>
                <div class="absolute top-1/2 left-1/4 w-[350px] h-[350px] rounded-full bg-teal-400/8 blur-3xl"></div>
            </div>

            <!-- Badge -->
            <div class="animate-fade-in mb-6 relative">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20">
                    <span class="size-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Free &amp; Open Source
                </span>
            </div>

            <!-- Headline -->
            <div class="animate-fade-in text-center max-w-4xl mx-auto relative">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-[1.08] tracking-tight mb-6">
                    <span class="text-zinc-900 dark:text-white">Mock APIs in </span>
                    <span class="bg-gradient-to-r from-emerald-500 to-teal-500 bg-clip-text text-transparent">seconds.</span>
                    <br />
                    <span class="text-zinc-900 dark:text-white">No backend needed.</span>
                </h1>
                <p class="text-lg md:text-xl text-zinc-500 dark:text-zinc-400 leading-relaxed max-w-2xl mx-auto mb-10">
                    Create realistic mock endpoints with custom JSON payloads, simulated delays, and auth tokens — built for faster prototyping and front-end development.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <flux:button href="{{ route('register') }}" color="emerald" variant="primary" size="base">
                        Start Forging Free
                    </flux:button>
                    <flux:button href="{{ route('login') }}" variant="ghost" size="base">
                        Sign In
                    </flux:button>
                </div>
            </div>

            <!-- Dashboard preview -->
            <div class="relative mt-16 w-full max-w-5xl mx-auto animate-fade-in-up">
                <div class="relative rounded-2xl overflow-hidden ring-1 ring-zinc-900/10 dark:ring-white/10 shadow-2xl shadow-black/25">
                    <img src="/DashboardPreview.webp" alt="MockForge Dashboard preview" class="w-full h-auto" />
                    <!-- Fade out bottom -->
                    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-white dark:from-zinc-950 to-transparent pointer-events-none"></div>
                </div>
            </div>
        </section>

        <!-- Key Features Section -->
        <section class="relative max-w-[1200px] mx-auto px-4 py-24 animate-fade-in">

            <div class="text-center mb-14">
                <p class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-widest mb-3">Features</p>
                <h2 class="text-3xl md:text-4xl font-bold text-zinc-900 dark:text-white">Everything you need to mock</h2>
                <p class="mt-4 text-zinc-500 dark:text-zinc-400 max-w-lg mx-auto leading-relaxed">
                    Built for developers who need fast, realistic API simulation without the overhead of a real backend.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                <div class="bg-white dark:bg-zinc-900 rounded-2xl p-6 border border-zinc-200 dark:border-zinc-800 hover:border-emerald-500/40 dark:hover:border-emerald-500/40 transition-all duration-200 hover:shadow-lg hover:shadow-emerald-500/5 group">
                    <div class="p-2.5 bg-emerald-500/10 rounded-xl w-fit mb-4 group-hover:bg-emerald-500/15 transition-colors">
                        <flux:icon name="globe-americas" class="text-emerald-600 dark:text-emerald-400" />
                    </div>
                    <h3 class="font-semibold text-zinc-900 dark:text-white text-lg mb-2">Custom Endpoints</h3>
                    <p class="text-zinc-500 dark:text-zinc-400 text-sm leading-relaxed">Quickly create mock URLs with your own JSON structure and share them instantly with your team.</p>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-2xl p-6 border border-zinc-200 dark:border-zinc-800 hover:border-emerald-500/40 dark:hover:border-emerald-500/40 transition-all duration-200 hover:shadow-lg hover:shadow-emerald-500/5 group">
                    <div class="p-2.5 bg-emerald-500/10 rounded-xl w-fit mb-4 group-hover:bg-emerald-500/15 transition-colors">
                        <flux:icon name="pencil-square" class="text-emerald-600 dark:text-emerald-400" />
                    </div>
                    <h3 class="font-semibold text-zinc-900 dark:text-white text-lg mb-2">Dynamic JSON Editor</h3>
                    <p class="text-zinc-500 dark:text-zinc-400 text-sm leading-relaxed">Built-in CodeMirror editor with optional Faker templates for generating realistic dynamic values.</p>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-2xl p-6 border border-zinc-200 dark:border-zinc-800 hover:border-emerald-500/40 dark:hover:border-emerald-500/40 transition-all duration-200 hover:shadow-lg hover:shadow-emerald-500/5 group">
                    <div class="p-2.5 bg-emerald-500/10 rounded-xl w-fit mb-4 group-hover:bg-emerald-500/15 transition-colors">
                        <flux:icon name="lock-closed" class="text-emerald-600 dark:text-emerald-400" />
                    </div>
                    <h3 class="font-semibold text-zinc-900 dark:text-white text-lg mb-2">Endpoint Auth</h3>
                    <p class="text-zinc-500 dark:text-zinc-400 text-sm leading-relaxed">Add a custom bearer token to simulate authenticated endpoints and test your auth flows.</p>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-2xl p-6 border border-zinc-200 dark:border-zinc-800 hover:border-emerald-500/40 dark:hover:border-emerald-500/40 transition-all duration-200 hover:shadow-lg hover:shadow-emerald-500/5 group">
                    <div class="p-2.5 bg-emerald-500/10 rounded-xl w-fit mb-4 group-hover:bg-emerald-500/15 transition-colors">
                        <flux:icon name="clock" class="text-emerald-600 dark:text-emerald-400" />
                    </div>
                    <h3 class="font-semibold text-zinc-900 dark:text-white text-lg mb-2">Simulated Delays</h3>
                    <p class="text-zinc-500 dark:text-zinc-400 text-sm leading-relaxed">Simulate slow responses — perfect for testing loading states, skeleton screens, and animations.</p>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-2xl p-6 border border-zinc-200 dark:border-zinc-800 hover:border-emerald-500/40 dark:hover:border-emerald-500/40 transition-all duration-200 hover:shadow-lg hover:shadow-emerald-500/5 group">
                    <div class="p-2.5 bg-emerald-500/10 rounded-xl w-fit mb-4 group-hover:bg-emerald-500/15 transition-colors">
                        <flux:icon name="calendar" class="text-emerald-600 dark:text-emerald-400" />
                    </div>
                    <h3 class="font-semibold text-zinc-900 dark:text-white text-lg mb-2">Endpoint History</h3>
                    <p class="text-zinc-500 dark:text-zinc-400 text-sm leading-relaxed">Track every request with payload sizes, response times, and HTTP status codes logged automatically.</p>
                </div>

                <!-- CTA card -->
                <div class="relative bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-6 overflow-hidden border border-emerald-400/30 hover:shadow-lg hover:shadow-emerald-500/30 transition-all duration-200">
                    <div class="absolute top-0 right-0 w-32 h-32 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
                    <h3 class="font-semibold text-white text-lg mb-2">Ready to start?</h3>
                    <p class="text-emerald-100 text-sm leading-relaxed mb-5">Create your first mock endpoint in under a minute. No credit card required.</p>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center gap-1 text-sm font-semibold text-white border border-white/30 rounded-lg px-4 py-2 hover:bg-white/10 transition-colors">
                        Get Started Free →
                    </a>
                </div>

            </div>
        </section>

        <!-- Built With -->
        <section class="max-w-[1200px] mx-auto px-4 pb-24 animate-fade-in">
            <div class="text-center mb-8">
                <p class="text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-widest">Built with the TALL stack</p>
            </div>
            <div class="flex flex-row flex-wrap justify-center gap-3">
                @foreach (['Laravel', 'Livewire', 'AlpineJS', 'TailwindCSS', 'Flux UI'] as $tech)
                    <div class="px-5 py-2.5 bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 shadow-sm font-semibold text-zinc-700 dark:text-zinc-300 text-sm hover:border-zinc-300 dark:hover:border-zinc-700 transition-colors">
                        {{ $tech }}
                    </div>
                @endforeach
            </div>
        </section>

        <!-- CTA Section -->
        <section class="max-w-[1200px] mx-auto px-4 pb-20">
            <div class="relative bg-zinc-900 dark:bg-zinc-800 rounded-3xl p-10 md:p-16 text-center overflow-hidden border border-zinc-800 dark:border-zinc-700">
                <!-- Glow -->
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[500px] h-[200px] rounded-full bg-emerald-500/20 blur-3xl pointer-events-none"></div>

                <p class="text-xs font-bold text-emerald-400 uppercase tracking-widest mb-4 relative">Get Started Today</p>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 relative">Start forging mock APIs today</h2>
                <p class="text-zinc-400 max-w-md mx-auto mb-8 leading-relaxed relative">
                    Free to use. No credit card required. Build and test your front-end faster than ever.
                </p>
                <flux:button href="{{ route('register') }}" color="emerald" variant="primary" size="base" class="relative">
                    Create Your First Endpoint →
                </flux:button>
            </div>
        </section>

    </main>

    <footer class="border-t border-zinc-200 dark:border-zinc-800">
        <div class="max-w-[1200px] mx-auto px-4 py-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <a href="/" class="flex items-center gap-2">
                <x-app-logo />
            </a>
            <p class="text-sm text-zinc-400 dark:text-zinc-500">&copy; {{ date('Y') }} MockForge. All rights reserved.</p>
        </div>
    </footer>

    @fluxScripts
</body>

</html>
