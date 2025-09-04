@extends('layouts.layout')


@section('content')
 @include('includes.header')
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
          <div class="text-green-600 text-2xl font-bold"></div>
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
        <button class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-lg flex items-center gap-2">
          <span class="iconify" data-icon="mdi:download" data-width="20" data-height="20"></span>
          Export Records
        </button>
        <a href="{{ route('admin.dashboard') }}" class="ml-4 text-gray-500 hover:text-gray-700 flex items-center gap-1">
          <span class="iconify" data-icon="mdi:arrow-left" data-width="20" data-height="20"></span>
          Back
        </a>
      </div>
    </div>


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

                <button class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-lg" title="View">
                  <span class="iconify" data-icon="mdi:eye" data-width="20" data-height="20"></span>
                </button>

                <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-lg" title="Archive">
                  <span class="iconify" data-icon="mdi:archive" data-width="20" data-height="20"></span>
                </button>

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
  </div>
</div>
@endsection
