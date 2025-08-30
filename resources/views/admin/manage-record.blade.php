@extends('layouts.layout')
@section('title','Manage Records')

@section('content')
@php
    // Fallbacks in case controller values are missing (for safety during integration)
    $totalNotes    = $totalNotes    ?? ($promissoryNotes->count() ?? 0);
    $approvedNotes = $approvedNotes ?? ($promissoryNotes->where('status','approved')->count() ?? 0);
    $pendingNotes  = $pendingNotes  ?? ($promissoryNotes->where('status','pending')->count() ?? 0);
    $rejectedNotes = $rejectedNotes ?? ($promissoryNotes->where('status','rejected')->count() ?? 0);
@endphp

<style>
  /* ===== icon animations ===== */
  @keyframes bounce { 0%,100% { transform: translateY(0) } 50% { transform: translateY(-6px) } }
  @keyframes pulse  { 0%,100% { transform: scale(1) }      50% { transform: scale(1.2) } }
  .icon-anim        { animation: bounce 1.5s infinite, pulse 3s infinite; }

  /* header & action buttons: hover-only motion (subtle so dili samok) */
  .btn-anim iconify-icon { transition: transform .2s ease; display: inline-block; }
  .btn-anim:hover iconify-icon { transform: translateY(-2px) scale(1.05); }

  /* table action buttons hover lift */
  .action-btn { transition: transform .15s ease; }
  .action-btn:hover { transform: translateY(-2px); }
  .action-btn iconify-icon { transition: transform .2s ease; }
  .action-btn:hover iconify-icon { transform: scale(1.1); }
</style>

<div class="min-h-screen bg-gray-100" x-data="{ open:false, note:{} }">
    <main class="p-6 max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold">Centralized Record Management</h2>
            <div class="flex items-center gap-3">
                <a href="#" class="btn-anim inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg">
                    <iconify-icon icon="mdi:download"></iconify-icon> Export Records
                </a>
                <a href="{{ url()->previous() }}" class="btn-anim inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg">
                    <iconify-icon icon="mdi:arrow-left"></iconify-icon> Back
                </a>
            </div>
        </div>

        {{-- Top mini metrics --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
            <div class="bg-white rounded-xl shadow border p-5 flex items-center gap-3">
                <span class="inline-flex rounded-xl p-3 bg-blue-100 text-blue-700">
                    <iconify-icon icon="mdi:database" class="text-2xl icon-anim"></iconify-icon>
                </span>
                <div>
                    <p class="text-sm text-gray-600">Total Records</p>
                    <p class="text-3xl font-bold text-blue-700">{{ $totalNotes }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow border p-5 flex items-center gap-3">
                <span class="inline-flex rounded-xl p-3 bg-green-100 text-green-700">
                    <iconify-icon icon="mdi:check-decagram-outline" class="text-2xl icon-anim"></iconify-icon>
                </span>
                <div>
                    <p class="text-sm text-gray-600">Approved</p>
                    <p class="text-3xl font-bold text-green-700">{{ $approvedNotes }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow border p-5 flex items-center gap-3">
                <span class="inline-flex rounded-xl p-3 bg-yellow-100 text-yellow-700">
                    <iconify-icon icon="mdi:clock-time-four-outline" class="text-2xl icon-anim"></iconify-icon>
                </span>
                <div>
                    <p class="text-sm text-gray-600">Pending</p>
                    <p class="text-3xl font-bold text-yellow-700">{{ $pendingNotes }}</p>
                </div>
            </div>
        </div>

        {{-- Records table --}}
        <div class="bg-white rounded-2xl shadow border overflow-hidden">
            <div class="px-6 py-4 bg-[#660809] text-white border-b">
                <h3 class="text-lg font-semibold">All Promissory Note Records</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-gray-50 text-gray-700 text-sm">
                        <tr>
                            <th class="py-3 px-6 border-b">Record #</th>
                            <th class="py-3 px-6 border-b">Student Info</th>
                            <th class="py-3 px-6 border-b">Amount</th>
                            <th class="py-3 px-6 border-b">Status</th>
                            <th class="py-3 px-6 border-b">Date Created</th>
                            <th class="py-3 px-6 border-b">Last Modified</th>
                            <th class="py-3 px-6 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-800">
                        @forelse ($promissoryNotes as $noteModel)
                            @php
                                $user = $noteModel->user;
                                $status = strtolower($noteModel->status ?? '');
                                $badge = [
                                    'approved' => 'bg-green-100 text-green-700',
                                    'pending'  => 'bg-yellow-100 text-yellow-700',
                                    'rejected' => 'bg-red-100 text-red-700',
                                ][$status] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="py-4 px-6 border-b font-semibold">
                                    {{ $noteModel->pn_id ?? ("PN-".$noteModel->id) }}
                                </td>
                                <td class="py-4 px-6 border-b">
                                    <div class="font-medium">{{ optional($user)->fullname ?? '—' }}</div>
                                    <div class="text-xs text-gray-500">{{ optional($user)->student_id ?? '—' }}</div>
                                </td>
                                <td class="py-4 px-6 border-b font-semibold text-green-700">
                                    ₱{{ number_format((float)($noteModel->amount ?? 0), 0) }}
                                </td>
                                <td class="py-4 px-6 border-b">
                                    <span class="inline-flex items-center text-xs px-3 py-1 rounded-full {{ $badge }}">
                                        {{ ucfirst($status) ?: '—' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 border-b">{{ optional($noteModel->created_at)->format('Y-m-d') }}</td>
                                <td class="py-4 px-6 border-b">{{ optional($noteModel->updated_at)->format('Y-m-d') }}</td>
                                <td class="py-4 px-6 border-b">
                                    <div class="flex items-center gap-2">
                                        {{-- VIEW --}}
                                        <button
                                            class="action-btn w-9 h-9 grid place-items-center rounded-lg bg-[#660809] hover:bg-black text-white"
                                            title="View"
                                            @click='open=true; note={
                                                pn_id: @js($noteModel->pn_id ?? ("PN-".$noteModel->id)),
                                                amount: @js($noteModel->amount ?? 0),
                                                reason: @js($noteModel->reason ?? null),
                                                term: @js($noteModel->term ?? null),
                                                acad_year: @js($noteModel->academic_year ?? $noteModel->acad_year ?? null),
                                                due_date: @js(optional($noteModel->due_date)->format("Y-m-d") ?? ($noteModel->due_date ?? null)),
                                                status: @js(ucfirst($status)),
                                                submitted: @js(optional($noteModel->created_at)->format("Y-m-d H:i") ?? null),
                                                name: @js(optional($user)->name ?? null),
                                                student_id: @js(optional($user)->student_id ?? null),
                                                email: @js(optional($user)->email ?? null),
                                                phone: @js(optional($user)->phone ?? null),
                                                gender: @js(optional($user)->gender ?? null),
                                                department: @js(optional($user)->department ?? null),
                                                year_level: @js(optional($user)->year_level ?? null),
                                            }'>
                                            <iconify-icon icon="mdi:eye-outline"></iconify-icon>
                                        </button>
                                        {{-- ARCHIVE --}}
                                        <a href="#"
                                           class="action-btn w-9 h-9 grid place-items-center rounded-lg bg-[#660809] hover:bg-black text-white"
                                           title="Archive">
                                            <iconify-icon icon="mdi:archive-arrow-down-outline"></iconify-icon>
                                        </a>
                                        {{-- DOWNLOAD --}}
                                        <a href="#"
                                           class="action-btn w-9 h-9 grid place-items-center rounded-lg bg-[#660809] hover:bg-black text-white"
                                           title="Download">
                                            <iconify-icon icon="mdi:download"></iconify-icon>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="py-8 text-center text-gray-500">No records.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- Modal --}}
    <div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 z-50 bg-black/40 grid place-items-center p-4">
        <div x-transition class="w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b flex items-center justify-between">
                <h3 class="text-2xl font-extrabold text-slate-800">Promissory Note Details</h3>
                <button class="text-slate-600 hover:text-slate-900" @click="open=false">
                    <iconify-icon icon="mdi:close" class="text-2xl"></iconify-icon>
                </button>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- left col --}}
                <div>
                    <h4 class="font-semibold text-lg mb-3">Student Information</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between border-b pb-2"><span>Name:</span><span class="font-semibold" x-text="note.name || '—'"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Student ID:</span><span class="font-semibold" x-text="note.student_id || '—'"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Email:</span><span class="font-semibold" x-text="note.email || '—'"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Phone:</span><span class="font-semibold" x-text="note.phone || '—'"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Gender:</span><span class="font-semibold" x-text="note.gender || '—'"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Department:</span><span class="font-semibold" x-text="note.department || '—'"></span></div>
                        <div class="flex justify-between"><span>Year Level:</span><span class="font-semibold" x-text="note.year_level || '—'"></span></div>
                    </div>
                </div>

                {{-- right col --}}
                <div>
                    <h4 class="font-semibold text-lg mb-3">Promissory Note Details</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between border-b pb-2"><span>Note ID:</span><span class="font-semibold" x-text="note.pn_id || '—'"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Amount:</span><span class="font-extrabold text-emerald-600">₱<span x-text="Number(note.amount||0).toLocaleString()"></span></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Reason:</span><span class="font-semibold" x-text="note.reason || '—'"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Term:</span><span class="font-semibold" x-text="note.term || '—'"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Academic Year:</span><span class="font-semibold" x-text="note.acad_year || '—'"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Due Date:</span><span class="font-semibold" x-text="note.due_date || 'N/A'"></span></div>
                        <div class="flex justify-between border-b pb-2 items-center">
                            <span>Status:</span>
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold"
                                  :class="{
                                      'bg-green-100 text-green-700': note.status === 'Approved',
                                      'bg-yellow-100 text-yellow-700': note.status === 'Pending',
                                      'bg-red-100 text-red-700': note.status === 'Rejected'
                                  }" x-text="note.status || '—'">
                            </span>
                        </div>
                        <div class="flex justify-between"><span>Submitted:</span><span class="font-semibold" x-text="note.submitted || '—'"></span></div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 border-t flex items-center justify-end gap-3">
                <button class="px-4 py-2 rounded-lg bg-[#660809] hover:bg-black text-white" @click="note.status='Approved'">
                    Approve
                </button>
                <button class="px-4 py-2 rounded-lg bg-[#660809] hover:bg-black text-white" @click="note.status='Rejected'">
                    Reject
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Iconify + Alpine (keep these at the bottom) --}}
<script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
<script src="//unpkg.com/alpinejs" defer></script>
@endsection
