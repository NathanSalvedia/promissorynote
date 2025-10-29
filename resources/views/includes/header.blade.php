<header class="w-full">
    {{-- Top black strip with scrolling text - hidden on mobile --}}
    <div class="hidden sm:block bg-black text-white text-[11px] md:text-xs py-0.5">
        <div class="w-full px-4">
            <div class="marquee">
                <span>DATA-DRIVEN PROMISSORY NOTE MANAGEMENT SYSTEM WITH INTEGRATED NOTIFICATION AND ANALYTICS SOLUTION</span>
            </div>
        </div>
    </div>

    {{-- Maroon strip --}}
    <div class="bg-[#660809] text-white">
        <div class="w-full px-4 py-1 text-[11px] md:text-xs flex justify-end gap-6"></div>
    </div>

    {{-- MOBILE header (clean, compact) --}}
    <div class="bg-white shadow sm:hidden">
        <div class="max-w-7xl mx-auto px-3 py-3 flex items-center justify-between">
            {{-- left: logo --}}
            <div class="flex items-center">
                <img src="/img/spc-wordmark.png" alt="SPC" class="h-10 object-contain">
            </div>

            {{-- right: notification bell + user/logout (bell immediately left of user button) --}}
            <div class="flex items-center gap-2">
                <div id="notification-bell-mobile" class="flex items-center">
                    @include('includes.partials.student-bell', [
                        'notifications' => $notifications ?? collect(),
                        'unreadCount' => $unreadCount ?? 0
                    ])
                </div>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                            :class="open ? 'bg-green-600 text-white' : 'bg-[#660809] text-white hover:bg-green-600'"
                            class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-xs font-medium max-w-[140px] truncate">
                        <span class="truncate">{{ Str::limit(auth()->user()->fullname ?? '', 18) }}</span>
                        <iconify-icon :class="{'rotate-180': open}" icon="mdi:chevron-down" class="text-white text-sm"></iconify-icon>
                    </button>

                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 transform scale-95 -translate-y-1"
                         class="absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white z-50 origin-top-right">
                        <div class="py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full px-3 py-1.5 text-sm bg-white text-black hover:bg-[#660809] hover:text-white text-left rounded-md transition">
                                    <iconify-icon icon="mdi:logout" class="mr-1"></iconify-icon>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DESKTOP / existing navbar (unchanged for web) --}}
    <div class="bg-white shadow hidden sm:block">
        <div class="w-full flex flex-col sm:flex-row justify-between items-center px-3 sm:px-6 py-2 sm:py-3 gap-2">
            <div class="flex items-center gap-2 sm:gap-3">
                <img src="/img/spc-wordmark.png" alt="SPC" class="h-10 sm:h-12 object-contain">
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-2 sm:gap-6 mt-2 sm:mt-0">
                {{-- Notification Bell --}}
                <div id="notification-bell">
                    @include('includes.partials.student-bell', [
                        'notifications' => $notifications ?? collect(),
                        'unreadCount' => $unreadCount ?? 0
                    ])
                </div>
                {{-- User Dropdown --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        :class="open ? 'bg-green-600 text-white' : 'bg-[#660809] text-white hover:bg-green-600'"
                        class="inline-flex items-center px-2.5 py-1 rounded-md text-sm font-medium focus:outline-none transition">
                        {{ auth()->user()->fullname }}
                        <iconify-icon :class="{'rotate-180': open}"
                                      icon="mdi:chevron-down"
                                      class="ml-1 text-white text-lg transform transition-transform duration-200">
                        </iconify-icon>
                    </button>

                    <div x-show="open" @click.away="open = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95 -translate-y-1"
                        x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 transform scale-95 -translate-y-1"
                        class="absolute right-0 mt-1 w-40 rounded-md shadow-lg bg-white z-50 origin-top-right">
                        <div class="py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full px-3 py-1.5 text-sm bg-white text-black hover:bg-[#660809] hover:text-white text-left rounded-md transition">
                                    <iconify-icon icon="mdi:logout" class="mr-1"></iconify-icon>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
.marquee {
    overflow: hidden;
    white-space: nowrap;
    animation: marquee 18s linear infinite;
}
@keyframes marquee {
    0% { transform: translateX(100%);}
    100% { transform: translateX(-100%);}
}
/* keep bell width so logo doesn't shift on mobile */
#notification-bell-mobile { min-width: 36px; }
</style>
