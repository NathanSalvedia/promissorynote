@php
    use Carbon\Carbon;
@endphp
@extends('layouts.layout')

@section('content')

    <header class="fixed top-0 left-0 w-full z-50 shadow">
        <div id="notification-bell">
    @include('includes.partials.student-bell') <!-- for student -->
    </div>
  </header>

    <div class="w-full mt-8">
        <div class="w-full mt-8">
            <div class="bg-white shadow rounded-lg p-4 sm:p-6 mx-2 sm:mx-10">
                <div class="flex items-center justify-between mb-5">
                    <a href="{{ route('student.dashboard') }}"
                       class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#4a0708] text-white px-4 py-2 rounded-lg shadow transition">
                        <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                        Back to Dashboard
                    </a>
                </div>

                <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-gray-800">Notifications</h2>
                <ul class="space-y-4">
                    @if(!auth()->user()->hasVerifiedEmail())
                        <li>
                            <a
                                href="{{ route('verification.notice') }}"
                                class="flex items-center justify-between bg-[#660809] shadow-md rounded-lg p-4 hover:bg-black text-white transition"
                                target="_blank"
                            >
                                <div>
                                    <span class="font-bold text-white">
                                        Please verify your email address.
                                    </span>
                                    <span class="text-xs text-white mt-1 block">
                                        {{ Carbon::now()->diffForHumans() }}
                                    </span>
                                </div>
                                <span class="ml-4 text-xl text-white">
                                    <iconify-icon icon="mdi:chevron-right"></iconify-icon>
                                </span>
                            </a>
                        </li>
                    @endif
                    @forelse($notifications as $notification)
                        <li>
                            <a
                                href="{{ $notification->link ?? '#' }}"
                                class="flex items-center justify-between bg-[#660809] shadow-md rounded-lg p-4 hover:bg-black text-white transition"
                                target="_blank"
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
                            </a>
                        </li>
                    @empty
                        <li class="py-4 text-gray-500 text-center">No notifications found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
