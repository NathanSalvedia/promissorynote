@php
    use Carbon\Carbon;
@endphp
@extends('layouts.layout')

@section('content')
    @include('includes.header')

    <div class="max-w-2xl mx-auto mt-8">

        <div class="bg-white shadow rounded-lg p-6">
             <div class="flex items-center justify-between mb-5">
            <a href="{{ route('student.dashboard') }}"
               class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#4a0708] text-white px-4 py-2 rounded-lg shadow transition">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Back to Dashboard
            </a>
        </div>

            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Notifications</h2>
            <ul class="space-y-4">
                @forelse($notifications as $notification)
                    <li>
                        <a
                            href="{{ $notification->link ?? '#' }}"
                            class="block bg-[#660809] shadow-md rounded-lg p-4 hover:bg-black text-white transition"
                            target="_blank"
                        >
                            <span class="font-bold text-white">
                                {{ $notification->content }}
                            </span>
                            <span class="text-xs text-white mt-1 block">
                                {{ $notification->sent_at ? Carbon::parse($notification->sent_at)->diffForHumans() : '' }}
                            </span>
                        </a>
                    </li>
                @empty
                    <li class="py-4 text-gray-500 text-center">No notifications found.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
