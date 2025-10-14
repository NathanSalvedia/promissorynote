@extends('layouts.layout')

@section('content')
@include('includes.admin')
 <div class="bg-white rounded-xl shadow p-6 mt-6 w-full">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Payment Tracking</h2>
        <div class="flex gap-2">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-100">
                <iconify-icon icon="mdi:cash" class="text-green-600 text-2xl"></iconify-icon>
            </div>
            <div>
                <div class="text-sm text-white">Total Collected</div>
                <div class="text-2xl font-bold text-white">₱{{ number_format($totalCollected, 2) }}</div>
            </div>
        </div>

        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100">
                <iconify-icon icon="mdi:percent" class="text-blue-600 text-2xl"></iconify-icon>
            </div>
            <div>
                <div class="text-sm text-white">Avg Down Payment</div>
                <div class="text-2xl font-bold text-white">₱{{ number_format($avgDownPayment, 2) }}</div>
            </div>
        </div>

        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-100">
                <iconify-icon icon="mdi:clock-outline" class="text-orange-600 text-2xl"></iconify-icon>
            </div>

            <div>
                <div class="text-sm text-white">Pending Payments</div>
                <div class="text-2xl font-bold text-white">{{ $pendingPayments }}</div>
            </div>
        </div>
        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100">
                <iconify-icon icon="mdi:alert" class="text-red-600 text-2xl"></iconify-icon>
            </div>
            <div>
                <div class="text-sm text-white">Overdue</div>
                <div class="text-2xl font-bold text-white">{{ $overdue }}</div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow border overflow-hidden">
        <div class="px-6 py-4 bg-[#660809] border-b">
         <h3 class="text-xl font-bold text-white">Payment Tracking</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-lg">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
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
                            <td class="px-4 py-2">
                                PN-{{ $note->pn_id }}
                                @if($note->parent_pn_id)
                                    <span class="ml-2 inline-flex items-center gap-1 px-3 py-2 rounded-full font-bold text-xs"
                                          style="background: linear-gradient(90deg, #f7c948 0%, #f7b32b 100%); color: #7c4700;">
                                        <iconify-icon icon="mdi:refresh" class="text-base mr-1"></iconify-icon>
                                        Resubmission
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <div class="font-semibold">{{ $note->user->fullname ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-500">Student ID: {{ $note->user->student_id ?? 'N/A' }}</div>
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
</div>
@endsection
