@php
    use Carbon\Carbon;
@endphp

@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col items-center">


    <header class="fixed top-0 left-0 w-full z-50 shadow bg-white/95 backdrop-blur-sm print:hidden">
        @include('includes.admin')
    </header>


    <div class="w-full max-w-4xl px-6 mt-28 mb-6 print:hidden">
    <div class="flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#4a0708] text-white px-4 py-2 rounded-lg shadow transition">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Back to Dashboard
            </a>

       </div>
    </div>

    {{-- Printable container --}}
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
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                            @foreach($images as $img)
                                @if(!empty($img->document_id))
                                    <div class="w-full h-56 overflow-hidden rounded-lg border border-gray-300 shadow-sm bg-gray-100 flex items-center justify-center">
                                        <img
                                            src="{{ route('admin.attachments.download', $img->document_id) }}"
                                            alt="Attachment"
                                            class="max-w-full max-h-full object-contain"
                                            style="cursor:pointer"
                                            onclick="window.open('{{ route('admin.attachments.download', $img->document_id) }}', '_blank')"
                                        />
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="mt-2 text-base text-gray-500">No attachments</div>
                    @endif
                </section>

                     {{-- Signature --}}
                @if(!empty($note->signature_path))

                    <section class="card-section mt-6">
                        <span class="font-semibold text-lg mb-4 block text-gray-700">Signature:</span>
                        <div class="w-64 h-40 flex items-center justify-center border border-gray-300 rounded bg-gray-50">
                            <img
                                src="{{ route('admin.signature.view', $note->pn_id) }}"
                                alt="Signature"
                                class="max-w-full max-h-full object-contain"
                                style="background: #fff;"
                                onerror="this.onerror=null;this.src='{{ asset('img/no-signature.png') }}';"
                            />
                        </div>
                    </section>
                @endif

                @if($note->status !== 'approved')
                    <div class="flex items-center justify-between gap-4 mt-4">
                        <div>
                            <a href="#"
                               class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white hover:text-white font-semibold underline rounded-lg px-4 py-2 shadow transition print:hidden border"
                               onclick="document.getElementById('rejectModal').classList.remove('hidden'); return false;">
                                <iconify-icon icon="mdi:close-circle"></iconify-icon>
                                Reject Request
                            </a>
                        </div>


                        @if($note->status === 'rejected' && !empty($note->denial_reason))
                            <div>
                                <a href="#" onclick="document.getElementById('adminReasonModal').classList.remove('hidden'); return false;"
                                   class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white hover:text-white font-semibold underline rounded-lg px-4 py-2 shadow transition">
                                    <iconify-icon icon="mdi:close-circle"></iconify-icon>
                                    View Rejection Reason
                                </a>
                            </div>
                        @endif
                    </div>

                    {{-- Modal --}}
                    <div id="rejectModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
                        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
                            <button type="button" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700"
                                    onclick="document.getElementById('rejectModal').classList.add('hidden');">
                                <iconify-icon icon="mdi:close"></iconify-icon>
                            </button>
                            <form action="{{ route('admin.promissorynote.deny', $note->pn_id) }}" method="POST">
                                @csrf
                                <h3 class="text-lg font-semibold text-[#660809] mb-4">Reject Request</h3>
                                <label for="denial_reason" class="block font-medium text-gray-700 mb-2">State Denial Request Reasons:</label>
                                <textarea id="denial_reason" name="denial_reason" rows="4" required
                                    class="w-full border border-gray-300 rounded-lg p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-[#660809]"></textarea>
                                <div class="flex justify-end gap-2">
                                    <button type="button" class="px-4 py-2 rounded bg-[#660809] hover:bg-black text-white"
                                            onclick="document.getElementById('rejectModal').classList.add('hidden');">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
                                        <iconify-icon icon="mdi:close-circle"></iconify-icon>
                                        Submit Rejection
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                @if($note->status === 'rejected' && !empty($note->denial_reason))
                    <div id="adminReasonModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
                        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
                            <button type="button" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 flex items-center gap-1"
                                    onclick="document.getElementById('adminReasonModal').classList.add('hidden');">
                                <span class="text-md font-semibold bg-[#660809] hover:bg-black text-white px-2 py-1 rounded">Close</span>
                            </button>
                            <h3 class="text-lg font-semibold text-[#660809] mb-4">Admin's Rejection Reason</h3>
                            <div class="w-full border border-[#660809] rounded-lg p-2 mb-4">{{ $note->denial_reason }}</div>
                        </div>
                    </div>
                @endif


            </div>
        </article>
    </div>
</div>
@endsection
