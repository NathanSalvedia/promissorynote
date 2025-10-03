@extends('layouts.layout')
@section('content')
 @include('includes.admin')

<div class="min-h-screen bg-gray-50 py-8 px-4">

  <div class="max-w-6xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Centralized Record Management</h2>
    <div class="flex flex-wrap gap-6 mb-8">

      <div class="flex-1 min-w-[220px] bg-white rounded-xl shadow p-6 flex items-center gap-4">
        <div class="bg-blue-100 text-blue-600 rounded-full p-3">
          <span class="iconify" data-icon="mdi:database" data-width="28" data-height="28"></span>
        </div>
        <div>
          <div class="text-gray-500 text-sm">Total Records</div>
          <div class="text-blue-600 text-2xl font-bold">{{ $totalNotes ?? $promissoryNotes->count() }}</div>
        </div>
      </div>

      <div class="flex-1 min-w-[220px] bg-white rounded-xl shadow p-6 flex items-center gap-4">
        <div class="bg-green-100 text-green-600 rounded-full p-3">
          <span class="iconify" data-icon="mdi:file-document-box" data-width="28" data-height="28"></span>
        </div>
        <div>
          <div class="text-gray-500 text-sm">Archived</div>
          <div class="text-green-600 text-2xl font-bold">{{ $archivedNotesCount }}</div>
        </div>
      </div>


      <div class="flex-1 min-w-[220px] bg-white rounded-xl shadow p-6 flex items-center gap-4">
        <div class="bg-orange-100 text-orange-600 rounded-full p-3">
          <span class="iconify" data-icon="mdi:clock-outline" data-width="28" data-height="28"></span>
        </div>
        <div>
          <div class="text-gray-500 text-sm">Recent Activity</div>
          <div class="text-orange-600 text-2xl font-bold"></div>
        </div>
      </div>

      <div class="flex items-center ml-auto">
        <a href="{{ route('admin.archived-notes') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-lg flex items-center gap-2 transition">
          <span class="iconify" data-icon="mdi:archive" data-width="20" data-height="20"></span>
          Archived Records
        </a>

        <a href="{{ route('admin.dashboard') }}" class="ml-4 bg-gray-200 hover:bg-gray-300 text-gray-700 flex items-center gap-1 font-semibold px-5 py-2 rounded-lg transition">
            <span class="iconify" data-icon="mdi:arrow-left" data-width="20" data-height="20"></span>
            Back
        </a>
      </div>
    </div>

    <form method="GET" action="{{ route('admin.manage-record') }}" class="flex flex-col sm:flex-row sm:items-end gap-4 w-full justify-end">
      <div>
        <label for="search" class="text-lg font-medium text-gray-700 mb-2">Search by Course</label>
        <div class="relative">
          <input type="text" id="search" name="search" value="{{ request('search') }}"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#660809] focus:border-[#660809] pl-10 pr-4 py-2"
            placeholder="Enter course name">
          <iconify-icon icon="mdi:magnify"
            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xl"></iconify-icon>
        </div>
      </div>
      <div>
        <label for="department" class="text-lg font-medium text-gray-700 mb-2">Filter by Department</label>
        <select id="department" name="department"
          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#660809] focus:border-[#660809] py-2">
          <option value="">All Departments</option>
          @foreach($departments as $dept)
            <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
          @endforeach
        </select>
      </div>
      <div class="self-end">
        <button type="submit" class="bg-[#660809] text-white px-4 py-2 rounded-lg shadow">Filter</button>
      </div>
    </form>

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
              <td class="py-3 px-4 font-semibold">PN-{{ $note->pn_id }}</td>
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

                @if(!empty($note->pn_id))
                  <a href="{{ route('admin.promissorynotes-show', $note->pn_id) }}" class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-lg" title="View">
                    <span class="iconify" data-icon="mdi:eye" data-width="20" data-height="20"></span>
                  </a>
                @else
                  <button class="bg-blue-300 text-white p-2 rounded-lg opacity-50" >
                    <span class="iconify" data-icon="mdi:eye" data-width="20" data-height="20"></span>
                  </button>
                @endif

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
  </div>
</div>



@endsection
