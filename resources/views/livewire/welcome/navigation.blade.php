<nav class="flex flex-1 justify-end">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            wire:navigate
        >
            Dashboard
        </a>
    @endauth
        <a
            href="{{ route('login') }}"
            class="rounded-md px-3 py-2 text-gray-900 transition hover:text-black/70 focus:outline-none dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            wire:navigate
        >
            Browse
        </a>
        <a
            href="{{ route('login') }}"
            class="rounded-md px-3 py-2 text-gray-900 transition hover:text-black/70 focus:outline-none dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            wire:navigate
        >
            Recommended Products
        </a>
    @guest
        <a
            href="{{ route('login') }}"
            class="rounded-lg px-6 py-2 bg-green-700 text-white hover:bg-green-600 transition focus:outline-none dark:text-white dark:focus-visible:ring-white"
            wire:navigate
        >
            Log in
        </a>
    @endguest
</nav>