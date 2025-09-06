<header class="w-full">
    {{-- Top black strip with scrolling text --}}
    <div class="bg-black text-white text-[11px] md:text-xs py-0.5">
        <div class="max-w-7xl mx-auto px-4">
            <div class="marquee">
                <span>  DATA-DRIVEN PROMISSORY NOTE MANAGEMENT SYSTEM WITH INTEGRATED NOTIFICATION AND ANALYTICS SOLUTION
 </span>
            </div>
        </div>
    </div>

    {{-- Maroon strip --}}
    <div class="bg-[#660809] text-white">
        <div class="max-w-7xl mx-auto px-4 py-1 text-[11px] md:text-xs flex justify-end gap-6"></div>
    </div>

    {{-- White navbar --}}
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
            <div class="flex items-center gap-3">
                <img src="/img/spc-wordmark.png" alt="SPC" class="h-10 md:h-12 object-contain">
            </div>

            <div class="flex items-center gap-6">
                {{-- Notifications --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="relative text-[#660809] hover:text-[#000000]">
                        <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
                        @if(isset($unreadCount) && $unreadCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 rounded-full">{{ $unreadCount }}</span>
                        @endif
                    </button>

                    <div x-show="open" @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform translate-y-1"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform translate-y-1"
                         class="absolute right-0 mt-2 w-72 bg-white shadow-lg rounded-lg z-50 text-sm">
                        <div class="p-3 border-b font-semibold">Notifications</div>
                        <ul>
                            @forelse($notifications->take(5) as $notification)
                                <li class="px-3 py-2 border-b {{ $notification->is_read ? 'opacity-60' : 'font-bold' }}">
                                    {{ $notification->content }}
                                    <br>
                                    <span class="text-xs text-gray-500">{{ $notification->sent_at ? \Carbon\Carbon::parse($notification->sent_at)->diffForHumans() : '' }}</span>
                                </li>
                            @empty
                                <li class="px-3 py-2 text-gray-500">No notifications.</li>
                            @endforelse
                        </ul>
                        <div class="p-2 text-right">
                            <a href="{{ route('student.dashboard') }}" class="text-[#660809] text-xs hover:underline">View all</a>
                        </div>
                    </div>
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
                        class="absolute right-0 mt-1 w-28 rounded-md shadow-lg bg-white z-50 origin-top-right">
                        <div class="py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full px-3 py-1.5 text-sm bg-white text-black hover:bg-[#660809] hover:text-white text-left rounded-md transition">
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
