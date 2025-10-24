  <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50 text-gray-700 hidden sm:table-header-group">
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
                        @forelse($notes as $note)
                            <tr class="border-b hover:bg-gray-50 transition sm:table-row block mb-4 sm:mb-0 rounded-lg sm:rounded-none shadow-sm sm:shadow-none bg-white sm:bg-transparent">
                                <td class="px-6 py-4 font-medium text-xs sm:text-base block sm:table-cell">
                                    <span class="font-semibold sm:hidden">PN ID: </span>
                                    PN-{{ $note->pn_id }}
                                    @if($note->parent_pn_id)
                                        <span class="ml-2 inline-flex items-center gap-1 px-3 py-2 rounded-full font-bold text-xs"
                                              style="background: linear-gradient(90deg, #f7c948 0%, #f7b32b 100%); color: #7c4700;">
                                            <iconify-icon icon="mdi:refresh" class="text-base mr-1"></iconify-icon>
                                            Resubmission
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-semibold text-xs sm:text-base block sm:table-cell">
                                    <span class="font-semibold sm:hidden">Amount: </span>
                                    ₱{{ number_format($note->amount, 2) }}
                                </td>
                                <td class="px-6 py-4 text-xs sm:text-base block sm:table-cell">
                                    <span class="font-semibold sm:hidden">Reason: </span>
                                    {{ $note->reason }}
                                </td>
                                <td class="px-6 py-4 text-xs sm:text-base block sm:table-cell">
                                    <span class="font-semibold sm:hidden">Status: </span>
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$note->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($note->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-xs sm:text-base block sm:table-cell">
                                    <span class="font-semibold sm:hidden">Actions: </span>
                                    <a href="{{ route('student.promissorynote.view', $note->pn_id) }}"
                                       class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-[#660809] hover:bg-black text-white transition"
                                       title="View">
                                        <iconify-icon icon="mdi:eye-outline" class="animate-pulse"></iconify-icon>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500 text-xs sm:text-base">No promissory notes found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="sm:hidden text-center text-gray-400 text-xs py-2">Swipe left/right to see more &rarr;</div>
            </div>
