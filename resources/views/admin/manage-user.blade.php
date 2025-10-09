@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-white flex flex-col">

    {{-- ✅ Sticky Header --}}
    <header class="fixed top-0 left-0 right-0 z-50 shadow bg-white">
        @include('includes.admin')
    </header>

    {{-- ✅ Page Content --}}
    <main class="p-6 mt-28 w-full max-w-6xl mx-auto">
        <div class="bg-white rounded-2xl shadow border overflow-hidden">
            
            {{-- ✅ Header --}}
            <div class="px-6 py-4 bg-[#660809] border-b flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h2 class="text-xl font-bold text-white">User Management</h2>
            </div>

            {{-- ✅ Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Full Name</th>
                            <th class="px-6 py-3 text-left font-semibold">Email</th>
                            <th class="px-6 py-3 text-left font-semibold">Student ID</th>
                            <th class="px-6 py-3 text-left font-semibold">Role</th>
                            <th class="px-6 py-3 text-left font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nonAdminUsers = $users->where('role', '!=', 'admin');
                        @endphp

                        @forelse ($nonAdminUsers as $user)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $user->fullname }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $user->student_id }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">
                                        {{ is_string($user->role) ? ucfirst($user->role) : ucfirst($user->role->value) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        {{-- 🔵 View Details --}}
                                        <button 
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-blue-600 hover:bg-blue-700 text-white view-btn"
                                            data-fullname="{{ $user->fullname }}"
                                            data-email="{{ $user->email }}"
                                            data-student_id="{{ $user->student_id }}"
                                            data-course="Bachelor of Science in Information Technology (BSIT)"
                                            data-year="First Term, AY 2025-2026"
                                            data-gender="M"
                                            data-status="S"
                                            data-citizenship="Filipino"
                                            data-religion="Roman Catholic"
                                            data-birthdate="December 15, 2000"
                                            data-birthplace="Iligan City"
                                            data-father="N/A"
                                            data-mother="N/A"
                                            data-address="Prk 22, Zone 9, Brgy. Maria Cristina Fuentes"
                                            title="View Details">
                                            <iconify-icon icon="mdi:eye-outline"></iconify-icon>
                                        </button>

                                        {{-- 🔴 Delete --}}
                                        <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-red-600 hover:bg-red-700 text-white" title="Delete">
                                            <iconify-icon icon="mdi:delete-outline"></iconify-icon>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</div>

{{-- ✅ SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelectorAll('.view-btn').forEach(button => {
    button.addEventListener('click', () => {
        const data = {
            fullname: button.dataset.fullname,
            email: button.dataset.email,
            student_id: button.dataset.student_id,
            course: button.dataset.course,
            year: button.dataset.year,
            gender: button.dataset.gender,
            status: button.dataset.status,
            citizenship: button.dataset.citizenship,
            religion: button.dataset.religion,
            birthdate: button.dataset.birthdate,
            birthplace: button.dataset.birthplace,
            father: button.dataset.father,
            mother: button.dataset.mother,
            address: button.dataset.address,
        };

        Swal.fire({
            title: '<h2 class="text-lg font-bold text-[#660809] mb-3">Student Details</h2>',
            html: `
                <div class="text-sm text-gray-700 text-left">
                    <table class="w-full border-collapse">
                        <tr class="bg-gray-200 font-semibold">
                            <td colspan="2" class="p-2">Enrollment Information</td>
                        </tr>
                        <tr><td class="p-2 w-1/3 bg-gray-50">Student ID Number</td><td class="p-2">${data.student_id}</td></tr>
                        <tr><td class="p-2 bg-gray-50">Name</td><td class="p-2">${data.fullname}</td></tr>
                        <tr><td class="p-2 bg-gray-50">Course</td><td class="p-2">${data.course}</td></tr>
                        <tr><td class="p-2 bg-gray-50">Last Enrolled</td><td class="p-2">${data.year}</td></tr>
                        
                        <tr class="bg-gray-200 font-semibold">
                            <td colspan="2" class="p-2">Personal Information</td>
                        </tr>
                        <tr><td class="p-2 bg-gray-50">Gender</td><td class="p-2">${data.gender}</td></tr>
                        <tr><td class="p-2 bg-gray-50">Civil Status</td><td class="p-2">${data.status}</td></tr>
                        <tr><td class="p-2 bg-gray-50">Citizenship</td><td class="p-2">${data.citizenship}</td></tr>
                        <tr><td class="p-2 bg-gray-50">Religion</td><td class="p-2">${data.religion}</td></tr>
                        <tr><td class="p-2 bg-gray-50">Date of Birth</td><td class="p-2">${data.birthdate}</td></tr>
                        <tr><td class="p-2 bg-gray-50">Place of Birth</td><td class="p-2">${data.birthplace}</td></tr>
                        <tr><td class="p-2 bg-gray-50">Father</td><td class="p-2">${data.father}</td></tr>
                        <tr><td class="p-2 bg-gray-50">Mother</td><td class="p-2">${data.mother}</td></tr>
                        <tr><td class="p-2 bg-gray-50">Permanent Address</td><td class="p-2">${data.address}</td></tr>
                    </table>
                </div>
            `,
            confirmButtonColor: '#660809',
            confirmButtonText: 'Close',
            width: 600,
            background: '#fff',
            customClass: {
                popup: 'rounded-2xl shadow-xl p-0 overflow-hidden'
            }
        });
    });
});
</script>
@endsection
