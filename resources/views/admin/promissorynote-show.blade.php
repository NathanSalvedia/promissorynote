@extends('layouts.layout')

@section('content')
@include('includes.admin')

<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow p-8">

        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('admin.manage-record') }}"
               class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Back to Manage Record
            </a>
        </div>

        <h2 class="text-2xl font-bold mb-6 text-gray-800">Promissory Note Details</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 mb-6">
            <div>
                <span class="font-semibold text-gray-700">PN ID:</span>
                <span class="block text-gray-900">{{ $note->pn_id }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">Full Name:</span>
                <span class="block text-gray-900">{{ $note->user->name ?? $note->fullname }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">Student ID:</span>
                <span class="block text-gray-900">{{ $note->user->student_id ?? $note->student_id }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">Department:</span>
                <span class="block text-gray-900">{{ $note->user->department ?? $note->department }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">Status:</span>
                <span class="block text-gray-900">{{ ucfirst($note->status) }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">Date Created:</span>
                <span class="block text-gray-900">{{ $note->created_at ? $note->created_at->format('Y-m-d') : '' }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">Last Modified:</span>
                <span class="block text-gray-900">{{ $note->updated_at ? $note->updated_at->format('Y-m-d') : '' }}</span>
            </div>

        </div>
    </div>
</div>

@endsection
