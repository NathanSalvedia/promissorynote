@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col items-center">

    {{-- Sticky Header (visible on screen, hidden when printing) --}}
    <header class="fixed top-0 left-0 w-full z-50 shadow bg-white/95 backdrop-blur-sm print:hidden">
        @include('includes.header')
    </header>

    {{-- Top controls --}}
    <div class="w-full max-w-5xl px-6 mt-28 mb-4 print:hidden">
        <div class="flex items-center justify-between">
            <a href="{{ route('student.dashboard') }}"
               class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#4a0708] text-white px-4 py-2 rounded-md shadow transition">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Back to Dashboard
            </a>

            <button onclick="window.print()"
                    class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#4a0708] text-white px-4 py-2 rounded-md shadow transition">
                <iconify-icon icon="mdi:printer"></iconify-icon>
                Print Form
            </button>
        </div>
    </div>

    {{-- Printable container --}}
    <div class="w-full flex justify-center pb-12">
        <article
            class="bg-white border border-gray-200 shadow-lg print:shadow-none rounded-none overflow-hidden"
            style="width: 210mm; min-height: 297mm; max-width: 100%; margin: 0; padding: 0;">

            <style>
                @media print {
                    @page { 
                        size: A4; 
                        margin: 0;
                    }

                    html, body {
                        background: white !important;
                        margin: 0 !important;
                        padding: 0 !important;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                        zoom: 0.96;
                    }

                    .min-h-screen,
                    .bg-gray-100,
                    .flex,
                    .items-center,
                    .pb-12 {
                        background: white !important;
                        margin: 0 !important;
                        padding: 0 !important;
                    }

                    .print\:hidden { display: none !important; }
                    .shadow-lg { box-shadow: none !important; }
                    .border { border: 0 !important; }
                }

                .text-xs { font-size: 0.75rem; }
                .text-sm { font-size: 0.85rem; }
                .text-base { font-size: 0.95rem; }
            </style>

            <div class="text-gray-900 text-sm leading-snug p-0 m-0">

                {{-- Letterhead --}}
                <header class="text-center mb-4">
                    <div class="flex items-center justify-center gap-4">
                        <img src="{{ asset('img/logo.jpg') }}"
                             alt="School Logo"
                             class="w-16 h-16 object-contain rounded-full border border-gray-200">
                        <div class="text-left">
                            <p class="text-xl font-extrabold text-[#660809] leading-tight">St Peter's College</p>
                            <p class="text-sm font-medium">042 Sabayle St, Iligan City, 9200 Philippines</p>
                            <p class="text-xs text-blue-600">Email: OPsecretary@spc.edu.ph</p>
                        </div>
                    </div>

                    <h1 class="mt-4 text-base font-bold uppercase text-[#660809]">
                        Promissory Note Details
                    </h1>
                </header>

                {{-- Info section --}}
                <section class="mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2">
                        <div class="flex">
                            <span class="w-44 font-semibold">Date of Application:</span>
                            <span class="flex-1 border-b border-gray-400">{{ \Carbon\Carbon::parse($note->created_at)->format('F d, Y') }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-44 font-semibold">School ID No.:</span>
                            <span class="flex-1 border-b border-gray-400">{{ $note->student_id }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-44 font-semibold">Name of Student:</span>
                            <span class="flex-1 border-b border-gray-400">{{ $note->fullname }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-44 font-semibold">Program & Year:</span>
                            <span class="flex-1 border-b border-gray-400">{{ $note->course ?? '-' }} {{ $note->year_level ? '- ' . $note->year_level : '' }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-44 font-semibold">Contact No.:</span>
                            <span class="flex-1 border-b border-gray-400">{{ $note->phone ?? '-' }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-44 font-semibold">Gender:</span>
                            <span class="flex-1 border-b border-gray-400">{{ $note->gender ?? '-' }}</span>
                        </div>
                    </div>
                </section>

                {{-- Note --}}
                <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 px-3 py-1 mb-4 text-xs font-semibold">
                    NOTE: Please ensure that the form is filled out completely.
                </div>

                {{-- Tuition Section --}}
                <section class="mb-5">
                    <h3 class="text-center text-xs font-bold uppercase border-y border-gray-300 py-1 mb-2">
                        Tuition Fee Status
                    </h3>

                    <div class="border border-gray-400 text-xs">
                        <div class="flex border-b border-gray-400">
                            <div class="w-1/2 px-2 py-2 font-medium bg-gray-50">Balance (Assessment):</div>
                            <div class="w-1/2 px-2 py-2">₱{{ number_format($note->amount ?? 0, 2) }}</div>
                        </div>
                        <div class="flex border-b border-gray-400">
                            <div class="w-1/2 px-2 py-2 font-medium bg-gray-50">Partial Payment:</div>
                            <div class="w-1/2 px-2 py-2">₱{{ number_format($note->down_payment ?? 0, 2) }}</div>
                        </div>
                        <div class="flex border-b border-gray-400">
                            <div class="w-1/2 px-2 py-2 font-medium bg-gray-50">Remaining Balance:</div>
                            <div class="w-1/2 px-2 py-2">₱{{ number_format((($note->amount ?? 0) - ($note->down_payment ?? 0)), 2) }}</div>
                        </div>
                        <div class="flex border-b border-gray-400">
                            <div class="w-1/2 px-2 py-2 font-medium bg-gray-50">Due Date:</div>
                            <div class="w-1/2 px-2 py-2">{{ $note->due_date ?? '-' }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-1/2 px-2 py-2 font-medium bg-gray-50">Reason:</div>
                            <div class="w-1/2 px-2 py-2">
                                {{ $note->reason }}
                                @if(strtolower($note->reason ?? '') === 'other' && !empty($note->other_reason))
                                    - {{ $note->other_reason }}
                                @endif
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Attachments --}}
                <section class="mb-5">
                    <span class="font-semibold text-xs">Attachments:</span>

                    @if($note->supportingDocuments && $note->supportingDocuments->count())
                        @php
                            $imageExts = ['jpg','jpeg','png','gif','bmp','webp'];
                            $images = [];
                            foreach($note->supportingDocuments as $doc) {
                                $ext = strtolower(pathinfo($doc->file_name, PATHINFO_EXTENSION));
                                if(in_array($ext, $imageExts)) { $images[] = $doc; }
                            }
                        @endphp

                        @if(count($images) > 0)
                            <div class="grid grid-cols-3 gap-2 mt-2">
                                @foreach($images as $img)
                                    <img src="{{ asset('storage/' . $img->file_path) }}" alt="Attachment"
                                         class="w-full h-24 object-cover border border-gray-300">
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="mt-1 text-xs text-gray-500">No attachments</div>
                    @endif
                </section>

                {{-- Signatures --}}
                <section class="mt-6">
                    <div class="flex justify-between items-center">
                        <div class="w-1/2 text-center">
                            <div class="border-t border-gray-600 mt-8 w-4/5 mx-auto"></div>
                            <p class="mt-1 text-xs font-semibold">Student's Signature</p>
                        </div>
                        <div class="w-1/2 text-center">
                            <div class="border-t border-gray-600 mt-8 w-4/5 mx-auto"></div>
                            <p class="mt-1 text-xs font-semibold">Admin's Signature</p>
                        </div>
                    </div>
                </section>

            </div>
        </article>
    </div>
</div>
@endsection
