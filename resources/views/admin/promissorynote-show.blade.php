@extends('layouts.layout')

@section('content')
@include('includes.admin')

 <main class="p-8 max-w-5xl mx-auto w-full">

        <div class="mb-6">
            <a href="{{ route('admin.manage-record') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#660809] text-white font-medium rounded-md shadow hover:bg-black transition duration-200">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Back to Manage Record
            </a>
        </div>

        <div class="bg-white p-10 rounded-2xl shadow-xl">
            <h2 class="text-2xl font-bold mb-8 text-[#660809]">Promissory Note Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Full Name</label>
                    <div class="text-gray-800 text-lg">{{ $note->fullname }}</div>
                </div>

                <div>
                    <label class="block text-sm text-gray-500 mb-1">Student ID</label>
                    <div class="text-gray-800 text-lg">{{ $note->student_id }}</div>
                </div>

                <div>
                    <label class="block text-sm text-gray-500 mb-1">Gender</label>
                    <div class="text-gray-800 text-lg">{{ $note->gender }}</div>
                </div>

                <div>
                    <label class="block text-sm text-gray-500 mb-1">Department</label>
                    <div class="text-gray-800 text-lg">{{ $note->department }}</div>
                </div>

                <div>
                    <label class="block text-sm text-gray-500 mb-1">Phone</label>
                    <div class="text-gray-800 text-lg">{{ $note->phone }}</div>
                </div>

                <div>
                    <label class="block text-sm text-gray-500 mb-1">Year Level</label>
                    <div class="text-gray-800 text-lg">{{ $note->year_level }}</div>
                </div>

                <div>
                    <label class="block text-sm text-gray-500 mb-1">Amount</label>
                    <div class="text-gray-800 text-lg">₱{{ number_format($note->amount, 2) }}</div>
                </div>

                <div>
                    <label class="block text-sm text-gray-500 mb-1">Reason</label>
                    <div class="text-gray-800 text-lg">
                        {{ $note->reason }}
                        @if(strtolower($note->reason) === 'other' && !empty($note->other_reason))
                            <br>
                            <span class="text-sm  text-gray-600">
                                <span class="font-semibold">Specified Reason:</span>
                                {{ $note->other_reason }}
                            </span>
                        @endif
                    </div>
                </div>

                <div>
                    <label class="block text-sm text-gray-500 mb-1">Semester</label>
                    <div class="text-gray-800 text-lg">{{ $note->semester ?? $note->term }}</div>
                </div>

                <div>
                    <label class="block text-sm text-gray-500 mb-1">Academic Year</label>
                    <div class="text-gray-800 text-lg">{{ $note->academic_year }}</div>
                </div>


                <div>
                    <label class="block text-sm text-gray-500 mb-1">Down Payment</label>
                    <div class="text-gray-800 text-lg">₱{{ number_format($note->down_payment, 2) }}</div>
                </div>

                <div>
                    <label class="block text-sm text-gray-500 mb-1">Due Date</label>
                    <div class="text-gray-800 text-lg">{{ $note->due_date }}</div>
                </div>
            </div>


            <div class="mt-8">
                <label class="block text-sm text-gray-500 mb-1">Additional Notes</label>
                <div class="text-gray-800 text-lg">{{ $note->notes }}</div>
            </div>

              <div class="md:col-span-2">
                   <label class="block text-sm font-medium mb-1">Attachments</label>
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
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                    @foreach($images as $doc)
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $doc->file_path) }}" alt="Attachment" class="w-full h-auto rounded border hover:scale-105 transition-transform duration-200" />
                        </a>
                    @endforeach
             @endif

             @if(count($others) > 0)
                @foreach($others as $doc)
                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-blue-600 underline flex items-center gap-1">
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

@endsection
