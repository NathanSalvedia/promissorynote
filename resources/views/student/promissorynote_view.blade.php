@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col items-center">

    {{-- ✅ Sticky Header (hidden when printing) --}}
    <header class="fixed top-0 left-0 w-full z-50 shadow bg-white/95 backdrop-blur-sm print:hidden">
        @include('includes.header')
    </header>

    {{-- ✅ Top Controls --}}
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

    {{-- ✅ Printable Page --}}
    <div class="w-full flex justify-center pb-12">
        <article class="bg-white border border-gray-400 shadow-lg print:shadow-none overflow-hidden"
                 style="width: 8.5in; min-height: 10.9in; padding: 0.9in; font-family: 'Times New Roman', serif; font-size: 13px; line-height: 1.3;">

            {{-- ✅ Print Styles --}}
            <style>
                @media print {
                    @page {
                        size: Letter;
                        margin: 0.65in;
                    }
                    html, body {
                        background: white !important;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }
                    .print\:hidden { display: none !important; }
                    article {
                        width: 100%;
                        height: 100%;
                        overflow: visible !important;
                    }
                }

                .section-title {
                    font-weight: bold;
                    text-transform: uppercase;
                    border-top: 2px solid #000;
                    border-bottom: 2px solid #000;
                    padding: 4px 0;
                    text-align: center;
                    color: #660809;
                    margin-bottom: 8px;
                    font-size: 14px;
                }

                .info-row {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 3px;
                }
                .info-col {
                    display: flex;
                    width: 48%;
                    align-items: flex-end;
                }
                .info-label {
                    font-weight: 600;
                    width: 45%;
                }
                .info-value {
                    flex: 1;
                    border-bottom: 1px solid #000;
                    text-align: left;
                    padding-bottom: 1px;
                    font-weight: 500;
                }

                .data-table div {
                    border-color: #000;
                }
            </style>

            {{-- ✅ Header --}}
            <header class="text-center mb-4">
                <div class="flex items-center justify-center gap-3">
                    <img src="{{ asset('img/logo.jpg') }}" alt="Logo"
                         class="w-14 h-14 object-contain rounded-full border border-gray-300">
                    <div class="text-left leading-tight">
                        <p class="text-lg font-extrabold text-[#660809]">St Peter's College</p>
                        <p class="text-xs font-medium">042 Sabayle St, Iligan City, 9200 Philippines</p>
                        <p class="text-[11px] text-blue-700">Email: OPsecretary@spc.edu.ph</p>
                    </div>
                </div>

                <h1 class="mt-3 text-sm font-bold uppercase text-[#660809] border-y border-gray-400 py-1 tracking-wide">
                    Promissory Note Details
                </h1>
            </header>

            {{-- ✅ Student Info --}}
            <section class="mb-3 text-[13px]">
                <div class="info-row">
                    <div class="info-col">
                        <span class="info-label">Date of Application:</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($note->created_at)->format('F d, Y') }}</span>
                    </div>
                    <div class="info-col">
                        <span class="info-label">School ID No.:</span>
                        <span class="info-value">{{ $note->student_id }}</span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-col">
                        <span class="info-label">Name of Student:</span>
                        <span class="info-value">{{ $note->fullname }}</span>
                    </div>
                    <div class="info-col">
                        <span class="info-label">Program & Year:</span>
                        <span class="info-value">
                            {{ $note->course ?? '-' }} {{ $note->year_level ? '- ' . $note->year_level : '' }}
                        </span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-col">
                        <span class="info-label">Contact No.:</span>
                        <span class="info-value">{{ $note->phone ?? '-' }}</span>
                    </div>
                    <div class="info-col">
                        <span class="info-label">Gender:</span>
                        <span class="info-value">{{ $note->gender ?? '-' }}</span>
                    </div>
                </div>
            </section>

            {{-- ✅ Note Box --}}
            <div class="bg-yellow-100 border-l-4 border-yellow-600 px-4 py-2 text-[12px] font-semibold mb-3 rounded-sm">
                NOTE: Please ensure that all fields are filled out completely before submission.
            </div>

            {{-- ✅ Tuition Fee Status --}}
            <section class="mb-5 text-[12.5px]">
                <div class="section-title">Tuition Fee Status</div>

                <div class="border border-black data-table">
                    <div class="flex border-b">
                        <div class="w-1/2 px-3 py-1.5 font-semibold bg-gray-100 border-r">Balance (Assessment):</div>
                        <div class="w-1/2 px-3 py-1.5">₱{{ number_format($note->amount ?? 0, 2) }}</div>
                    </div>
                    <div class="flex border-b">
                        <div class="w-1/2 px-3 py-1.5 font-semibold bg-gray-100 border-r">Partial Payment:</div>
                        <div class="w-1/2 px-3 py-1.5">₱{{ number_format($note->down_payment ?? 0, 2) }}</div>
                    </div>
                    <div class="flex border-b">
                        <div class="w-1/2 px-3 py-1.5 font-semibold bg-gray-100 border-r">Remaining Balance:</div>
                        <div class="w-1/2 px-3 py-1.5">₱{{ number_format((($note->amount ?? 0) - ($note->down_payment ?? 0)), 2) }}</div>
                    </div>
                    <div class="flex border-b">
                        <div class="w-1/2 px-3 py-1.5 font-semibold bg-gray-100 border-r">Due Date:</div>
                        <div class="w-1/2 px-3 py-1.5">{{ $note->due_date ?? '-' }}</div>
                    </div>
                    <div class="flex">
                        <div class="w-1/2 px-3 py-1.5 font-semibold bg-gray-100 border-r">Reason:</div>
                        <div class="w-1/2 px-3 py-1.5">
                            {{ $note->reason }}
                            @if(strtolower($note->reason ?? '') === 'other' && !empty($note->other_reason))
                                - {{ $note->other_reason }}
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            {{-- ✅ Attachments --}}
            <section class="mb-4">
                <p class="font-semibold text-xs mb-1">Attachments:</p>

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
                        <div class="grid grid-cols-3 gap-2 mt-1">
                            @foreach($images as $img)
                                <img src="{{ asset('storage/' . $img->file_path) }}" alt="Attachment"
                                     class="w-full h-24 object-cover border border-gray-300 rounded">
                            @endforeach
                        </div>
                    @endif
                @else
                    <p class="text-xs text-gray-500">No attachments provided.</p>
                @endif
            </section>

            {{-- ✅ Signatures --}}
            <section class="mt-6">
                <div class="flex justify-between items-center">
                    <div class="w-1/2 text-center">
                        <div class="border-t border-black mt-8 w-4/5 mx-auto"></div>
                        <p class="mt-1 text-xs font-semibold">Student's Signature</p>
                    </div>
                    <div class="w-1/2 text-center">
                        <div class="border-t border-black mt-8 w-4/5 mx-auto"></div>
                        <p class="mt-1 text-xs font-semibold">Admin's Signature</p>
                    </div>
                </div>
            </section>

        </article>
    </div>
</div>
@endsection
