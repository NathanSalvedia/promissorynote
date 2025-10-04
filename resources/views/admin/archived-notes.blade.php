@extends('layouts.layout')

@section('content')
<div class="flex min-h-screen bg-gray-50">

  {{-- ✅ Main Content Area (wala na sidebar) --}}
  <div class="flex-1">
    
    {{-- ✅ Header (fixed, full width) --}}
    <header class="fixed top-0 left-0 right-0 z-40 shadow bg-white">
      @include('includes.admin')
    </header>

    {{-- ✅ Dashboard Content (gi adjust padding-top) --}}
    <main class="p-6 mt-24 max-w-6xl mx-auto">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Archived Promissory Note Records</h2>

      {{-- ✅ Back + Export --}}
      <div class="flex items-center mb-4">
        <a href="{{ route('admin.manage-record') }}" 
           class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-lg flex items-center gap-2">
          <span class="iconify" data-icon="mdi:arrow-left" data-width="20" data-height="20"></span>
          Back to Records
        </a>

        <div class="flex-1"></div>
        <button class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-lg flex items-center gap-2">
          <span class="iconify" data-icon="mdi:download" data-width="20" data-height="20"></span>
          Export Records
        </button>
      </div>

      {{-- ✅ Table --}}
      <div class="bg-white rounded-xl shadow p-6">
        <div class="overflow-x-auto">
          <table class="min-w-full text-sm border">
            <thead>
              <tr class="bg-gray-100 text-gray-600 border-b">
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
              @foreach($archivedNotes as $note)
              <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4 font-semibold">{{ $note->pn_id }}</td>
                <td class="py-3 px-4">
                  <div class="font-semibold text-gray-800">{{ $note->user->name ?? $note->fullname }}</div>
                  <div class="text-gray-500 text-xs">{{ $note->user->student_id ?? $note->student_id }}</div>
                </td>
                <td class="py-3 px-4 text-green-600 font-bold">{{ $note->user->department ?? $note->department }}</td>
                <td class="py-3 px-4">
                  <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-600">
                    Archived
                  </span>
                </td>
                <td class="py-3 px-4">{{ $note->created_at ? $note->created_at->format('Y-m-d') : '' }}</td>
                <td class="py-3 px-4">{{ $note->updated_at ? $note->updated_at->format('Y-m-d') : '' }}</td>
                <td class="py-3 px-4 flex gap-2">
                  {{-- ✅ Restore --}}
                  <form id="restore-form-{{ $note->pn_id }}" action="{{ route('admin.promissorynotes-restore', $note->pn_id) }}" method="POST" style="display:none;">
                    @csrf
                  </form>
                  <button onclick="confirmRestore({{ $note->pn_id }})" 
                          class="bg-blue-200 hover:bg-blue-300 text-blue-700 p-2 rounded-lg" 
                          title="Restore">
                    <span class="iconify" data-icon="mdi:backup-restore" data-width="20" data-height="20"></span>
                  </button>

                  {{-- ✅ Download --}}
                  <button class="bg-green-600 hover:bg-green-700 text-white p-2 rounded-lg" title="Download">
                    <span class="iconify" data-icon="mdi:download" data-width="20" data-height="20"></span>
                  </button>
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

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmRestore(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "This record will be restored.",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#2563eb',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, restore it!'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('restore-form-' + id).submit();
      }
    });
  }
</script>

@if(session('success'))
<script>
  Swal.fire({
    icon: 'success',
    title: 'Restored!',
    text: '{{ session('success') }}',
    showConfirmButton: false,
    timer: 2000
  })
</script>
@endif
@endsection
