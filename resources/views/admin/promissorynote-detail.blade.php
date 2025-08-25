@extends('layouts.layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow p-8 mt-8">
    <h2 class="text-2xl font-bold mb-6 text-[#660809]">Promissory Note Details</h2>
    <div class="space-y-4">
        <div><span class="font-semibold">Note ID:</span> {{ $note->pn_id }}</div>
        <div><span class="font-semibold">Full Name:</span> {{ $note->fullname }}</div>
        <div><span class="font-semibold">Student ID:</span> {{ $note->student_id }}</div>
        <div><span class="font-semibold">Department:</span> {{ $note->department }}</div>
        <div><span class="font-semibold">Amount:</span> ₱{{ number_format($note->amount, 2) }}</div>
        <div><span class="font-semibold">Reason:</span> {{ $note->reason }}</div>
        <div><span class="font-semibold">Date Submitted:</span> {{ $note->created_at->format('M d, Y h:i A') }}</div>
        <div><span class="font-semibold">Status:</span> <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $note->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($note->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">{{ ucfirst($note->status) }}</span></div>
        @if($note->notes)
            <div><span class="font-semibold">Additional Notes:</span> {{ $note->notes }}</div>
        @endif
        @if($note->attachments)
            <div><span class="font-semibold">Attachments:</span> <a href="{{ asset('storage/' . $note->attachments) }}" target="_blank" class="text-blue-600 underline">View Attachment</a></div>
        @endif
    </div>
    <div class="mt-8">
        <a href="{{ route('admin.manage-record') }}" class="inline-block bg-[#660809] hover:bg-[#000000] text-white px-4 py-2 rounded-lg">Back to List</a>
    </div>
</div>
@endsection
