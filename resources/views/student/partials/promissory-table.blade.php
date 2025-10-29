<div class="w-full">
    <!-- Mobile: Horizontal Card layout (1 row) -->
    <div class="flex flex-col gap-4 sm:hidden">
        <!-- Mobile Table Headers -->
        <div class="flex flex-row items-center font-semibold text-gray-700 px-4 py-2 bg-gray-50 rounded-t-xl">
            <div class="min-w-[60px]">PN ID</div>
            <div class="min-w-[90px]">Amount</div>
            <div class="min-w-[100px]">Reason</div>
            <div class="min-w-[80px]">Status</div>
            <div class="min-w-[70px]">Actions</div>
        </div>
        @php
            $statusColors = [
                'pending' => 'bg-yellow-100 text-yellow-800',
                'approved' => 'bg-green-100 text-green-800',
                'rejected' => 'bg-red-100 text-red-800',
            ];
        @endphp
        @forelse($notes as $note)
            <div class="bg-white rounded-b-xl shadow-sm border p-3 flex items-center gap-3">
                <div class="font-bold text-[#660809] min-w-[60px]">PN-{{ $note->pn_id }}</div>
                <div class="font-semibold min-w-[90px]">₱{{ number_format($note->amount, 2) }}</div>
                <div class="flex-1 text-sm">{{ $note->reason }}</div>
                @php $ms = strtolower(trim($note->status)); @endphp
                <div class="flex items-center gap-2 ml-3">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$ms] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($ms) }}
                    </span>
                    <a href="{{ route('student.promissorynote.view', $note->pn_id) }}"
                       class="inline-flex items-center justify-center h-9 px-3 rounded-lg bg-[#660809] hover:bg-black text-white transition text-xs font-semibold flex-shrink-0"
                       title="View">
                        <iconify-icon icon="mdi:eye-outline" class="text-sm"></iconify-icon>
                        <span class="ml-1">View</span>
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 text-xs py-8">No promissory notes found.</div>
        @endforelse
    </div>

    <!-- Desktop: Table layout -->
    <div class="hidden sm:block overflow-x-auto">
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
                @forelse($notes as $note)
                    <tr class="border-b hover:bg-gray-50 transition bg-white">
                        <td class="px-6 py-4 font-medium">PN-{{ $note->pn_id }}</td>
                        <td class="px-6 py-4 font-semibold">₱{{ number_format($note->amount, 2) }}</td>
                        <td class="px-6 py-4">{{ $note->reason }}</td>
                        <td class="px-6 py-4">
                            @php $s = strtolower(trim($note->status)); @endphp
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$s] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($s) }}
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
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">No promissory notes found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
