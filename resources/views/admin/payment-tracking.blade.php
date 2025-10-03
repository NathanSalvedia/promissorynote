@extends('layouts.layout')

@section('content')
@php
    $pendingPayments = 0;
    $overdue = 0;
    foreach ($notes as $note) {
        $paid = $note->payments->sum('amount') + $note->down_payment;
        $remaining = $note->amount - $paid;
        $isOverdue = $note->due_date <= now()->toDateString() && $remaining > 0;
        if (!$note->is_settled && $isOverdue) {
            $overdue++;
        }
        if (!$note->is_settled && !$isOverdue) {
            $pendingPayments++;
        }
    }
@endphp
@include('includes.header')
 <div class="max-w-5xl mx-auto bg-white rounded-xl shadow p-6 mt-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Payment Tracking</h2>
        <div class="flex gap-2">
            <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold flex items-center gap-2">
                <iconify-icon icon="mdi:plus" class="w-5 h-5"></iconify-icon>
                Record Payment
            </a>

            <a href="{{ route('admin.dashboard')}}" class="text-gray-600 hover:text-gray-900 flex items-center gap-1">
                <iconify-icon icon="mdi:arrow-left" class="w-5 h-5"></iconify-icon>
                Back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-green-50 border-l-4 border-green-400 rounded-lg p-4 flex items-center gap-4">
            <div class="text-green-600">
                <iconify-icon icon="mdi:cash" class="w-8 h-8"></iconify-icon>
            </div>
            <div>
                <div class="text-sm text-gray-500">Total Collected</div>
                <div class="text-2xl font-bold text-green-700">₱{{ number_format($totalCollected, 2) }}</div>
            </div>
        </div>
        <div class="bg-blue-50 border-l-4 border-blue-400 rounded-lg p-4 flex items-center gap-4">
            <div class="text-blue-600">
                <iconify-icon icon="mdi:percent" class="w-8 h-8"></iconify-icon>
            </div>
            <div>
                <div class="text-sm text-gray-500">Avg Down Payment</div>
                <div class="text-2xl font-bold text-blue-700">₱{{ number_format($avgDownPayment, 2) }}</div>
            </div>
        </div>
        <div class="bg-orange-50 border-l-4 border-orange-400 rounded-lg p-4 flex items-center gap-4">
            <div class="text-orange-600">
                <iconify-icon icon="mdi:clock-outline" class="w-8 h-8"></iconify-icon>
            </div>
            <div>
                <div class="text-sm text-gray-500">Pending Payments</div>
                <div class="text-2xl font-bold text-orange-700">{{ $pendingPayments }}</div>
            </div>
        </div>
        <div class="bg-red-50 border-l-4 border-red-400 rounded-lg p-4 flex items-center gap-4">
            <div class="text-red-600">
                <iconify-icon icon="mdi:alert" class="w-8 h-8"></iconify-icon>
            </div>
            <div>
                <div class="text-sm text-gray-500">Overdue</div>
                <div class="text-2xl font-bold text-red-700">{{ $overdue }}</div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 rounded-xl p-4">
        <h3 class="text-lg font-semibold mb-4">Payment Compliance Monitoring</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-2 font-semibold text-left">PN ID</th>
                        <th class="px-4 py-2 font-semibold text-left">Full Name</th>
                        <th class="px-4 py-2 font-semibold text-left">Amount</th>
                        <th class="px-4 py-2 font-semibold text-left">Down Payment</th>
                        <th class="px-4 py-2 font-semibold text-left">Due Date</th>
                        <th class="px-4 py-2 font-semibold text-left">Status</th>
                        <th class="px-4 py-2 font-semibold text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notes as $note)
                        @php
                            $paid = $note->payments->sum('amount') + $note->down_payment;
                            $remaining = $note->amount - $paid;
                            $isOverdue = $note->due_date <= now()->toDateString() && $remaining > 0;
                        @endphp
                        <tr class="border-b {{ $note->is_settled ? 'bg-green-50' : ($isOverdue ? 'bg-red-50' : 'bg-white') }}">
                            <td class="px-4 py-2">PN-{{ $note->pn_id }}</td>
                            <td class="px-4 py-2">
                                <span class="font-semibold">{{ $note->fullname }}</span>
                                <div class="text-xs text-gray-500">{{ $note->student_id }}</div>
                            </td>
                            <td class="px-4 py-2">₱{{ number_format($note->amount, 2) }}</td>
                            <td class="px-4 py-2 text-green-600">₱{{ number_format($note->down_payment, 2) }}</td>
                            <td class="px-4 py-2">{{ $note->due_date }}</td>
                            <td class="px-4 py-2">
                                @if($note->is_settled)
                                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-semibold">Paid</span>
                                @elseif($isOverdue)
                                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">Overdue</span>
                                @else
                                    <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-xs font-semibold">Not overdue yet</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 flex gap-2">
                                  <form action="{{ route('admin.promissorynotes.recordPayment', $note->pn_id) }}" method="POST" style="display:inline;">
                                  @csrf
                                  <button type="submit" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded" title="Record Payment">
                                      <iconify-icon icon="mdi:plus" class="w-4 h-4"></iconify-icon>
                                  </button>
                                 </form>

                                 <a href="{{ route('admin.subledger-show', $note->user->student_id) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-purple-600 hover:bg-purple-700 text-white" title="View Subledger">
                                            <iconify-icon icon="mdi:book-account-outline"></iconify-icon>
                                 </a>

                                   <form action="{{ route('admin.promissorynotes-archive', $note->pn_id) }}" method="POST"  class="archive-form" style="display:inline;">
                                   @csrf
                                 <button type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-lg archive-btn" title="Archive">
                                  <span class="iconify" data-icon="mdi:archive" data-width="20" data-height="20"></span>
                                </button>
                               </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
 @endsection
