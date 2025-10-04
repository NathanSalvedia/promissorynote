@php
    $notifications = $notifications ?? collect();
@endphp

<header class="w-full sticky top-0 z-50">
    {{-- 🔝 Top black strip with scrolling text (with logo) --}}
    <div class="bg-black text-white text-[11px] md:text-xs py-0.5">
        <div class="max-w-7xl mx-auto px-4">
            <div class="marquee flex items-center gap-2">
                <span class="flex items-center gap-2">
                    <img src="/img/logo.jpg" alt="Logo" class="h-4 w-auto object-contain inline-block">
                    DATA-DRIVEN PROMISSORY NOTE MANAGEMENT SYSTEM WITH INTEGRATED NOTIFICATION AND ANALYTICS SOLUTION
                </span>
            </div>
        </div>
    </div>

    {{-- 🔴 Maroon strip --}}
    <div class="bg-[#660809] text-white">
        <div class="max-w-7xl mx-auto px-4 py-1 text-[11px] md:text-xs flex justify-end gap-6"></div>
    </div>

    {{-- ⚪ White Navbar --}}
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
            {{-- 🏫 SPC Logo --}}
            <div class="flex items-center gap-3">
                <img src="/img/spc-wordmark.png" alt="SPC" class="h-10 md:h-12 object-contain">
            </div>

            <div class="flex items-center gap-6">
                {{-- 🔔 Admin Notifications --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.away="open = false"
                        class="relative text-[#660809] hover:text-black">
                        <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
                        @if(isset($unreadCount) && $unreadCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 rounded-full">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </button>

                    {{-- 🔔 Notification Dropdown --}}
                    <div x-show="open" x-transition
                        class="absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg z-50 text-sm">
                        <div class="p-3 border-b font-semibold">Admin Notifications</div>
                        <ul class="max-h-64 overflow-y-auto">
                            @forelse($notifications->take(5) as $notification)
                                <li class="px-3 py-2 border-b {{ $notification->is_read ? 'opacity-60' : 'font-bold' }}">
                                    {{-- Content --}}
                                    @if($notification->content)
                                        {{ $notification->content }}
                                    @else
                                        A student submitted a new promissory note.
                                    @endif
                                    <br>
                                    {{-- Timestamp --}}
                                    <span class="text-xs text-gray-500">
                                        {{ $notification->sent_at ? \Carbon\Carbon::parse($notification->sent_at)->diffForHumans() : '' }}
                                    </span>
                                </li>
                            @empty
                                <li class="px-3 py-2 text-gray-500">No notifications.</li>
                            @endforelse
                        </ul>
                        <div class="p-2 text-right">
                            <a href="{{ route('admin.manage-record') }}"
                                class="text-[#660809] text-xs hover:underline">View all</a>
                        </div>
                    </div>
                </div>

                {{-- 👤 Admin Dropdown --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.away="open = false"
                        class="inline-flex items-center px-3 py-2 rounded-md text-sm font-medium focus:outline-none transition bg-[#660809] text-white hover:bg-green-600">
                        {{ auth()->user()->fullname ?? 'Admin User' }}
                        <iconify-icon icon="mdi:chevron-down"
                            class="ml-1 text-white text-lg transform transition-transform duration-200"
                            :class="{'rotate-180': open}"></iconify-icon>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div x-show="open" x-transition
                        class="absolute right-0 mt-2 w-52 rounded-md shadow-lg bg-white z-50 origin-top-right">
                        <div class="py-1">
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center px-3 py-2 text-sm text-gray-800 hover:bg-[#660809] hover:text-white transition">
                                <iconify-icon icon="mdi:view-dashboard-outline" class="mr-2"></iconify-icon>
                                Dashboard
                            </a>

                            <a href="{{ route('admin.manage-record') }}"
                                class="flex items-center px-3 py-2 text-sm text-gray-800 hover:bg-[#660809] hover:text-white transition">
                                <iconify-icon icon="mdi:file-document-edit-outline" class="mr-2"></iconify-icon>
                                Manage Records
                            </a>

                            <a href="#"
                                class="flex items-center px-3 py-2 text-sm text-gray-800 hover:bg-[#660809] hover:text-white transition">
                                <iconify-icon icon="mdi:chart-line" class="mr-2"></iconify-icon>
                                Analytics
                            </a>

                            <a href="{{ route('admin.manage-users') }}"
                                class="flex items-center px-3 py-2 text-sm text-gray-800 hover:bg-[#660809] hover:text-white transition">
                                <iconify-icon icon="mdi:account-multiple-outline" class="mr-2"></iconify-icon>
                                Manage Users
                            </a>

                            <a href="{{ route('admin.payment-tracking') }}"
                                class="flex items-center px-3 py-2 text-sm text-gray-800 hover:bg-[#660809] hover:text-white transition">
                                <iconify-icon icon="mdi:cash-multiple" class="mr-2"></iconify-icon>
                                Payment Tracking
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center w-full px-3 py-2 text-sm text-gray-800 hover:bg-[#660809] hover:text-white transition text-left">
                                    <iconify-icon icon="mdi:logout" class="mr-2"></iconify-icon>
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
