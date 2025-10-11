@extends('layouts.layout')

@section('content')
@include('includes.header')

<div class="min-h-screen bg-gray-50 py-8 px-4">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Archived Promissory Note Records</h2>

    {{-- 🔙 Back Button --}}
    <div class="flex items-center mb-4">
      <a href="{{ route('admin.manage-record') }}" 
         class="bg-[#800000] hover:bg-[#990000] text-white font-semibold px-5 py-2 rounded-lg flex items-center gap-2 transition duration-200">
        <span class="iconify" data-icon="mdi:arrow-left" data-width="20" data-height="20"></span>
        Back to Records
      </a>
    </div>

    {{-- 📋 Archived Table --}}
    <div class="bg-white rounded-xl shadow p-6">
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
          <thead>
            <tr class="bg-[#800000]/10 text-[#800000] uppercase text-xs tracking-wide">
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
            <tr class="border-b hover:bg-gray-50 transition">
              <td class="py-3 px-4 font-semibold text-gray-800">{{ $note->pn_id }}</td>

              <td class="py-3 px-4">
                <div class="font-semibold text-gray-800">{{ $note->user->name ?? $note->fullname }}</div>
                <div class="text-gray-500 text-xs">{{ $note->user->student_id ?? $note->student_id }}</div>
              </td>

              <td class="py-3 px-4 text-[#800000] font-bold">
                {{ $note->user->department ?? $note->department }}
              </td>

              <td class="py-3 px-4">
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-500">
                  Archived
                </span>
              </td>

              <td class="py-3 px-4">{{ $note->created_at ? $note->created_at->format('Y-m-d') : '' }}</td>
              <td class="py-3 px-4">{{ $note->updated_at ? $note->updated_at->format('Y-m-d') : '' }}</td>

              <td class="py-3 px-4 flex gap-2">
                {{-- 🔄 Restore Button with SweetAlert --}}
                <form action="{{ route('admin.promissorynotes-restore', $note->pn_id) }}" 
                      method="POST" 
                      class="restore-form inline">
                  @csrf
                  <button type="submit" 
                          class="bg-[#d4a5a5] hover:bg-[#c08585] text-[#800000] p-2 rounded-lg transition duration-200" 
                          title="Restore">
                    <span class="iconify" data-icon="mdi:backup-restore" data-width="20" data-height="20"></span>
                  </button>
                </form>

                {{-- ⬇ Download Button --}}
                <button 
                  class="bg-[#800000] hover:bg-[#990000] text-white p-2 rounded-lg transition duration-200" 
                  title="Download">
                  <span class="iconify" data-icon="mdi:download" data-width="20" data-height="20"></span>
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- ✅ SweetAlert2 for Restore Confirmation --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".restore-form").forEach(form => {
    form.addEventListener("submit", function(e) {
      e.preventDefault();

      Swal.fire({
        title: "Restore this record?",
        text: "This will move the record back to active records.",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#800000",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Yes, restore it!"
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });
});
</script>
@endsection
