
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
            <button class="relative text-[#660809] hover:text-[#000000] ">
                <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
                <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 rounded-full">3</span>
            </button>
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
