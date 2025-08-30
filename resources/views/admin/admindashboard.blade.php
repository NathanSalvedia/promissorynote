@extends('layouts.layout')

@section('content')

{{-- ===== styles (marquee + icon animation) ===== --}}
<style>
  /* top black strip scrolling */
  .marquee { white-space:nowrap; overflow:hidden; box-sizing:border-box }
  .marquee>span { display:inline-block; padding-left:100%; animation:marquee 16s linear infinite }
  .marquee:hover>span { animation-play-state:paused }
  @keyframes marquee { 0%{transform:translateX(0)} 100%{transform:translateX(-100%)} }

  /* animated dashboard icons (GIF-like) */
  @keyframes bounce { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-6px)} }
  @keyframes pulse  { 0%,100%{transform:scale(1)} 50%{transform:scale(1.2)} }
  .icon-anim{animation:bounce 1.5s infinite, pulse 3s infinite}
</style>

<div class="min-h-screen bg-gray-100 flex flex-col">

   <header class="w-full">
      {{-- Top black strip with scrolling text --}}
      <div class="bg-black text-white text-[11px] md:text-xs py-0.5">
        <div class="max-w-7xl mx-auto px-4">
          <div class="marquee">
            <span>Enroll Now  |  Experience a Modern SPC  |  Welcome to My.SPC Promissorynote Management System</span>
          </div>
        </div>
      </div>


    {{-- Thin maroon strip (optional info) --}}
    <div class="bg-[#660809] text-white">
      <div class="max-w-7xl mx-auto px-4 py-1 text-[11px] md:text-xs flex justify-end gap-6">
        {{-- add contact items here if needed --}}
      </div>
    </div>

    {{-- White navbar with logo + user tools --}}
    <div class="bg-white shadow">
      <div class="max-w-10xl mx-auto flex justify-between items-center px-6 py-3">

        {{-- Left: wordmark + system name --}}
        <div class="flex items-center gap-3">
          <img src="/img/spc-wordmark.png" alt="SPC" class="h-10 md:h-12 object-contain">
          <div>
       
          </div>
        </div>

        {{-- Right: bell + user + logout (kept) --}}
        <div class="flex items-center gap-6">
          <button class="relative text-[#660809] hover:text-[#000000]" title="Notifications">
            <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 rounded-full">3</span>
          </button>

          <div class="flex items-center gap-2">
            <iconify-icon icon="mdi:account-circle" class="text-2xl text-gray-700"></iconify-icon>
            <span class="font-medium">
              @auth
                {{ auth()->user()->fullname }}
              @else
                Guest
              @endauth
            </span>
          </div>

          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-[#660809] hover:text-[#000000] flex items-center gap-1" title="Logout">
              <iconify-icon icon="mdi:logout" class="text-xl"></iconify-icon>
              Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </header>

  {{-- ================= MAIN ================= --}}
  <main class="p-6 max-w-7xl mx-auto w-full">

    {{-- Top bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
      <h2 class="text-2xl font-bold">Admin Dashboard</h2>

      <div class="flex gap-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.manage-record') }}"
           class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#000000] text-white px-4 py-2 rounded-lg shadow"
           title="Manage promissory note records">
          <iconify-icon icon="mdi:file-document-edit-outline"></iconify-icon>
          Manage Records
        </a>

        <a href="{{ route('admin.analytics') }}"
           class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#000000] text-white px-4 py-2 rounded-lg shadow"
           title="View analytics and reports">
          <iconify-icon icon="mdi:chart-line"></iconify-icon>
          Analytics
        </a>

             <a href="{{ route('admin.manage-users') }}"
               class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#000000] text-white px-4 py-2 rounded-lg shadow"
               title="Manage user accounts">
                <iconify-icon icon="mdi:account-multiple-outline"></iconify-icon>
                Manage Users
            </a>

      </div>
    </div>

    {{-- Metric cards (with animated icons) --}}
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">

      <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center justify-between">
        <div class="flex items-center gap-3">
          <span class="inline-flex rounded-xl bg-white/20 p-3">
            <iconify-icon icon="mdi:file-document-outline" class="text-2xl icon-anim"></iconify-icon>
          </span>
          <div>
            <p class="text-sm/5 opacity-90">Total Notes</p>
            <p class="text-3xl font-bold">{{ $totalNotes }}</p>
          </div>
        </div>
      </div>

      <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center justify-between">
        <div class="flex items-center gap-3">
          <span class="inline-flex rounded-xl bg-white/20 p-3">
            <iconify-icon icon="mdi:clock-outline" class="text-2xl icon-anim"></iconify-icon>
          </span>
          <div>
            <p class="text-sm/5 opacity-90">Pending Review</p>
            <p class="text-3xl font-bold">{{ $pendingNotes }}</p>
          </div>
        </div>
      </div>

      <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center justify-between">
        <div class="flex items-center gap-3">
          <span class="inline-flex rounded-xl bg-white/20 p-3">
            <iconify-icon icon="mdi:check-circle-outline" class="text-2xl icon-anim"></iconify-icon>
          </span>
          <div>
            <p class="text-sm/5 opacity-90">Approved</p>
            <p class="text-3xl font-bold">{{ $approvedNotes }}</p>
          </div>
        </div>
      </div>

      <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center justify-between">
        <div class="flex items-center gap-3">
          <span class="inline-flex rounded-xl bg-white/20 p-3">
            <iconify-icon icon="mdi:close-circle-outline" class="text-2xl icon-anim"></iconify-icon>
          </span>
          <div>
            <p class="text-sm/5 opacity-90">Rejected</p>
            <p class="text-3xl font-bold">{{ $rejectedNotes }}</p>
          </div>
        </div>
      </div>

    </div>

    {{-- Pending Requests --}}
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
          <tbody>
            @php
              $statusColors = [
                'pending'  => 'bg-yellow-100 text-yellow-800',
                'approved' => 'bg-green-100 text-green-800',
                'rejected' => 'bg-red-100 text-red-800',
              ];
            @endphp

            @forelse($notes as $note)
              <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $note->pn_id ?? ('PN-'.$note->id) }}</td>

                <td class="px-6 py-4">
                  <div class="font-semibold">{{ optional($note->user)->fullname ?? 'N/A' }}</div>
                  <div class="text-gray-500 text-xs">
                    Student ID: {{ optional($note->user)->student_id ?? 'N/A' }}
                  </div>
                </td>

                <td class="px-6 py-4">
                  <span class="inline-block bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">
                    {{ $note->department ?? optional($note->user)->department ?? '—' }}
                  </span>
                </td>

                <td class="px-6 py-4 font-semibold">₱{{ number_format((float)($note->amount ?? 0), 2) }}</td>
                <td class="px-6 py-4">{{ $note->reason ?? '—' }}</td>

                <td class="px-6 py-4">
                  <div>{{ optional($note->created_at)->format('Y-m-d') }}</div>
                  <div class="text-gray-500 text-xs">{{ optional($note->created_at)->diffForHumans() }}</div>
                </td>

                <td class="px-6 py-4">
                  <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$note->status] ?? 'bg-gray-100 text-gray-800' }}">
                    {{ ucfirst($note->status ?? '—') }}
                  </span>
                </td>

                <td class="px-6 py-4">
                  <div class="flex items-center gap-2">
                    @if(($note->status ?? '') === 'pending')
                      <form method="POST" action="{{ route('admin.promissory.approve', $note->pn_id) }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-green-600 hover:bg-green-700 text-white" title="Approve">
                          <iconify-icon icon="mdi:check"></iconify-icon>
                        </button>
                      </form>
                      <form method="POST" action="{{ route('admin.promissory.reject', $note->pn_id) }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-red-600 hover:bg-red-700 text-white" title="Reject">
                          <iconify-icon icon="mdi:close"></iconify-icon>
                        </button>
                      </form>
                    @endif

                    <a href="{{ route('admin.promissorynote-detail', $note->pn_id) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-blue-600 hover:bg-blue-700 text-white" title="View">
                      <iconify-icon icon="mdi:eye-outline"></iconify-icon>
                    </a>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="px-6 py-8 text-center text-gray-500">No pending requests.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>

@endsection
