@extends('layouts.layout')


@section('content')


<div class="bg-white rounded-2xl shadow border overflow-hidden">
            <div class="px-6 py-4 bg-gray-100 border-b">
                <h3 class="text-xl font-bold text-gray-800">Pending Requests</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Note ID</th>
                            <th class="px-6 py-3 text-left font-semibold">Full Name</th>
                            <th class="px-6 py-3 text-left font-semibold">Department</th>
                            <th class="px-6 py-3 text-left font-semibold">Amount</th>
                            <th class="px-6 py-3 text-left font-semibold">Reason</th>
                            <th class="px-6 py-3 text-left font-semibold">Date</th>
                            <th class="px-6 py-3 text-left font-semibold">Status</th>
                            <th class="px-6 py-3 text-left font-semibold">Actions</th>
                        </tr>
                    </thead>

                        @forelse($pendingNotes as $note)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">{{ $note->pn_id }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold">{{ $note->fullname }}</div>
                                    <div class="text-gray-500 text-xs">ID: {{ $note->student_id }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">
                                        {{ $note->department }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-semibold">₱{{ number_format($note->amount, 2) }}</td>
                                <td class="px-6 py-4">{{ $note->reason }}</td>
                                <td class="px-6 py-4">
                                    <div>{{ $note->created_at->format('M d, Y') }}</div>
                                    <div class="text-gray-500 text-xs">{{ $note->created_at->format('h:i A') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'approved' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                        ];
                                        $statusLabel = ucfirst($note->status);
                                        $statusClass = $statusColors[$note->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-green-600 hover:bg-green-700 text-white" title="Approve">
                                            <iconify-icon icon="mdi:check"></iconify-icon>
                                        </a>
                                        <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-red-600 hover:bg-red-700 text-white" title="Reject">
                                            <iconify-icon icon="mdi:close"></iconify-icon>
                                        </a>
                                        <a href="{{ route('admin.manage-record.show', $note->pn_id) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-blue-600 hover:bg-blue-700 text-white" title="View">
                                            <iconify-icon icon="mdi:eye-outline"></iconify-icon>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-6 py-8 text-center text-gray-500">No pending requests.</td></tr>
                        @endforelse

                    </tbody>
                </table>
            </div>


@endsection
