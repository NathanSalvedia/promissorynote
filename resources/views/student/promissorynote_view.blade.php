@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-white flex flex-col">

    {{-- ✅ Sticky Header --}}
    <header class="sticky top-0 z-50 bg-white shadow">
        @include('includes.header')
    </header>

    <main class="p-8 max-w-5xl mx-auto w-full">

        {{-- 🔙 Back Button --}}
        <div class="mb-6">
            <a href="{{ route('student.dashboard') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#660809] text-white font-medium rounded-md shadow hover:bg-black transition duration-200">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Back to Dashboard
            </a>
        </div>

        {{-- 🧾 Promissory Note Details (Paper Style) --}}
        <div class="relative bg-white rounded-2xl shadow-lg border border-gray-200 p-10 overflow-hidden">

            {{-- Subtle Paper Texture --}}
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/paper-fibers.png')] opacity-10 pointer-events-none"></div>

            <div class="relative z-10">
                {{-- 📌 Header with Logo --}}
                <div class="flex items-center gap-3 mb-8 border-b-2 border-[#660809] pb-2">
                    <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="w-20 h-20 object-contain">
                    <h2 class="text-3xl font-bold text-[#660809]">
                        Promissory Note Details
                    </h2>
                </div>

                {{-- 📋 Details Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 text-gray-800">

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Full Name</span>
                        <p class="text-base font-semibold">{{ $note->fullname }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Student ID</span>
                        <p class="text-base font-semibold">{{ $note->student_id }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Gender</span>
                        <p class="text-base font-semibold">{{ $note->gender }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Department</span>
                        <p class="text-base font-semibold">{{ $note->department }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Phone</span>
                        <p class="text-base font-semibold">{{ $note->phone }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Year Level</span>
                        <p class="text-base font-semibold">{{ $note->year_level }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Amount</span>
                        <p class="text-base font-semibold">₱{{ number_format($note->amount, 2) }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Reason</span>
                        <p class="text-base font-semibold">
                            {{ $note->reason }}
                            @if(strtolower($note->reason) === 'other' && !empty($note->other_reason))
                                <br>
                                <span class="text-sm text-gray-600">
                                    <span class="font-semibold">Specified Reason:</span>
                                    {{ $note->other_reason }}
                                </span>
                            @endif
                        </p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Semester</span>
                        <p class="text-base font-semibold">{{ $note->semester ?? $note->term }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Academic Year</span>
                        <p class="text-base font-semibold">{{ $note->academic_year }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Down Payment</span>
                        <p class="text-base font-semibold">₱{{ number_format($note->down_payment, 2) }}</p>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-600">Due Date</span>
                        <p class="text-base font-semibold">{{ $note->due_date }}</p>
                    </div>
                </div>

                {{-- 📝 Additional Notes --}}
                <div class="mt-8">
                    <span class="block text-sm font-medium text-gray-600">Additional Notes</span>
                    <p class="text-base font-semibold">{{ $note->notes }}</p>
                </div>

                {{-- 📎 Attachments --}}
                <div class="mt-8">
                    <span class="block text-sm font-medium text-gray-600">Attachments</span>
                    <div>
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
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 mt-2">
                                    @foreach($images as $doc)
                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $doc->file_path) }}" alt="Attachment"
                                                class="w-full h-auto rounded border hover:scale-105 transition-transform duration-200" />
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            @if(count($others) > 0)
                                @foreach($others as $doc)
                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
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
