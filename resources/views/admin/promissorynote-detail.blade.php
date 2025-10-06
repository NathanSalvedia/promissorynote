@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-white flex flex-col">

    <!-- ✅ Fixed Header -->
    <header class="fixed top-0 left-0 w-full z-50 shadow bg-white">
        @include('includes.admin')
    </header>

    <!-- ✅ Main Content -->
    <main class="p-6 w-full max-w-4xl mx-auto mt-28">
        
        <!-- 🔙 Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Back to Dashboard
            </a>
        </div>

        <!-- 📜 Paper-style Card -->
        <div class="relative bg-white rounded-2xl shadow-lg border border-gray-200 p-10 overflow-hidden">

            <!-- Subtle Paper Texture -->
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/paper-fibers.png')] opacity-10 pointer-events-none"></div>

            <div class="relative z-10">

                <!-- 🧾 Header with Logo -->
                <div class="flex items-center gap-3 mb-8 border-b-2 border-[#660809] pb-2">
                    <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="w-16 h-16 object-contain">
                    <h2 class="text-3xl font-bold text-[#660809]">
                        Promissory Note Details
                    </h2>
                </div>

                <!-- 📋 Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6 text-gray-800">

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Full Name</span>
                        <p class="text-base font-semibold text-gray-900">{{ $note->fullname }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Student ID</span>
                        <p class="text-base font-semibold text-gray-900">{{ $note->student_id }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Gender</span>
                        <p class="text-base font-semibold text-gray-900">{{ $note->gender }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Department</span>
                        <p class="text-base font-semibold text-gray-900">{{ $note->department }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Phone</span>
                        <p class="text-base font-semibold text-gray-900">{{ $note->phone }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Year Level</span>
                        <p class="text-base font-semibold text-gray-900">{{ $note->year_level }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Amount</span>
                        <p class="text-base font-semibold text-gray-900">₱{{ number_format($note->amount, 2) }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Reason</span>
                        <p class="text-base font-semibold text-gray-900">{{ $note->reason }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Term</span>
                        <p class="text-base font-semibold text-gray-900">{{ $note->term }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Academic Year</span>
                        <p class="text-base font-semibold text-gray-900">{{ $note->academic_year }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Down Payment</span>
                        <p class="text-base font-semibold text-gray-900">₱{{ number_format($note->down_payment, 2) }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Due Date</span>
                        <p class="text-base font-semibold text-gray-900">{{ $note->due_date }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <span class="block text-sm font-medium text-gray-600">Additional Notes</span>
                        <p class="text-base font-semibold text-gray-900">{{ $note->notes }}</p>
                    </div>

                    <!-- 📎 Attachments Section -->
                    <div class="md:col-span-2">
                        <span class="block text-sm font-medium text-gray-600 mb-2">Attachments</span>
                        @if($note->supportingDocuments && $note->supportingDocuments->count())
                            @php
                                $imageExts = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
                                $images = [];
                                $others = [];
                                foreach($note->supportingDocuments as $doc) {
                                    $ext = strtolower(pathinfo($doc->file_name, PATHINFO_EXTENSION));
                                    if(in_array($ext, $imageExts)) {
                                        $images[] = $doc;
                                    } else {
                                        $others[] = $doc;
                                    }
                                }
                            @endphp

                            @if(count($images) > 0)
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                    @foreach($images as $doc)
                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $doc->file_path) }}" 
                                                 alt="Attachment" 
                                                 class="w-full h-auto rounded border hover:scale-105 transition-transform duration-200" />
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            @if(count($others) > 0)
                                @foreach($others as $doc)
                                    <a href="{{ asset('storage/' . $doc->file_path) }}" 
                                       target="_blank" 
                                       class="text-blue-600 underline flex items-center gap-1">
                                        <iconify-icon icon="mdi:file-document-outline"></iconify-icon>
                                        View Attachment
                                    </a><br>
                                @endforeach
                            @endif
                        @else
                            <span class="text-gray-500">No attachments</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
