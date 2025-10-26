
@php
    use Carbon\Carbon;
@endphp



              @foreach($promissoryNotes as $note)
              <tr class="border-b hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-medium">
                                        PN-{{ $note->pn_id }}
                                        @if($note->is_new)
                                            <span id="new-label-pn{{ $note->pn_id }}" class="ml-2 inline-block bg-green-200 text-green-800 text-xs px-2 py-1 rounded-full font-bold">New</span>
                                        @endif
                                        @if($note->parent_pn_id)
                                            <span class="ml-2 inline-flex items-center gap-1 px-3 py-2 rounded-full font-bold text-xs"
                                                  style="background: linear-gradient(90deg, #f7c948 0%, #f7b32b 100%); color: #7c4700;">
                                                <iconify-icon icon="mdi:refresh" class="text-base mr-1"></iconify-icon>
                                                Resubmission
                                            </span>
                                        @endif
                                        @if($note->status == 'rejected')
                                            <span class="ml-2 inline-flex items-center gap-1 px-3 py-2 rounded-full font-bold text-xs"
                                                  style="background: linear-gradient(90deg, #f87171 0%, #ef4444 100%); color: #7f1d1d;">
                                                <iconify-icon icon="mdi:close-circle" class="text-base mr-1"></iconify-icon>
                                                Rejected
                                            </span>
                                        @endif
                                    </td>
                <td class="py-3 px-4">
                  <div class="font-semibold text-gray-800">{{ $note->user->fullname ?? $note->fullname }}</div>
                  <div class="text-gray-500 text-xs">{{ $note->user->student_id ?? $note->student_id }}</div>
                </td>
                <td class="py-3 px-4 text-[#660809] font-bold">{{ $note->user->department ?? $note->department }}</td>
                <td class="py-3 px-4">
                  @php
                    if ($note->status == 'approved') {
                      $bgClass = 'bg-green-100';
                      $textClass = 'text-green-600';
                    } elseif ($note->status == 'pending') {
                      $bgClass = 'bg-yellow-100';
                      $textClass = 'text-yellow-600';
                    } else {
                      $bgClass = 'bg-red-100';
                      $textClass = 'text-red-600';
                    }
                  @endphp
                  <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $bgClass }} {{ $textClass }}">
                    {{ ucfirst($note->status) }}
                  </span>
                </td>
                <td class="py-3 px-4">
                  @php
                    if ($note->remarks == 'Settled') {
                      $remarksBgClass = 'bg-green-100';
                      $remarksTextClass = 'text-green-600';
                    } elseif ($note->remarks == 'Overdue') {
                      $remarksBgClass = 'bg-red-100';
                      $remarksTextClass = 'text-red-600';
                    } elseif ($note->remarks == 'Not Settled') {
                      $remarksBgClass = 'bg-red-100';
                      $remarksTextClass = 'text-red-500';
                    } else {
                      $remarksBgClass = 'bg-yellow-100';
                      $remarksTextClass = 'text-yellow-600';
                    }
                  @endphp
                  <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $remarksBgClass }} {{ $remarksTextClass }} whitespace-nowrap truncate">
                    {{ $note->remarks }}
                  </span>
                </td>
                <td class="py-3 px-4 whitespace-nowrap truncate">
                  {{ $note->due_date ? Carbon::parse($note->due_date)->format('Y-m-d') : 'No due date' }}
                </td>
                <td class="py-3 px-4 flex gap-2">
                  {{-- View --}}
                  <a href="{{ route('admin.promissorynotes-show', $note->pn_id) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-lg" title="View">
                    <span class="iconify" data-icon="mdi:eye" data-width="20" data-height="20"></span>
                  </a>
                  {{-- Archive --}}
                  <form action="{{ route('admin.promissorynotes-archive', $note->pn_id) }}"
                        method="POST" class="archive-form" style="display:inline;">
                      @csrf
                      <button type="submit"
                              class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-lg archive-btn"
                              title="Archive">
                          <span class="iconify" data-icon="mdi:archive" data-width="20" data-height="20"></span>
                      </button>
                  </form>
                </td>
              </tr>
              @endforeach

