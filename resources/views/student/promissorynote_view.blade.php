@php
    use Carbon\Carbon;
@endphp

@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col items-center px-2">


    <header class="fixed top-0 left-0 w-full z-50 shadow bg-white/95 backdrop-blur-sm print:hidden">
        @include('includes.header')
    </header>


    <div class="w-full max-w-4xl px-4 mt-20 sm:mt-28 mb-6 print:hidden">
        <div class="flex flex-row items-center justify-between gap-3">

            <a href="{{ route('student.dashboard') }}"
               class="inline-flex items-center justify-center gap-2 bg-[#660809] hover:bg-[#4a0708] text-white px-3 py-2 rounded-lg shadow transition text-sm sm:text-base w-1/2 min-w-0">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                <span class="truncate">Back to Dashboard</span>
            </a>


            <button onclick="window.print()"
                    class="no-print inline-flex items-center justify-center gap-2 bg-[#660809] hover:bg-[#4a0708] text-white px-3 py-2 rounded-lg shadow transition text-sm sm:text-base w-1/2 min-w-0">
                <iconify-icon icon="mdi:printer"></iconify-icon>
                <span class="truncate">Print Form</span>
            </button>
        </div>
    </div>

    {{-- Printable container --}}
    <div class="w-full flex justify-center pb-12 overflow-x-auto">
        <article
            class="bg-white rounded-2xl shadow-xl print:shadow-none border border-gray-200"
            style="width: 210mm; min-height: 297mm; max-width: 100%; margin: 0; padding: 0;">
            <div class="text-gray-900 text-base leading-normal p-4 sm:p-10 print-page">

                {{-- Letterhead --}}
                <header class="mb-8 sm:mb-10">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start sm:justify-center gap-4 sm:gap-6 mb-2 px-4 sm:px-0">
                        <img src="{{ asset('img/logo.jpg') }}"
                             alt="School Logo"
                             class="w-16 h-16 sm:w-20 sm:h-20 object-contain rounded-full border border-gray-200">

                        <div class="text-center sm:text-left">
                            <p class="font-serif font-bold text-xl sm:text-2xl text-[#660809] mb-0">
                                St. Peter's College
                            </p>
                            <p class="font-serif text-sm sm:text-base text-gray-700 leading-tight">
                                042 Sabayle St, Iligan City, 9200 Philippines<br>
                                Contact No.: (063)221-6246 or 222-0460<br>
                                Email Address: <span class="text-blue-600">OPsecretary@spc.edu.ph</span>
                            </p>
                        </div>
                    </div>

                    <h1 class="text-center font-sans font-bold text-lg sm:text-2xl tracking-wide mt-4">
                        PROMISSORY FORM<br>
                        <span class="block text-base sm:text-xl">DETAILS</span>
                    </h1>
                </header>

                {{-- Info section --}}
                <section class="card-section">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">

                        <div>
                            <span class="font-semibold text-gray-700">Date of Application:</span>
                            <span class="ml-2 text-gray-900">{{ Carbon::parse($note->created_at)->format('F d, Y') }}</span>
                        </div>

                        <div>

                            <span class="font-semibold text-gray-700">School ID No.:</span>
                            <span class="ml-2 text-gray-900">{{ $note->user->student_id ?? $note->student_id ?? 'N/A' }}</span>
                        </div>

                        <div>
                            <span class="font-semibold text-gray-700">Name of Student:</span>
                            <span class="ml-2 text-gray-900">{{ $note->user->fullname ?? $note->fullname ?? 'N/A' }}</span>
                        </div>

                        <div>
                            <span class="font-semibold text-gray-700 ">Program & Year:</span>
                            <span class="ml-2 text-gray-900">{{ $note->course ?? '-' }}{{ $note->year_level ? ' - ' . $note->year_level : '' }}</span>
                        </div>

                        <div>
                            <span class="font-semibold text-gray-700">Contact No.:</span>
                            <span class="ml-2 text-gray-900">{{ $note->phone ?? '-' }}</span>
                        </div>

                        <div>
                            <span class="font-semibold text-gray-700">Gender:</span>
                            <span class="ml-2 text-gray-900">{{ $note->gender ?? '-' }}</span>
                        </div>
                    </div>
                </section>

                {{-- Tuition Section --}}
                <section class="card-section">
                    <h3 class="section-title text-center">Tuition Fee Status</h3>
                    <div class="tuition-list">
                        <div class="tuition-row">
                            <span class="tuition-label">Balance (Assessment):</span>
                            <span class="tuition-value">₱{{ number_format($assessmentBalance ?? 0, 2) }}</span>
                        </div>
                        <div class="tuition-row">
                            <span class="tuition-label">Partial Payment:</span>
                            <span class="tuition-value">₱{{ number_format($partialPayment ?? 0, 2) }}</span>
                        </div>

                        {{-- Downpayment (added) --}}
                        <div class="tuition-row">
                            <span class="tuition-label">Downpayment:</span>
                            <span class="tuition-value">
                                ₱{{ number_format($note->downpayment ?? $note->down_payment ?? $note->down_payment_amount ?? 0, 2) }}
                            </span>
                        </div>

                        <div class="tuition-row">
                            <span class="tuition-label">Remaining Balance:</span>
                            <span class="tuition-value">₱{{ number_format($remainingBalance ?? 0, 2) }}</span>
                        </div>
                        <div class="tuition-row">
                            <span class="tuition-label">Due Date:</span>
                            <span class="tuition-value">{{ $note->due_date ?? '-' }}</span>
                        </div>
                        <div class="tuition-row">
                            <span class="tuition-label">Reason:</span>
                            <span class="tuition-value">
                                {{ $note->reason }}
                                @if(strtolower($note->reason ?? '') === 'other' && !empty($note->other_reason))
                                    - {{ $note->other_reason }}
                                @endif
                            </span>
                        </div>
                    </div>
                </section>

                {{-- Attachments --}}
                <section class="card-section">
                    <span class="font-semibold text-lg mb-4 block text-gray-700">Attachments:</span>
                    @php
                        $imageExts = ['jpg','jpeg','png','gif','bmp','webp'];
                        $images = [];
                        foreach($note->supportingDocuments as $doc) {
                            $ext = strtolower(pathinfo($doc->file_name, PATHINFO_EXTENSION));
                            if(in_array($ext, $imageExts)) { $images[] = $doc; }
                        }
                    @endphp

                    @if(count($images) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                            @foreach($images as $img)
                                @if(!empty($img->document_id))
                                    <div class="w-full h-56 overflow-hidden rounded-lg border border-gray-300 shadow-sm bg-gray-100 flex items-center justify-center">
                                        <img
                                            src="{{ route('student.attachments.download', $img->document_id) }}"
                                            alt="Attachment"
                                            class="max-w-full max-h-full object-contain"
                                            style="cursor:pointer"
                                            onerror="this.onerror=null;this.src='{{ asset('img/no-image.png') }}';"
                                            onclick="window.open('{{ route('student.attachments.download', $img->document_id) }}', '_blank')"
                                        />
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="mt-2 text-base text-gray-500">No attachments</div>
                    @endif
                </section>

                {{-- Signature --}}
                @if(!empty($note->signature_path))
                    <section class="card-section mt-6">
                        <span class="font-semibold text-lg mb-4 block text-gray-700">Signature:</span>
                        <div class="w-64 h-40 flex items-center justify-center border border-gray-300 rounded bg-gray-50">
                            <img
                                src="{{ route('student.signature.view', $note->pn_id) }}"
                                alt="Signature"
                                class="max-w-full max-h-full object-contain"
                                style="background: #fff;"
                                onerror="this.onerror=null;this.src='{{ asset('img/no-signature.png') }}';"
                            />
                        </div>
                    </section>
                @endif

                @if($note->status === 'rejected' && !empty($note->denial_reason))
                    <div class="mt-8" x-data="{ showDenialReason: false }">
                        <div class="flex items-center justify-between gap-4">
                            <a href="#"
                               @click.prevent="showDenialReason = true"
                               class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white hover:text-white font-semibold underline rounded-lg px-4 py-2 shadow transition print:hidden border ">
                                View Rejection Reason
                            </a>
                            <a href="{{ route('student.promissorynote.resubmit', $note->pn_id) }}"
                               class="no-print inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white hover:text-white   rounded-lg px-4 py-2 shadow transition font-semibold">
                                <iconify-icon icon="mdi:refresh"></iconify-icon>
                                Resubmit Promissory Note
                            </a>
                        </div>
                        <template x-if="showDenialReason">
                            <div class="mt-4 bg-[#660809] border border-black-700 rounded-lg p-4 text-white shadow">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-bold">Rejection Reason:</span>
                                    <button @click="showDenialReason = false" class="text-lg text-white hover:text-black">Close</button>
                                </div>
                                <p>{{ $note->denial_reason }}</p>
                            </div>
                        </template>
                    </div>
                @endif
            </div>
        </article>
    </div>
</div>
@endsection

<style>
@media print {
  .print-page {
    page-break-before: always;
    margin-top: 30px;
  }
  .no-print {
    display: none !important;
  }
}
</style>
