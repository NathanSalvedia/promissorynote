@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">

    <!-- Header (sticky with bg + shadow) -->
    <header class="sticky top-0 z-50 bg-white shadow">
        @include('includes.header')
    </header>

    <main class="p-8 max-w-5xl mx-auto w-full">

        <!-- Back button -->
        <div class="mb-6">
            <a href="{{ route('student.dashboard') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#660809] text-white font-medium rounded-md shadow hover:bg-black transition duration-200">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Back to Dashboard
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white p-10 rounded-2xl shadow-xl">
            <h2 class="text-2xl font-bold mb-8 text-[#660809]">Promissory Note Details</h2>

            <!-- Grid Details -->
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
                    <div class="text-gray-800 text-lg">{{ $note->reason }}</div>
                </div>

                <div>
                    <label class="block text-sm text-gray-500 mb-1">Term</label>
                    <div class="text-gray-800 text-lg">{{ $note->term }}</div>
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

            <!-- Notes -->
            <div class="mt-8">
                <label class="block text-sm text-gray-500 mb-1">Additional Notes</label>
                <div class="text-gray-800 text-lg">{{ $note->notes }}</div>
            </div>

            <!-- Attachments -->
            <div class="mt-8">
                <label class="block text-sm text-gray-500 mb-2">Attachments</label>
                <div>
                    @if($note->attachments)
                        @php
                            $files = json_decode($note->attachments, true);
                            $imageExts = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
                            $images = [];
                            $others = [];
                            foreach($files as $file) {
                                $ext = pathinfo($file, PATHINFO_EXTENSION);
                                if(in_array(strtolower($ext), $imageExts)) {
                                    $images[] = $file;
                                } else {
                                    $others[] = $file;
                                }
                            }
                        @endphp

                        @if(count($images) > 0)
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                @foreach($images as $file)
                                    <a href="{{ asset('storage/' . $file) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $file) }}" 
                                             alt="Attachment" 
                                             class="w-full h-40 object-cover rounded-lg border shadow hover:scale-105 transition-transform duration-200" />
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        @if(count($others) > 0)
                            @foreach($others as $file)
                                <a href="{{ asset('storage/' . $file) }}" target="_blank" class="text-blue-600 underline flex items-center gap-1">
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
    </main>
</div>
@endsection
