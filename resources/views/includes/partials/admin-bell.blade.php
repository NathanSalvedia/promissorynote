  <div x-data="{ open: false }" class="relative">
                    <button
                        @click="
                            open = !open;
                            if(open) {
                                fetch('{{ route('admin.notifications.markRead') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/json'
                                    }
                                });
                            }
                        "
                        @click.away="open = false"
                        class="relative text-[#660809] hover:text-black">
                        <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
                        @if(isset($unreadCount) && $unreadCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 rounded-full">{{ $unreadCount }}</span>
                        @endif
                    </button>

                    <div x-show="open" x-transition
                        class="absolute right-0 mt-2 w-72 bg-white shadow-lg rounded-lg z-50 text-sm">
                        <div class="p-3 border-b font-semibold">Notifications</div>
                        <ul>
                            @if(isset($notifications) && $notifications->count())
                                @foreach($notifications->take(5) as $notification)
                                    <li
                                        class="px-3 py-2 border-b {{ $notification->is_read ? 'opacity-60' : 'font-bold' }}">
                                        {{ $notification->content }}
                                        <br>
                                        <span
                                            class="text-xs text-gray-500">{{ $notification->sent_at ? \Carbon\Carbon::parse($notification->sent_at)->diffForHumans() : '' }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="px-3 py-2 text-gray-500">No notifications.</li>
                            @endif
                        </ul>
                        <div class="p-2 text-right">
                            <a href="{{ route('admin.notifications') }}"
                                class="text-[#660809] text-xs hover:underline">View all</a>
                        </div>
                    </div>
                </div>
