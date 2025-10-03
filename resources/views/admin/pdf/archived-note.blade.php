@extends('layouts.layout')



@section('content')

    <div class="flex flex-col items-center mt-8">
        <div class="text-2xl font-bold text-gray-800 mb-6">Archived Promissory Note Record</div>
        <div class="w-full max-w-xl bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <tbody>

                    <tr class="bg-gray-50">
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 w-1/3">PN ID</th>
                        <td class="px-6 py-4 text-sm text-gray-900">PN-{{ $note->pn_id }}</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Full Name</th>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $note->user->name ?? $note->fullname }}</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Student ID</th>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $note->user->student_id ?? $note->student_id }}</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Department</th>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $note->user->department ?? $note->department }}</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Status</th>
                        <td class="px-6 py-4 text-sm text-green-600 font-semibold">Archived</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Date Created</th>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $note->created_at ? $note->created_at->format('Y-m-d') : '' }}</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Last Modified</th>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $note->updated_at ? $note->updated_at->format('Y-m-d') : '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Additional Notes</th>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $note->notes }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
