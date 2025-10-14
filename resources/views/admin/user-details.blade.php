@extends('layouts.layout')

@section('content')
 @include('includes.admin')
<div class="w-full mt-10 bg-white p-6 rounded shadow">

    <!-- Back Button -->
    <a href="{{  route('admin.manage-users') }}" class="inline-flex items-center mb-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Back
    </a>

    <h2 class="text-2xl font-bold mb-4">Profile</h2>
    <div class="bg-gray-100 rounded mb-6">
        <div class="bg-gray-400 text-white px-4 py-2 rounded-t font-semibold">Enrollment Information</div>
        <table class="w-full text-sm">
            <tr>
                <td class="border px-4 py-2 w-1/3">Student ID Number</td>
                <td class="border px-4 py-2">{{ $user->student_id }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Name</td>
                <td class="border px-4 py-2">{{ $user->fullname }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Course</td>
                <td class="border px-4 py-2">{{ $user->course }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Last Enrolled</td>
                <td class="border px-4 py-2">{{ $user->last_enrolled }}</td>
            </tr>
        </table>
    </div>
    <div class="bg-gray-100 rounded">
        <div class="bg-gray-400 text-white px-4 py-2 rounded-t font-semibold">Personal Information</div>
        <table class="w-full text-sm">
            <tr>
                <td class="border px-4 py-2 w-1/3">Gender</td>
                <td class="border px-4 py-2">{{ $user->gender }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Civil Status</td>
                <td class="border px-4 py-2">{{ $user->civil_status }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Citizenship</td>
                <td class="border px-4 py-2">{{ $user->citizenship }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Religion</td>
                <td class="border px-4 py-2">{{ $user->religion }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Ethnic Group</td>
                <td class="border px-4 py-2">{{ $user->ethnic_group }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Date of Birth</td>
                <td class="border px-4 py-2">{{ $user->date_of_birth }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Place of Birth</td>
                <td class="border px-4 py-2">{{ $user->place_of_birth }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Name of Father</td>
                <td class="border px-4 py-2">{{ $user->father_name }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Name of Mother</td>
                <td class="border px-4 py-2">{{ $user->mother_name }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Address of Parents</td>
                <td class="border px-4 py-2">{{ $user->parents_address }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Name of Spouse</td>
                <td class="border px-4 py-2">{{ $user->spouse_name }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Permanent Address</td>
                <td class="border px-4 py-2">{{ $user->permanent_address }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
