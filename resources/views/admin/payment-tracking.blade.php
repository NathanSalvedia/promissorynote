@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">

    {{-- ✅ Header (fixed, full width) --}}
    <header class="fixed top-0 left-0 right-0 z-50 shadow bg-white">
        @include('includes.admin')
    </header>

    {{-- ✅ Page Content --}}
    <main class="p-6 mt-24 w-full max-w-7xl mx-auto">

        <h2 class="text-2xl font-bold mb-6">Payment Tracking</h2>

        {{-- ✅ Stats Cards (same design as Admin Dashboard) --}}
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">
            <!-- Total Collected -->
            <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-100">
                    <iconify-icon icon="mdi:cash" class="text-green-600 text-2xl"></iconify-icon>
                </div>
                <div>
                    <p class="text-sm opacity-80">Total Collected</p>
                    <p class="text-3xl font-bold">₱{{ number_format($totalCollected, 2) }}</p>
                </div>
            </div>

            <!-- Avg Down Payment -->
            <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100">
                    <iconify-icon icon="mdi:percent" class="text-blue-600 text-2xl"></iconify-icon>
                </div>
                <div>
                    <p class="text-sm opacity-80">Avg Down Payment</p>
                    <p class="text-3xl font-bold">₱{{ number_format($avgDownPayment, 2) }}</p>
                </div>
            </div>

            <!-- Pending Payments -->
            <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-100">
                    <iconify-icon icon="mdi:clock-outline" class="text-orange-600 text-2xl"></iconify-icon>
                </div>
                <div>
                    <p class="text-sm opacity-80">Pending Payments</p>
                    <p class="text-3xl font-bold">{{ $pendingPayments }}</p>
                </div>
            </div>

            <!-- Overdue -->
            <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100">
                    <iconify-icon icon="mdi:alert" class="text-red-600 text-2xl"></iconify-icon>
                </div>
                <div>
                    <p class="text-sm opacity-80">Overdue</p>
                    <p class="text-3xl font-bold">{{ $overdue }}</p>
                </div>
            </div>
        </div>

        {{-- ✅ Table Section (same design as Admin table) --}}
        <div class="bg-white rounded-2xl shadow border overflow-hidden">
            <div class="px-6 py-4 bg-[#660809] border-b flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <h3 class="text-xl font-bold text-[#ffffff]">Payment Compliance Monitoring</h3>

                <div class="flex gap-2">
                    <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold flex items-center gap-2">
                        <iconify-icon icon="mdi:plus" class="w-5 h-5"></iconify-icon>
                        Record Payment
                    </a>
                    <a href="{{ route('admin.dashboard')}}" 
                        class="border px-3 py-2 rounded-lg text-white hover:bg-white hover:text-[#660809] transition bg-[#660809] flex items-center gap-1">
                        <iconify-icon icon="mdi:arrow-left" class="w-5 h-5"></iconify-icon>
                        Back
                    </a>
                </div>
            </div>

            {{-- ✅ Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Note ID</th>
                            <th class="px-6 py-3 text-left font-semibold">Full Name</th>
                            <th class="px-6 py-3 text-left font-semibold">Total Amount</th>
                            <th class="px-6 py-3 text-left font-semibold">Down Payment</th>
                            <th class="px-6 py-3 text-left font-semibold">Remaining</th>
                            <th class="px-6 py-3 text-left font-semibold">Due Date</th>
                            <th class="px-6 py-3 text-left font-semibold">Status</th>
                            <th class="px-6 py-3 text-left font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notes as $note)
                            @php
                                $paid = $note->payments->sum('amount') + $note->down_payment;
                                $remaining = $note->amount - $paid;
                                $isOverdue = $note->due_date < now()->toDateString() && $remaining > 0;
                            @endphp
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">PN-{{ $note->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold">{{ $note->fullname }}</div>
                                    <div class="text-gray-500 text-xs">{{ $note->student_id }}</div>
                                </td>
                                <td class="px-6 py-4 font-semibold">₱{{ number_format($note->amount, 2) }}</td>
                                <td class="px-6 py-4 text-green-600 font-semibold">₱{{ number_format($note->down_payment, 2) }}</td>
                                <td class="px-6 py-4 text-orange-600 font-semibold">₱{{ number_format($remaining, 2) }}</td>
                                <td class="px-6 py-4">{{ $note->due_date }}</td>
                                <td class="px-6 py-4">
                                    @if($isOverdue)
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Overdue</span>
                                    @elseif($remaining <= 0)
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Paid</span>
                                    @else
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-700">Pending</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <button class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-green-600 hover:bg-green-700 text-white" title="Record Payment">
                                            <iconify-icon icon="mdi:plus"></iconify-icon>
                                        </button>
                                        <button class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-blue-600 hover:bg-blue-700 text-white" title="View Details">
                                            <iconify-icon icon="mdi:history"></iconify-icon>
                                        </button>
                                        <button class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-red-600 hover:bg-red-700 text-white" title="Alert">
                                            <iconify-icon icon="mdi:alert"></iconify-icon>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection
