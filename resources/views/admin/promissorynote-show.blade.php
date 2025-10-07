@extends('layouts.layout')

@section('content')
@include('includes.admin')

<div class="min-h-screen bg-gray-100 py-8 px-4 flex flex-col items-center">

    <!-- 🔙 Back Button (Outside Card) -->
    <div class="w-full max-w-3xl mb-6">
        <a href="{{ route('admin.manage-record') }}"
           class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
            <iconify-icon icon="mdi:arrow-left" class="text-xl"></iconify-icon>
            <span>Back to Manage Record</span>
        </a>
    </div>

    <!-- 📄 Paper-like Card -->
    <div class="relative bg-white rounded-2xl shadow-lg border border-gray-200 max-w-3xl w-full overflow-hidden">

        <!-- Subtle Paper Texture -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/paper-fibers.png')] opacity-10 pointer-events-none"></div>

        <div class="relative z-10 flex flex-col h-full">

            <!-- 🧾 Header with Logo (Sticky) -->
            <div class="flex items-center gap-3 border-b-2 border-[#660809] bg-white sticky top-0 p-6 z-20">
                <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="w-16 h-16 object-contain">
                <h2 class="text-2xl md:text-3xl font-bold text-[#660809]">
                    Promissory Note Details
                </h2>
            </div>

            <!-- 📋 Details Grid (Scrollable Content) -->
            <div class="p-10 overflow-y-auto max-h-[500px]">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6 text-gray-800">

                    <div>
                        <span class="block text-sm font-medium text-gray-600">PN ID</span>
                        <p class="text-base font-semibold text-gray-900">{{ $note->pn_id }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Full Name</span>
                        <p class="text-base font-semibold text-gray-900">{{ $note->user->fullname ?? $note->fullname }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Student ID</span>
                        <p class="text-base font-semibold text-gray-900">{{ $note->user->student_id ?? $note->student_id }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Department</span>
                        <p class="text-base font-semibold text-gray-900">{{ $note->user->department ?? $note->department }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Status</span>
                        <p class="text-base font-semibold
                            {{ $note->status == 'approved' ? 'text-green-600' :
                               ($note->status == 'pending' ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ ucfirst($note->status) }}
                        </p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Date Created</span>
                        <p class="text-base font-semibold text-gray-900">
                            {{ $note->created_at ? $note->created_at->format('Y-m-d') : '—' }}
                        </p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Last Modified</span>
                        <p class="text-base font-semibold text-gray-900">
                            {{ $note->updated_at ? $note->updated_at->format('Y-m-d') : '—' }}
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
