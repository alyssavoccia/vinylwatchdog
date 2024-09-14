<aside
    :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute left-0 top-[79px] z-[9999] flex h-screen w-72 flex-col transform text-gray-800 overflow-y-hidden bg-white duration-300 ease-linear dark:bg-boxdark lg:translate-x-0 lg:left-0 lg:static border-r border-gray-100"
    @click.outside="sidebarToggle = false"
>
    {{-- SIDEBAR HEADER --}}
    <div class="flex items-end justify-between gap-2 px-6">
        <a href="{{ route('dashboard') }}" wire:navigate>
            <img src="/images/vinylWatchdogLogo.png" alt="Logo" class="w-16" />
        </a>
        <button class="block lg:hidden hover:text-rose-600 transition-all duration-300" @click.stop="sidebarToggle = !sidebarToggle">  
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>              
        </button>
    </div>
    <hr class="border border-gray-50 w-4/5 mx-auto">
    {{-- SIDEBAR MENU --}}
    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <nav class="mt-5 px-4 py-4">
            <div>
                <h2 class="mb-4 ml-4 text-sm font-medium text-gray-400">PAGES</h2>
                <ul class="mb-6 flex flex-col gap-2">
                    {{-- Menu Item: DASHBOARD --}}
                    <li>
                        <a
                            class="group relative flex items-center gap-2 rounded-sm px-4 py-2 font-medium text-gray-700 duration-300 ease-in-out hover:bg-gray-100 dark:hover:bg-meta-4"
                            href="{{ route('dashboard') }}"
                            x-bind:class="{ 'bg-gray-100 text-green-700 dark:bg-meta-4': {{ request()->routeIs('dashboard') ? 'true' : 'false' }} }"
                            wire:navigate
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                            </svg>                                                          
                            Dashboard
                        </a>
                    </li>
                    {{-- Menu Item: FAVORITES --}}
                    <li>
                        <a
                            class="group relative flex items-center gap-2 rounded-sm px-4 py-2 font-medium text-gray-700 duration-300 ease-in-out hover:bg-gray-100 dark:hover:bg-gray-800"
                            {{-- href="{{ route('broker-agents', ['brokerageId' => $brokerageId]) }}" --}}
                            {{-- x-bind:class="{ 'bg-gray-100 text-green-700 dark:bg-meta-4': {{ (request()->routeIs('broker-agents') || request()->routeIs('broker-agent-info')) ? 'true' : 'false' }} }" --}}
                            wire:navigate
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>                                                       
                            Favorites
                        </a>
                    </li>
                    {{-- Menu Item: WATCHLIST --}}
                    <li>
                        <a
                            class="group relative flex items-center gap-2 rounded-sm py-2 px-4 font-medium text-gray-700 duration-300 ease-in-out hover:bg-gray-100 dark:hover:bg-meta-4"
                            {{-- href="{{ route('broker-conversations', ['brokerageId' => $brokerageId]) }}" --}}
                            {{-- x-bind:class="{ 'bg-gray-100 text-green-700 dark:bg-meta-4': {{ request()->routeIs('broker-conversations') ? 'true' : 'false' }} }" --}}
                            wire:navigate
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                            </svg>                                                       
                            Watchlist
                        </a>
                    </li>
                    {{-- Menu Item: PROFILE --}}
                    <li>
                        <a
                            class="group relative flex items-center gap-2 rounded-sm py-2 px-4 font-medium text-gray-700 duration-300 ease-in-out hover:bg-gray-100 dark:hover:bg-meta-4"
                            {{-- href="{{ route('broker-forms', ['brokerageId' => $brokerageId]) }}" --}}
                            {{-- x-bind:class="{ 'bg-gray-100 text-green-700 dark:bg-meta-4': {{ request()->routeIs('broker-forms') ? 'true' : 'false' }} }" --}}
                            wire:navigate
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>                                                                             
                            Profile
                        </a>
                    </li>
                    {{-- Menu Item: RECORDS --}}
                </ul>
                @if ($user->is_admin)
                    <h2 class="mb-4 ml-4 text-sm font-medium text-gray-400">Admin</h2>
                    <ul class="mb-6 flex flex-col gap-2">
                        <li>
                            <a
                                class="group relative flex items-center gap-2 rounded-sm py-2 px-4 font-medium text-gray-700 duration-300 ease-in-out hover:bg-gray-100 dark:hover:bg-meta-4"
                                {{-- href="{{ route('broker-advertisers', ['brokerageId' => $brokerageId]) }}" --}}
                                {{-- x-bind:class="{ 'bg-gray-100 text-green-700 dark:bg-meta-4': {{ request()->routeIs('broker-advertisers') ? 'true' : 'false' }} }" --}}
                                wire:navigate
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                                </svg>                                                    
                                Records
                            </a>
                        </li>
                        {{-- Menu Item: USERS --}}
                        <li>
                            <a
                                class="group relative flex items-center gap-2 rounded-sm py-2 px-4 font-medium text-gray-700 duration-300 ease-in-out hover:bg-gray-100 dark:hover:bg-meta-4"
                                {{-- href="{{ route('broker-api-integrations', ['brokerageId' => $brokerageId]) }}" --}}
                                {{-- x-bind:class="{ 'bg-gray-100 text-green-700 dark:bg-meta-4': {{ request()->routeIs('broker-api-integrations') ? 'true' : 'false' }} }" --}}
                                wire:navigate
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>                                                                        
                                Users
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
        </nav>
    </div>
</aside>