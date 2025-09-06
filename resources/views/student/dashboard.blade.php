@extends('layouts.layout')

@section('content')

<div class="min-h-screen bg-gray-100 flex flex-col">

    @include('includes.header')

    <main class="p-6 max-w-7xl mx-auto w-full">

        {{-- Header + Actions --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h2 class="text-2xl font-bold text-[#660809]">Student Dashboard</h2>

            <div class="flex gap-3 mt-4 sm:mt-0">
                <a href="{{ route('student.promissorynote') }}"
                   class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
                    <iconify-icon icon="mdi:plus-circle-outline" class="animate-bounce"></iconify-icon>
                    New Promissory Note
                </a>

                <a href="{{ route('student.subledger')}}"
                   class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
                    <iconify-icon icon="mdi:clipboard-list-outline" class="animate-bounce"></iconify-icon>
                    Account Subledger
                </a>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">
            <div class="bg-[#660809] text-white p-6 rounded-xl shadow-lg hover:bg-black transition">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:file-document-outline" class="text-2xl animate-pulse"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm opacity-90">Total Notes</p>
                        <p class="text-3xl font-bold">{{ $promissoryNotes->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#660809] text-white p-6 rounded-xl shadow-lg hover:bg-black transition">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:clock-outline" class="text-2xl animate-bounce"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm opacity-90">Pending</p>
                        <p class="text-3xl font-bold">
                            {{ $promissoryNotes->where('status', 'pending')->count() }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-[#660809] text-white p-6 rounded-xl shadow-lg hover:bg-black transition">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-2xl animate-pulse"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm opacity-90">Approved</p>
                        <p class="text-3xl font-bold">
                            {{ $promissoryNotes->where('status', 'approved')->count() }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-[#660809] text-white p-6 rounded-xl shadow-lg hover:bg-black transition">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:currency-php" class="text-2xl animate-bounce"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm opacity-90">Total Amount</p>
                        <p class="text-2xl font-bold">
                            ₱{{ number_format($promissoryNotes->sum('amount'), 2) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Promissory Notes Table --}}
        <div class="bg-white rounded-2xl shadow border overflow-hidden">
            <div class="px-6 py-4 bg-[#660809] text-white flex justify-between items-center">
                <h3 class="text-xl font-bold">My Promissory Notes</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Note ID</th>
                            <th class="px-6 py-3 text-left font-semibold">Amount</th>
                            <th class="px-6 py-3 text-left font-semibold">Reason</th>
                            <th class="px-6 py-3 text-left font-semibold">Status</th>
                            <th class="px-6 py-3 text-left font-semibold">Date</th>
                            <th class="px-6 py-3 text-left font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'approved' => 'bg-green-100 text-green-800',
                                'rejected' => 'bg-red-100 text-red-800',
                            ];
                        @endphp
                        @forelse($promissoryNotes as $note)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium">{{ $note->pn_id }}</td>
                                <td class="px-6 py-4 font-semibold">₱{{ number_format($note->amount, 2) }}</td>
                                <td class="px-6 py-4">{{ $note->reason }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$note->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($note->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div>{{ $note->created_at->format('Y-m-d') }}</div>
                                    <div class="text-gray-500 text-xs">{{ $note->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('student.promissorynote.view', $note->pn_id) }}"
                                       class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-[#660809] hover:bg-black text-white transition"
                                       title="View">
                                        <iconify-icon icon="mdi:eye-outline" class="animate-pulse"></iconify-icon>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">No promissory notes found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

@endsection
