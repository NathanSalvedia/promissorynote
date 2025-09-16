@php use Carbon\Carbon; @endphp
@extends('layouts.layout')


@section('content')
 @include('includes.header')
<div class="max-w-5xl mx-auto p-6">

    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('student.dashboard') }}"
           class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
            <iconify-icon icon="mdi:arrow-left"></iconify-icon>
            Back to Dashboard
        </a>
    </div>
    <h1 class="text-2xl font-semibold mb-6">Payment History Ledger</h1>
    <div class="overflow-x-auto rounded-lg shadow bg-white">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th scope="col" class="px-6 py-3">School Year</th>
                    <th scope="col" class="px-6 py-3">Semester</th>
                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">Reference</th>
                    <th scope="col" class="px-6 py-3 text-right">Debit (₱)</th>
                    <th scope="col" class="px-6 py-3 text-right">Credit (₱)</th>
                    <th scope="col" class="px-6 py-3 text-right">Balance (₱)</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subledgerEntries as $entry)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $entry->school_year }}</td>
                        <td class="px-6 py-4">{{ $entry->semester }}</td>
                        <td class="px-6 py-4">{{ Carbon::parse($entry->date)->format('M d, Y') }}</td>
                        <td class="px-6 py-4">{{ $entry->reference }}</td>
                        <td class="px-6 py-4 text-right">{{ number_format($entry->debit, 2) }}</td>
                        <td class="px-6 py-4 text-right">{{ number_format($entry->credit, 2) }}</td>
                        <td class="px-6 py-4 text-right">₱{{ number_format($entry->balance, 2) }}</td>
                        <td class="px-6 py-4">
                            @if($entry->status == 'pending')
                                <span class="rounded bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-800">Pending</span>
                            @elseif($entry->status == 'posted')
                                <span class="rounded bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800">Posted</span>
                            @elseif($entry->status == 'cleared')
                                <span class="rounded bg-green-100 px-2 py-1 text-xs font-medium text-green-800">Cleared</span>
                            @else
                                <span class="rounded bg-gray-100 px-2 py-1 text-xs font-medium text-gray-800">{{ ucfirst($entry->status) }}</span>
                            @endif
                            <span class="ml-2 text-xs text-gray-500">({{ $entry->status }})</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">No payment history found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Legend --}}
    <div class="mt-6 text-sm text-gray-500">
        <p><span class="inline-block w-3 h-3 rounded bg-yellow-100 mr-1"></span> Pending = Awaiting confirmation</p>
        <p><span class="inline-block w-3 h-3 rounded bg-blue-100 mr-1"></span> Posted = Payment recorded</p>
        <p><span class="inline-block w-3 h-3 rounded bg-green-100 mr-1"></span> Cleared = Fully paid</p>
    </div>
</div>


@endsection
