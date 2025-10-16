@extends('layouts.layout')

@section('content')

<div class="min-h-screen bg-gray-100 flex flex-col">

    @include('includes.header')

    <!-- Move Alpine.js state to main for global access -->
    <main class="p-6 w-full" x-data="{ guidelinesOpen: false }">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h2 class="text-2xl font-bold text-[#660809]">Student Dashboard</h2>

            <div class="flex gap-3 mt-4 sm:mt-0">

                 <!-- Guidelines Button Styled Like New Promissory Note -->
                <button
                    type="button"
                    @click="guidelinesOpen = true"
                    class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition"
                >
                    <iconify-icon icon="mdi:information-outline"></iconify-icon>
                    Guidelines
                </button>

                <a href="{{ route('student.promissorynote') }}"
                   class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
                    <iconify-icon icon="mdi:plus-circle-outline"></iconify-icon>
                    New Promissory Note
                </a>



                <a href="{{ route('student.subledger')}}"
                   class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
                    <iconify-icon icon="mdi:clipboard-list-outline"></iconify-icon>
                    Account Subledger
                </a>
            </div>
        </div>

        {{-- Guidelines Modal --}}
        <div
            x-show="guidelinesOpen"
            class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40"
            style="display: none; backdrop-filter: blur(2px);"
        >
            <div class="bg-white rounded-xl shadow-lg p-8 max-w-lg w-full relative">
                <button
                    @click="guidelinesOpen = false"
                    class="absolute top-3 right-3 text-[#660809] text-lg hover:text-black flex items-center gap-1"
                    aria-label="Close"
                >
                    <span class="text-sm font-semibold">Close</span>
                </button>
                <h4 class="text-lg text-center font-bold text-[#660809] mb-4">Promissory Note Guidelines</h4>
                <ul class="list-disc pl-5 text-gray-700 space-y-2">
                    <li>Only students with outstanding balances may apply.</li>
                    <li>Provide a valid reason for your request.</li>
                    <li>Approval is subject to review by the finance office.</li>
                    <li>Check your email for status updates.</li>
                    <!-- Add more guidelines as needed -->
                </ul>
            </div>
        </div>

        @if (!auth()->user()->hasVerifiedEmail())
            <div
                x-data="{ open: true }"
                x-show="open"
                class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40"
                style="backdrop-filter: blur(2px);"
            >
                <div class="bg-white rounded-xl shadow-lg p-8 max-w-md w-full relative">
                    <button
                        @click="open = false"
                        class="absolute top-3 right-3 text-[#660809] text-lg hover:text-black flex items-center gap-1"
                        aria-label="Close"
                    >
                        <span class="text-sm font-semibold">Close</span>
                    </button>
                    <div class="flex flex-col items-center gap-4">
                        <iconify-icon icon="mdi:email-alert-outline" class="text-5xl text-yellow-500"></iconify-icon>
                        <h4 class="text-lg font-bold text-[#660809]">Verify Your Email Address</h4>
                        <p class="text-gray-700 text-center">
                            Please check your inbox and click the verification link to activate your account.<br>
                            If you did not receive the email,
                            <form method="POST" action="{{ route('verification.send') }}" class="inline">
                                @csrf
                             <button type="submit" class="w-full bg-[#660809] text-white font-semibold py-2 px-2 rounded-lg shadow hover:bg-black transition mb-2">
                                 Verification
                             </button>
                            </form>
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow border overflow-hidden">
            <div class="px-6 py-4 bg-[#660809] text-white flex justify-between items-center">
                <h3 class="text-xl font-bold">My Promissory Notes</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">PN ID</th>
                            <th class="px-6 py-3 text-left font-semibold">Amount</th>
                            <th class="px-6 py-3 text-left font-semibold">Reason</th>
                            <th class="px-6 py-3 text-left font-semibold">Status</th>
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
                                <td class="px-6 py-4 font-medium">
                                    PN-{{ $note->pn_id }}
                                    @if($note->parent_pn_id)
                                        <span class="ml-2 inline-flex items-center gap-1 px-3 py-2 rounded-full font-bold text-xs"
                                              style="background: linear-gradient(90deg, #f7c948 0%, #f7b32b 100%); color: #7c4700;">
                                            <iconify-icon icon="mdi:refresh" class="text-base mr-1"></iconify-icon>
                                            Resubmission
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-semibold">₱{{ number_format($note->amount, 2) }}</td>
                                <td class="px-6 py-4">{{ $note->reason }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$note->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($note->status) }}
                                    </span>
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
