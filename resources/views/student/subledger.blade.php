@extends('layouts.layout')

@section('content')
 @include('includes.header')

<div class="bg-gradient-to-b from-gray-200 to-gray-100 min-h-screen py-2">
    <div class="max-w-5xl mx-auto p-4">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Account Subledger</h2>
            <a href="{{ route('student.dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded shadow">&laquo; Back</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg shadow">
                <thead>
                    <tr class="bg-gray-400 text-white">
                        <th class="px-4 py-2 text-left">School Year</th>
                        <th class="px-4 py-2 text-left">Sem</th>
                        <th class="px-4 py-2 text-left">Date</th>
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
                            <td class="px-4 py-2">{{ $entry->school_year }}</td>
                            <td class="px-4 py-2">{{ $entry->semester }}</td>
                            <td class="px-4 py-2">{{ $entry->date }}</td>
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
