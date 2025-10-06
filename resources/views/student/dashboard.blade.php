@extends('layouts.layout')

@section('content')

{{-- 1. Outer container now uses 'h-screen' and 'overflow-hidden' 
      to ensure the *entire page* doesn't scroll, but the inner main content does. --}}
<div class="h-screen bg-white flex flex-col overflow-hidden">

    {{-- STICKY HEADER WRAPPER (This is already correctly set to sticky top-0) --}}
    <div class="sticky top-0 z-50 bg-white shadow-md">
        @include('includes.header')
    </div>

    {{-- 2. MAIN CONTENT: Now uses 'flex-grow' and 'overflow-y-auto' 
          to fill the remaining space and handle vertical scrolling internally. --}}
    <main class="flex-grow overflow-y-auto p-4 sm:p-6 lg:p-10 max-w-7xl mx-auto w-full">

        {{-- Dashboard Header and Action Buttons --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 pb-4 border-b border-gray-100">
            <h2 class="text-4xl font-extrabold text-[#660809] tracking-tighter">
                Student Dashboard
            </h2>

            <div class="flex flex-wrap gap-4 mt-4 sm:mt-0">
                {{-- Primary Action: New Promissory Note --}}
                <a href="{{ route('student.promissorynote') }}"
                class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white bg-[#660809] rounded-xl shadow-lg shadow-[#660809]/40 hover:bg-[#902021] focus:outline-none focus:ring-4 focus:ring-[#660809]/50 transition-all duration-300 transform hover:scale-[1.03]">
                    <iconify-icon icon="mdi:pencil-box-multiple-outline" class="text-xl"></iconify-icon>
                    Submit New Note
                </a>

                {{-- Secondary Action: Account Subledger --}}
                <a href="{{ route('student.subledger')}}"
                class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-gray-700 bg-gray-50 border border-gray-200 rounded-xl shadow-md hover:bg-gray-100 transition-all duration-300 transform hover:scale-[1.03]">
                    <iconify-icon icon="mdi:file-chart-outline" class="text-xl"></iconify-icon>
                    View Account Ledger
                </a>
            </div>
        </div>

        {{-- STATISTIC CARDS: NOW WITH MORE 3D SHADOWS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">

            {{-- Total Notes Card --}}
            <div class="bg-[#660809] p-4 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-[#902021]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-wider text-white opacity-80">Total Notes</p>
                        <p class="text-3xl font-extrabold text-white mt-1">{{ $promissoryNotes->count() }}</p>
                    </div>
                    <div class="p-2 rounded-full bg-white/20">
                        <iconify-icon icon="mdi:file-document-outline" class="text-white text-2xl"></iconify-icon>
                    </div>
                </div>
            </div>

            {{-- Pending Card --}}
            <div class="bg-[#660809] p-4 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-amber-400">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-wider text-white opacity-80">Pending</p>
                        <p class="text-3xl font-extrabold text-white mt-1">
                            {{ $promissoryNotes->where('status', 'pending')->count() }}
                        </p>
                    </div>
                    <div class="p-2 rounded-full bg-white/20">
                        <iconify-icon icon="mdi:clock-time-three-outline" class="text-amber-400 text-2xl"></iconify-icon>
                    </div>
                </div>
            </div>

            {{-- Approved Card --}}
            <div class="bg-[#660809] p-4 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-green-400">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-wider text-white opacity-80">Approved</p>
                        <p class="text-3xl font-extrabold text-white mt-1">
                            {{ $promissoryNotes->where('status', 'approved')->count() }}
                        </p>
                    </div>
                    <div class="p-2 rounded-full bg-white/20">
                        <iconify-icon icon="mdi:check-decagram-outline" class="text-green-400 text-2xl"></iconify-icon>
                    </div>
                </div>
            </div>

            {{-- Total Amount Card --}}
            <div class="bg-[#660809] p-4 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-wider text-white opacity-80">Total Amount</p>
                        <p class="text-2xl font-extrabold text-white mt-1">
                            ₱{{ number_format($promissoryNotes->sum('amount'), 2) }}
                        </p>
                    </div>
                    <div class="p-2 rounded-full bg-white/20">
                        <iconify-icon icon="mdi:cash-multiple" class="text-white text-2xl"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        ---

        {{-- Promissory Notes Table --}}
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 bg-[#660809] flex justify-between items-center border-b border-[#902021]">
                <h3 class="text-xl font-bold text-white">Recent Promissory Notes</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-[#902021]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-white">Note ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-white">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-white">Reason</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-white">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-white">Date Created</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php
                            $statusColors = [
                                'pending' => 'bg-amber-50 text-amber-700 ring-amber-500',
                                'approved' => 'bg-green-50 text-green-700 ring-green-500',
                                'rejected' => 'bg-red-50 text-red-700 ring-red-500',
                            ];
                        @endphp
                        @forelse($promissoryNotes as $note)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $note->pn_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-base font-bold text-[#660809]">₱{{ number_format($note->amount, 2) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 max-w-xs truncate" title="{{ $note->reason }}">{{ $note->reason }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold uppercase ring-1 ring-inset {{ $statusColors[$note->status] ?? 'bg-gray-100 text-gray-600 ring-gray-500' }}">
                                        {{ ucfirst($note->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <div>{{ $note->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-400">{{ $note->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="{{ route('student.promissorynote.view', $note->pn_id) }}"
                                    class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-[#660809] hover:bg-black text-white shadow-md transition-all duration-300"
                                    title="View Details">
                                        <iconify-icon icon="mdi:eye-outline" class="text-xl"></iconify-icon>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center text-lg text-gray-500 bg-gray-50/50">
                                    <iconify-icon icon="mdi:information-outline" class="text-4xl text-gray-300 mb-3 block mx-auto"></iconify-icon>
                                    <p class="font-medium">No Promissory Notes Found.</p>
                                    <p class="text-sm text-gray-400 mt-1">Click "Submit New Note" to get started.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

@endsection