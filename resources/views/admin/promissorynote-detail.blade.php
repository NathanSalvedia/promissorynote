@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">

   @include('includes.header')

    <main class="p-6 max-w-3xl mx-auto w-full">

          <div class="mb-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-[#660809]  hover:text-[#000000] ">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Back to Dashboard
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-6">Promissory Note Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium mb-1">Full Name</label>
                    <div class="font-semibold">{{ $note->fullname }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Student ID</label>
                    <div class="font-semibold">{{ $note->student_id }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Gender</label>
                    <div class="font-semibold">{{ $note->gender }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Department</label>
                    <div class="font-semibold">{{ $note->department }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Phone</label>
                    <div class="font-semibold">{{ $note->phone }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Year Level</label>
                    <div class="font-semibold">{{ $note->year_level }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Amount</label>
                    <div class="font-semibold">₱{{ number_format($note->amount, 2) }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Reason</label>
                    <div class="font-semibold">{{ $note->reason }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Term</label>
                    <div class="font-semibold">{{ $note->term }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Academic Year</label>
                    <div class="font-semibold">{{ $note->academic_year }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Down Payment</label>
                    <div class="font-semibold">₱{{ number_format($note->down_payment, 2) }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Due Date</label>
                    <div class="font-semibold">{{ $note->due_date }}</div>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Additional Notes</label>
                    <div class="font-semibold">{{ $note->notes }}</div>
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
                </div>
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
</div>
@endsection
