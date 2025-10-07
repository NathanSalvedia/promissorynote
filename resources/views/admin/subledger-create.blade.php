@extends('layouts.layout')

@include('includes.admin')
@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow-lg mt-8">

    <div class="mb-8">
        <a href="{{ route('admin.dashboard') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#660809] text-white font-semibold rounded-lg shadow hover:bg-black transition duration-200">
            <iconify-icon icon="mdi:arrow-left"></iconify-icon>
            Back to Dashboard
        </a>
    </div>

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Add Subledger Entry</h2>

    <form id="subledgerForm" action="{{ route('admin.subledger.create') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf
        <div class="flex flex-col gap-2">
            <label class="text-gray-700 font-medium">User ID</label>
            <input type="text" name="user_id" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm" required>
        </div>
        <div class="flex flex-col gap-2">
            <label class="text-gray-700 font-medium">School Year</label>
            <input type="text" name="school_year" class=" px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm" required>
        </div>
        <div class="flex flex-col gap-2">
            <label class="text-gray-700 font-medium">Semester</label>
            <input type="text" name="semester" class=" px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm" required>
        </div>
        <div class="flex flex-col gap-2">
            <label class="text-gray-700 font-medium">Date</label>
            <input type="date" name="date" class=" px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm" required>
        </div>
        <div class="flex flex-col gap-2">
            <label class="text-gray-700 font-medium">Reference</label>
            <input type="text" name="reference" class=" px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm" required>
        </div>
        <div class="flex flex-col gap-2">
            <label class="text-gray-700 font-medium">Debit</label>
            <input type="number" step="0.01" name="debit" class=" px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm" required>
        </div>
        <div class="flex flex-col gap-2">
            <label class="text-gray-700 font-medium">Credit</label>
            <input type="number" step="0.01" name="credit" class=" px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm" required>
        </div>
        <div class="flex flex-col gap-2">
            <label class="text-gray-700 font-medium">Balance</label>
            <input type="number" step="0.01" name="balance" class=" px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm" required>
        </div>
        <div class="md:col-span-2 flex justify-end">
            <button type="submit" id="btn-save" class="px-8 py-3 bg-[#660809] text-white font-bold rounded-lg shadow hover:bg-black transition duration-200">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
