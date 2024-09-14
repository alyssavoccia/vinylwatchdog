<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body
        x-data="{ 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
        x-init="darkMode = localStorage.getItem('darkMode') === 'true' ? true : false; $watch('darkMode', value => localStorage.setItem('darkMode', value))"
        class="overflow-hidden font-sans antialiased"
    >
        <header class="container max-w-screen-xl mx-auto flex items-center justify-between">
            <livewire:layout.navigation />
        </header>
        <div class="flex h-screen overflow-hidden">
            <livewire:dashboard.components.sidenav />
            <div class="relative flex flex-1 flex-col min-h-screen overflow-y-auto bg-gray-100 dark:bg-gray-900">
                <livewire:dashboard.components.header :header="$header" />
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>