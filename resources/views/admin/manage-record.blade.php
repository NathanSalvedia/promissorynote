@extends('layouts.layout')

@section('content')
<div class="flex min-h-screen bg-gray-50">

  {{-- ✅ Main Content --}}
  <div class="flex-1">

    {{-- ✅ Header (fixed full width) --}}
    <header class="fixed top-0 left-0 right-0 z-40 shadow bg-white">
      @include('includes.admin')
    </header>

    {{-- ✅ Page Content (with padding top to avoid header overlap) --}}
    <main class="p-6 mt-24 max-w-6xl mx-auto">

      {{-- Title --}}
      <h2 class="text-2xl font-bold mb-6 text-gray-800 mt-4">Centralized Record Management</h2>

      {{-- 📊 Dashboard Cards --}}
      <div class="flex flex-wrap gap-6 mb-8">
        <div class="flex-1 min-w-[220px] bg-[#660809] rounded-xl shadow p-6 flex items-center gap-4">
          <div class="bg-blue-100 text-blue-600 rounded-full p-3">
            <span class="iconify" data-icon="mdi:database" data-width="28" data-height="28"></span>
          </div>
          <div>
            <div class="text-gray-200 text-sm">Total Records</div>
            <div class="text-white text-2xl font-bold">{{ $totalNotes ?? $promissoryNotes->count() }}</div>
          </div>
        </div>

        <div class="flex-1 min-w-[220px] bg-[#660809] rounded-xl shadow p-6 flex items-center gap-4">
          <div class="bg-green-100 text-green-600 rounded-full p-3">
            <span class="iconify" data-icon="mdi:file-document-box" data-width="28" data-height="28"></span>
          </div>
          <div>
            <div class="text-gray-200 text-sm">Archived</div>
            <div class="text-white text-2xl font-bold">{{ $archivedNotesCount }}</div>
          </div>
        </div>

        <div class="flex-1 min-w-[220px] bg-[#660809] rounded-xl shadow p-6 flex items-center gap-4">
          <div class="bg-orange-100 text-orange-600 rounded-full p-3">
            <span class="iconify" data-icon="mdi:clock-outline" data-width="28" data-height="28"></span>
          </div>
          <div>
            <div class="text-gray-200 text-sm">Recent Activity</div>
            <div class="text-white text-2xl font-bold"></div>
          </div>
        </div>

        <div class="flex items-center ml-auto">
          <a href="{{ route('admin.archived-notes') }}"
            class="ml-4 text-green-600 hover:text-green-800 flex items-center gap-1 font-semibold">
              <span class="iconify" data-icon="mdi:archive" data-width="20" data-height="20"></span>
              Archived Records
          </a>
        </div>
      </div>

      {{-- 📋 Records Table --}}
      <div class="bg-white rounded-xl shadow p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-4">
          <h3 class="text-lg font-semibold text-gray-700">All Promissory Note Records</h3>

          {{-- 🔎 Search & Filter --}}
          <form method="GET" action="{{ route('admin.manage-record') }}"
                class="flex flex-col sm:flex-row gap-3 sm:items-center w-full sm:w-auto">

            <!-- Search -->
            <div class="relative flex-1 sm:w-64">
                <input type="text" id="search" name="search" value="{{ request('search') }}"

                    class="w-full border-2 border-[#660809] rounded-lg shadow-sm focus:ring-2 focus:ring-[#660809] focus:border-[#660809] py-2 pl-10 pr-3 text-sm outline-none transition-all duration-150"
                    placeholder="Search by Course or Name...">
                <iconify-icon icon="mdi:magnify"
                    class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#660809] text-xl pointer-events-none"></iconify-icon>
            </div>

            <!-- Department Filter -->
            <div>
              <select id="department" name="department"
                class="w-full border-2 border-[#660809] rounded-lg shadow-sm focus:ring-[#660809] focus:border-[#660809] py-1.5 px-3 text-sm outline-none"
                onchange="this.form.submit()">
                <option value="">All Departments</option>
                @foreach($departments as $dept)
                  <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                    {{ $dept }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Status Sort -->
            <div>
              <select id="status_sort" name="status_sort"
                class="w-full border-2 border-[#660809] rounded-lg shadow-sm focus:ring-[#660809] focus:border-[#660809] py-1.5 px-3 text-sm outline-none"
                onchange="this.form.submit()">
                <option value="">Sort by Status</option>
                <option value="approved" {{ request('status_sort') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="pending" {{ request('status_sort') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="rejected" {{ request('status_sort') == 'rejected' ? 'selected' : '' }}>Rejected</option>
              </select>
            </div>
          </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
          <table class="min-w-full text-sm">
            <thead>
              <tr class="bg-gray-100 text-gray-600">
                <th class="py-3 px-4 text-left font-medium">PN ID</th>
                <th class="py-3 px-4 text-left font-medium">Full Name</th>
                <th class="py-3 px-4 text-left font-medium">Department</th>
                <th class="py-3 px-4 text-left font-medium">Course</th> <!-- Added Course column -->
                <th class="py-3 px-4 text-left font-medium">Status</th>
                <th class="py-3 px-4 text-left font-medium">Remarks</th>
                <th class="py-3 px-4 text-left font-medium">Due Date</th>
                <th class="py-3 px-4 text-left font-medium">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($promissoryNotes as $note)
              <tr class="border-b">
                <td class="py-3 px-4 font-semibold">PN-{{ $note->pn_id }}</td>
                <td class="py-3 px-4">
                  <div class="font-semibold text-gray-800">{{ $note->user->fullname ?? $note->fullname }}</div>
                  <div class="text-gray-500 text-xs">{{ $note->user->student_id ?? $note->student_id }}</div>
                </td>
                <td class="py-3 px-4 text-green-600 font-bold">{{ $note->user->department ?? $note->department }}</td>
                <td class="py-3 px-4">
                  <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap truncate" style="max-width:180px;">
                    {{ $note->course ?? 'N/A' }}
                  </span>
                </td>
                <td class="py-3 px-4">
                  <span class="px-3 py-1 rounded-full text-xs font-semibold"
                    style="background-color:{{ $note->status == 'approved' ? '#d1fae5' : ($note->status == 'pending' ? '#fef3c7' : '#fee2e2') }}; color:{{ $note->status == 'approved' ? '#059669' : ($note->status == 'pending' ? '#d97706' : '#b91c1c') }};">
                    {{ ucfirst($note->status) }}
                  </span>
                </td>
                <td class="py-3 px-4">
                  @if(isset($note->is_settled) && $note->is_settled)
                      <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap truncate" style="max-width:120px;">Settled</span>
                  @elseif($note->remarks == 'Not overdue yet')
                      <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap truncate" style="max-width:120px;">{{ $note->remarks }}</span>
                  @elseif($note->remarks == 'Not settled')
                      <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap truncate" style="max-width:120px;">{{ $note->remarks }}</span>
                  @elseif($note->remarks == 'Overdue')
                      <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap truncate" style="max-width:120px;">{{ $note->remarks }}</span>
                  @elseif($note->remarks == 'No due date')
                      <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap truncate" style="max-width:120px;">{{ $note->remarks }}</span>
                  @else
                      <span class="whitespace-nowrap truncate" style="max-width:120px; display:inline-block;">{{ $note->remarks }}</span>
                  @endif
                </td>
                <td class="py-3 px-4">
                  <span class="whitespace-nowrap truncate" style="max-width:120px; display:inline-block;">
                    {{ $note->due_date_formatted }}
                  </span>
                </td>
                <td class="py-3 px-4 flex gap-2">
                  {{-- View --}}
                  <a href="{{ route('admin.promissorynotes-show', $note->pn_id) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-lg" title="View">
                    <span class="iconify" data-icon="mdi:eye" data-width="20" data-height="20"></span>
                  </a>
                  {{-- Archive --}}
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
    </main>
  </div>
</div>


@endsection
