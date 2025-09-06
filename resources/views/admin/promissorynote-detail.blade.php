@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">

    <!-- Fixed Header -->
    <header class="fixed top-0 left-0 w-full z-50 shadow bg-white">
        @include('includes.header')
    </header>

    <!-- Main content -->
    <main class="p-6 max-w-4xl mx-auto w-full mt-24">
        <div class="mb-6">
            <a href="{{ route('admin.dashboard') }}" 
               class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Back to Dashboard
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-8 text-[#660809]">Promissory Note Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-medium text-gray-600">Full Name</label>
                    <div class="text-lg">{{ $note->fullname }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Student ID</label>
                    <div class="text-lg">{{ $note->student_id }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Gender</label>
                    <div class="text-lg">{{ $note->gender }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Department</label>
                    <div class="text-lg">{{ $note->department }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Phone</label>
                    <div class="text-lg">{{ $note->phone }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Year Level</label>
                    <div class="text-lg">{{ $note->year_level }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Amount</label>
                    <div class="text-lg">₱{{ number_format($note->amount, 2) }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Reason</label>
                    <div class="text-lg">{{ $note->reason }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Term</label>
                    <div class="text-lg">{{ $note->term }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Academic Year</label>
                    <div class="text-lg">{{ $note->academic_year }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Down Payment</label>
                    <div class="text-lg">₱{{ number_format($note->down_payment, 2) }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Due Date</label>
                    <div class="text-lg">{{ $note->due_date }}</div>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-600">Additional Notes</label>
                    <div class="text-lg">{{ $note->notes }}</div>
                </div>
<<<<<<< HEAD

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
=======
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-600">Attachments</label>
                    <div>
                        @if($note->attachments)
                            @foreach(json_decode($note->attachments, true) as $file)
                                <a href="{{ asset('storage/' . $file) }}" 
                                   target="_blank" 
                                   class="text-blue-600 underline">View Attachment</a><br>
                            @endforeach
                        @else
                            <span class="text-gray-500">No attachments</span>
                        @endif
                    </div>
>>>>>>> cf160a76ff86df909a80c93f3a3b08dfd401936a
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
