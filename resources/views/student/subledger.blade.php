@extends('layouts.layout')

@section('content')
 @include('includes.header')

<div class="bg-gradient-to-b from-gray-200 to-gray-100 min-h-screen py-2">
    <div class="max-w-5xl mx-auto p-2 sm:p-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-2 relative">
            <h2 class="text-2xl font-bold text-gray-800">Account Subledger</h2>

            {{-- Back button: icon + text on all screens, right side --}}
            <a href="{{ route('student.dashboard') }}"
               class="absolute top-0 right-0 mt-1 mr-1 flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-700 rounded shadow z-10 px-3 py-1 text-sm font-medium"
               style="min-width:70px;">
                <span aria-hidden="true" class="text-lg mr-1">&laquo;</span>
                <span>Back</span>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-md sm:text-sm border border-gray-300 rounded-lg shadow">
                <thead>
                    <tr class="bg-gray-400 text-white">
                        <th class="px-4 py-2 text-left whitespace-nowrap overflow-hidden text-ellipsis">School Year</th>
                        <th class="px-4 py-2 text-left">Sem</th>
                        <th class="px-4 py-2 text-left whitespace-nowrap overflow-hidden text-ellipsis">Date</th>
                        <th class="px-4 py-2 text-left">Reference</th>
                        <th class="px-4 py-2 text-left">Debit</th>
                        <th class="px-4 py-2 text-left">Credit</th>
                        <th class="px-4 py-2 text-left">Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $currentSy = '';
                        $currentSem = '';
                    @endphp
                    @foreach($entries as $entry)
                        @if($currentSy !== $entry->school_year || $currentSem !== $entry->semester)
                            <tr class="bg-green-200 font-bold">
                                <td colspan="7" class="px-4 py-2">
                                    SY: {{ $entry->school_year }} SEM: {{ $entry->semester }}
                                </td>
                            </tr>
                            @php
                                $currentSy = $entry->school_year;
                                $currentSem = $entry->semester;
                            @endphp
                        @endif
                        <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
                            <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis">{{ $entry->school_year }}</td>
                            <td class="px-4 py-2">{{ $entry->semester }}</td>
                            <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis">{{ $entry->date }}</td>
                            <td class="px-4 py-2">{{ $entry->reference }}</td>
                            <td class="px-4 py-2">{{ number_format($entry->debit, 2) }}</td>
                            <td class="px-4 py-2">{{ number_format($entry->credit, 2) }}</td>
                            <td class="px-4 py-2">{{ number_format($entry->balance, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
