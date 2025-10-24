<div x-data="{ open: false }" class="relative">
                    <button
                        @click="
                            open = !open;
                            if(open) {
                                fetch('{{ route('student.notifications.markRead') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/json'
                                    }
                                });
                            }
                        "
                        class="relative text-[#660809] hover:text-[#000000]">
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
                            {{-- Email verification notification --}}
                            @if (!auth()->user()->hasVerifiedEmail())
                                <li class="px-3 py-2 border-b font-bold flex items-start gap-2">
                                    <iconify-icon icon="mdi:email-alert-outline" class="text-xl text-yellow-500 mt-0.5"></iconify-icon>
                                    <div>
                                        Please verify your email address.
                                        <form method="POST" action="{{ route('verification.send') }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-[#660809] underline hover:text-black font-semibold">Resend Verification Email</button>
                                        </form>
                                        <br>
                                        <span class="text-xs text-gray-500">{{ now()->diffForHumans() }}</span>
                                    </div>
                                </li>
                            @endif
                            {{-- Other notifications --}}
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
                            <a href="{{ route('student.notification-view') }}" class="text-[#660809] text-xs hover:underline">View all</a>
                        </div>
                    </div>
                </div>
