@php
    use Carbon\Carbon;
@endphp

@extends('layouts.layout')

@section('content')

            @include('includes.admin')


  <div x-data="notificationModal()" class="w-full mt-8">
    <div class="w-full mt-8">
      <div class="bg-white shadow rounded-lg p-6 ml-10 mr-10">
        <div class="flex items-center justify-between mb-5">
          <a href="{{ route('admin.dashboard') }}"
             class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#4a0708] text-white px-4 py-2 rounded-lg shadow transition">
            <iconify-icon icon="mdi:arrow-left"></iconify-icon>
            Back to Dashboard
          </a>
        </div>

        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Notifications</h2>
        <ul class="space-y-4">
          @forelse($notifications as $notification)
            <li>
              <button
                @click="openModal({
                  id: '{{ $notification->id }}',
                  content: `{{ $notification->content }}`,
                  sent_at: `{{ $notification->sent_at ? Carbon::parse($notification->sent_at)->diffForHumans() : '' }}`,
                  link: '{{ $notification->link ?? "#" }}'
                })"
                class="w-full flex items-center justify-between bg-[#660809] shadow-md rounded-lg p-4 hover:bg-black text-white transition text-left"
              >
                <div>
                  <span class="font-bold text-white">
                    {{ $notification->content }}
                  </span>
                  <span class="text-xs text-white mt-1 block">
                    {{ $notification->sent_at ? Carbon::parse($notification->sent_at)->diffForHumans() : '' }}
                  </span>
                </div>
                <span class="ml-4 text-xl text-white">
                  <iconify-icon icon="mdi:chevron-right"></iconify-icon>
                </span>
              </button>
            </li>
          @empty
            <li class="py-4 text-gray-500 text-center">No notifications found.</li>
          @endforelse
        </ul>

        <!-- Modal -->
        <div
          x-show="show"
          x-transition
          class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40"
          style="display: none;"
        >
          <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
            <button @click="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-black text-xl">&times;</button>
            <h3 class="text-lg font-bold mb-2" x-text="notification.content"></h3>
            <p class="text-xs text-gray-500 mb-4" x-text="notification.sent_at"></p>
            <template x-if="notification.link && notification.link !== '#'">
              <a :href="notification.link" target="_blank" class="text-[#660809] hover:underline">View Related</a>
            </template>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function notificationModal() {
      return {
        show: false,
        notification: { id: null, content: '', sent_at: '', link: '#' },
        openModal(data) {
          this.notification = data;
          this.show = true;
          // Mark as read
          fetch('/admin/notifications/mark-read-single/' + data.id, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'Accept': 'application/json'
            }
          });
        },
        closeModal() {
          this.show = false;
        }
      }
    }
  </script>
@endsection
