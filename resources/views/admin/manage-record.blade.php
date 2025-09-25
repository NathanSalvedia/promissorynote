@extends('layouts.layout')

@section('content')
@include('includes.admin')
<div class="min-h-screen bg-gray-50 py-8 px-4">

  <div class="max-w-6xl mx-auto">

    {{-- 🔙 Back Button --}}
    <a href="{{ route('admin.dashboard') }}" 
      class="mb-4 inline-flex items-center gap-2 bg-[#660809] hover:bg-red-800 text-white px-4 py-2 rounded-lg shadow transition duration-200">
        <span class="iconify" data-icon="mdi:arrow-left" data-width="22" data-height="22"></span>
        <span class="font-semibold">Back to Dashboard</span>
    </a>

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Centralized Record Management</h2>

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

    {{-- 🔎 Search & Filter (Dashboard Style) --}}
    <div class="bg-white p-4 rounded-xl shadow border mb-6">
      <form method="GET" action="{{ route('admin.manage-record') }}" 
            class="flex flex-col sm:flex-row gap-4 sm:items-center">

        <!-- Search -->
        <div class="relative flex-1">
          <input type="text" id="search" name="search" value="{{ request('search') }}"
            class="w-full border-gray-300 rounded-full shadow-sm focus:ring-[#660809] focus:border-[#660809] pl-10 pr-4 py-2 text-sm"
            placeholder="Search by Course or Name...">
          <iconify-icon icon="mdi:magnify"
            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></iconify-icon>
        </div>

        <!-- Department Filter -->
        <div>
          <select id="department" name="department"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#660809] focus:border-[#660809] py-2 px-3 text-sm">
            <option value="">All Departments</option>
            @foreach($departments as $dept)
              <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                {{ $dept }}
              </option>
            @endforeach
          </select>
        </div>

        <!-- Button -->
        <div>
          <button type="submit" 
            class="bg-[#660809] hover:bg-red-800 transition text-white px-6 py-2 rounded-lg shadow font-semibold text-sm">
            Apply
          </button>
        </div>
      </form>
    </div>

    {{-- 📋 Records Table --}}
    <div class="bg-white rounded-xl shadow p-6">
      <h3 class="text-lg font-semibold mb-4 text-gray-700">All Promissory Note Records</h3>
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
          <thead>
            <tr class="bg-gray-100 text-gray-600">
              <th class="py-3 px-4 text-left font-medium">PN ID</th>
              <th class="py-3 px-4 text-left font-medium">Full Name</th>
              <th class="py-3 px-4 text-left font-medium">Department</th>
              <th class="py-3 px-4 text-left font-medium">Status</th>
              <th class="py-3 px-4 text-left font-medium">Date Created</th>
              <th class="py-3 px-4 text-left font-medium">Last Modified</th>
              <th class="py-3 px-4 text-left font-medium">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($promissoryNotes as $note)
            <tr class="border-b">
              <td class="py-3 px-4 font-semibold">{{ $note->pn_id }}</td>
              <td class="py-3 px-4">
                <div class="font-semibold text-gray-800">{{ $note->user->name ?? $note->fullname }}</div>
                <div class="text-gray-500 text-xs">{{ $note->user->student_id ?? $note->student_id }}</div>
              </td>
              <td class="py-3 px-4 text-green-600 font-bold">{{ $note->user->department ?? $note->department }}</td>
              <td class="py-3 px-4">
                <span class="px-3 py-1 rounded-full text-xs font-semibold"
                  style="background-color:{{ $note->status == 'approved' ? '#d1fae5' : ($note->status == 'pending' ? '#fef3c7' : '#fee2e2') }}; color:{{ $note->status == 'approved' ? '#059669' : ($note->status == 'pending' ? '#d97706' : '#b91c1c') }};">
                  {{ ucfirst($note->status) }}
                </span>
              </td>
              <td class="py-3 px-4">{{ $note->created_at ? $note->created_at->format('Y-m-d') : '' }}</td>
              <td class="py-3 px-4">{{ $note->updated_at ? $note->updated_at->format('Y-m-d') : '' }}</td>
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
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-lg" 
                            title="Archive">
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
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // ✅ SweetAlert Confirm Archive
  document.querySelectorAll('.archive-form').forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      Swal.fire({
        title: 'Are you sure?',
        text: "This record will be archived.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, archive it!'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });
</script>

@if(session('success'))
<script>
  // ✅ Success Alert after Archive
  Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: '{{ session('success') }}',
    showConfirmButton: false,
    timer: 2000
  })
</script>
@endif
@endsection
