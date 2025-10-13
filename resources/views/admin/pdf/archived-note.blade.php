@php
    use Carbon\Carbon;
@endphp

@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col items-center">
    <div class="w-full flex justify-center pb-12">
        <article
            class="bg-white rounded-2xl shadow-xl print:shadow-none border border-gray-200"
            style="width: 210mm; min-height: 297mm; max-width: 100%; margin: 0; padding: 0;">
            <div class="text-gray-900 text-base leading-normal p-10">

                {{-- Letterhead --}}
                <header class="text-center mb-10">
                    <div class="flex items-center justify-center gap-6 mb-2">
                        <img src="{{ asset('img/logo.jpg') }}"
                             alt="School Logo"
                             class="w-20 h-20 object-contain rounded-full border border-gray-200">
                        <div class="text-left">
                            <p style="font-family: 'Times New Roman', Times, serif; font-weight: bold; font-size: 2rem; color: #660809; margin-bottom: 0;">
                                St. Peter's College
                            </p>
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 1rem;">
                                042 Sabayle St, Iligan City, 9200 Philippines<br>
                                Contact No.: (063)221-6246 or 222-0460<br>
                                Email Address: <span style="color: #2563eb;">OPsecretary@spc.edu.ph</span>
                            </p>
                        </div>
                    </div>

                    <h1 style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 1.7rem; margin-top: 2rem; letter-spacing: 1px;">
                        PROMISSORY FORM<br>
                        <span style="font-size: 1.5rem;">DETAILS</span>
                    </h1>
                </header>

                {{-- Info section --}}
                <section class="card-section mb-8">
                    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
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
                    </div>
                </section>

                {{-- Tuition Section --}}
                <section class="card-section mb-8">
                    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                        <h3 class="section-title text-center font-bold mb-4 text-lg">Tuition Fee Status</h3>
                        <div class="tuition-list">
                            <div class="tuition-row flex justify-between py-2 border-b">
                                <span class="tuition-label font-semibold text-gray-700">Balance (Assessment):</span>
                                <span class="tuition-value font-bold text-red-700">₱{{ number_format($assessmentBalance ?? 0, 2) }}</span>
                            </div>
                            <div class="tuition-row flex justify-between py-2 border-b">
                                <span class="tuition-label font-semibold text-gray-700">Partial Payment:</span>
                                <span class="tuition-value font-bold text-gray-900">₱{{ number_format($partialPayment ?? 0, 2) }}</span>
                            </div>
                            <div class="tuition-row flex justify-between py-2 border-b">
                                <span class="tuition-label font-semibold text-gray-700">Remaining Balance:</span>
                                <span class="tuition-value font-bold text-red-700">₱{{ number_format($remainingBalance ?? 0, 2) }}</span>
                            </div>
                            <div class="tuition-row flex justify-between py-2 border-b">
                                <span class="tuition-label font-semibold text-gray-700">Due Date:</span>
                                <span class="tuition-value text-gray-900">{{ $note->due_date ?? '-' }}</span>
                            </div>
                            <div class="tuition-row flex justify-between py-2">
                                <span class="tuition-label font-semibold text-gray-700">Reason:</span>
                                <span class="tuition-value text-gray-900">
                                    {{ $note->reason }}
                                    @if(strtolower($note->reason ?? '') === 'other' && !empty($note->other_reason))
                                        - {{ $note->other_reason }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Attachments --}}
                <section class="card-section mb-8">
                    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                        <span class="font-semibold text-lg mb-4 block text-gray-700">Attachments:</span>
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
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                                    @foreach($images as $img)
                                        <div class="w-full h-56 overflow-hidden rounded-lg border border-gray-300 shadow-sm bg-gray-100 flex items-center justify-center">
                                            <img src="{{ asset('storage/' . $img->file_path) }}" alt="Attachment"
                                                 class="max-w-full max-h-full object-contain" />
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @else
                            <div class="mt-2 text-base text-gray-500">No attachments</div>
                        @endif
                    </div>
                </section>
            </div>
        </article>
    </div>
</div>
@endsection
