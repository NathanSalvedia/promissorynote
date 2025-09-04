
<header class="w-full">
      {{-- Top black strip with scrolling text --}}
      <div class="bg-black text-white text-[11px] md:text-xs py-0.5">
        <div class="max-w-7xl mx-auto px-4">
          <div class="marquee">
            <span>Enroll Now  |  Experience a Modern SPC  |  Welcome to My.SPC Promissorynote Management System</span>
          </div>
        </div>
      </div>

      {{-- Maroon strip --}}
      <div class="bg-[#660809] text-white">
        <div class="max-w-7xl mx-auto px-4 py-1 text-[11px] md:text-xs flex justify-end gap-6">
        </div>
      </div>

      {{-- White navbar --}}
      <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
          <div class="flex items-center gap-3">
            <img src="/img/spc-wordmark.png" alt="SPC" class="h-10 md:h-12 object-contain">
          </div>

            <div class="flex items-center gap-6">

            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="relative text-[#660809] hover:text-[#000000] ">
                    <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
                    @if(isset($unreadCount) && $unreadCount > 0)
                        <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </button>

                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg z-50">
                    <div class="p-4 border-b font-semibold">Notifications</div>
                    <ul>
                        @forelse($notifications->take(5) as $notification)
                            <li class="px-4 py-2 border-b {{ $notification->is_read ? 'opacity-60' : 'font-bold' }}">
                                {{ $notification->content }}
                                <br>
                                <span class="text-xs text-gray-500">{{ $notification->sent_at ? \Carbon\Carbon::parse($notification->sent_at)->diffForHumans() : '' }}</span>
                            </li>
                        @empty
                            <li class="px-4 py-2 text-gray-500">No notifications.</li>
                        @endforelse
                    </ul>
                    <div class="p-2 text-right">
                        <a href="{{ route('student.dashboard') }}" class="text-[#660809] text-sm hover:underline">View all</a>
                    </div>
                </div>
            </div>

           <div class="flex items-center gap-2">
                <iconify-icon icon="mdi:account-circle" class="text-2xl text-gray-700"></iconify-icon>
                <span class="font-medium">{{ auth()->user()->fullname }}</span>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-[#660809] hover:text-[#000000] flex items-center gap-1">
                    <iconify-icon icon="mdi:logout" class="text-xl"></iconify-icon>
                    Logout
                </button>
            </form>
        </div>
    </header>
