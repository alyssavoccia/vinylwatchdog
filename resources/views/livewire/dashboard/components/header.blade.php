<header class="sticky top-[-1px] z-[9] flex w-full border-b border-gray-200 dark:bg-boxdark dark:drop-shadow-none backdrop-blur-sm bg-white/80 before:content-[''] before:bg-gray-100/[.9] before:w-full before:absolute before:left-0 before:h-full before:z-[-1]">
    <div class="flex flex-grow items-center justify-between px-4 py-4 md:px-6 2xl:px-10">
        <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
            <!-- Hamburger Toggle BTN -->
            <button class="z-99999 block p-1.5 lg:hidden" @click.stop="sidebarToggle = !sidebarToggle">
                <span class="relative block h-5 w-5 cursor-pointer">
                    <span class="du-block absolute right-0 h-full w-full">
                        <span
                        class="relative left-0 top-0 my-1 block h-[1px] w-0 rounded-sm bg-black delay-[0] duration-200 ease-in-out dark:bg-white"
                        :class="{ '!w-full delay-300': !sidebarToggle }"
                        ></span>
                        <span
                        class="relative left-0 top-0 my-1 block h-[1px] w-0 rounded-sm bg-black delay-150 duration-200 ease-in-out dark:bg-white"
                        :class="{ '!w-full delay-400': !sidebarToggle }"
                        ></span>
                        <span
                        class="relative left-0 top-0 my-1 block h-[1px] w-0 rounded-sm bg-black delay-200 duration-200 ease-in-out dark:bg-white"
                        :class="{ '!w-full delay-500': !sidebarToggle }"
                        ></span>
                    </span>
                    <span class="du-block absolute right-0 h-full w-full rotate-45">
                        <span
                        class="absolute left-2 top-0 block h-full w-[1px] rounded-sm bg-black delay-300 duration-200 ease-in-out dark:bg-white"
                        :class="{ '!h-0 delay-[0]': !sidebarToggle }"
                        ></span>
                        <span
                        class="delay-400 absolute left-0 top-2 block h-[1px] w-full rounded-sm bg-black duration-200 ease-in-out dark:bg-white"
                        :class="{ '!h-0 dealy-200': !sidebarToggle }"
                        ></span>
                    </span>
                </span>
            </button>
            <!-- Hamburger Toggle BTN -->
            <a class="block flex-shrink-0 lg:hidden" href="index.html">
                <img class="w-6" src="/images/pieSliceIcon.png" alt="Logo" />
            </a>
        </div>
        <div class="hidden sm:block">
            <h1 class="title text-2xl font-medium">{{ $header }}</h1>
        </div>
        {{-- <div class="hidden md:flex items-center gap-3 2xsm:gap-7">
            <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap text-sm">
                <a href="#" class="text-gray-600 dark:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </a>
                @foreach ($breadcrumbs as $breadcrumb => $route)
                    <span class="mx-5 text-gray-500 dark:text-gray-300">/</span>
                    <a href="{{ $route }}" class="{{ $loop->last ? 'text-rose-600 dark:text-rose-400' : 'text-gray-500 dark:text-gray-300' }} hover:underline">
                        {{ $breadcrumb }}
                    </a>
                @endforeach
            </div>
        </div> --}}
    </div>
</header>