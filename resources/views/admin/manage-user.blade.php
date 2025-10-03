@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">

    {{-- ✅ Header (fixed, dili matabunan) --}}
    <header class="fixed top-0 left-0 right-0 z-50 shadow bg-white">
        @include('includes.header')
    </header>

    {{-- ✅ Page Content --}}
    <main class="p-6 mt-24 w-full max-w-6xl mx-auto">
        <div class="bg-white rounded-xl shadow p-8">

            {{-- ✅ Title + Back Button --}}
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">User Management</h2>
                <a href="{{ route('admin.dashboard')}}" 
                   class="text-gray-600 hover:text-gray-900 flex items-center gap-1 border px-3 py-1 rounded-lg shadow-sm">
                    <iconify-icon icon="mdi:arrow-left" class="w-5 h-5"></iconify-icon>
                    <span>Back</span>
                </a>
            </div>

            {{-- ✅ Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="py-3 px-4 text-left font-semibold">Full Name</th>
                            <th class="py-3 px-4 text-left font-semibold">Email</th>
                            <th class="py-3 px-4 text-left font-semibold">Student ID</th>
                            <th class="py-3 px-4 text-left font-semibold">Role</th>
                            <th class="py-3 px-4 text-left font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nonAdminUsers = $users->where('role', '!=', 'admin');
                        @endphp
                        @forelse ($nonAdminUsers as $user)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $user->fullname }}</td>
                            <td class="py-3 px-4">{{ $user->email }}</td>
                            <td class="py-3 px-4">{{ $user->student_id }}</td>
                            <td class="py-3 px-4">{{ is_string($user->role) ? ucfirst($user->role) : ucfirst($user->role->value) }}</td>
                            <td class="py-3 px-4 flex gap-3">
                                <a href="#" class="text-blue-600 hover:text-blue-800">
                                    <iconify-icon icon="mdi:square-edit-outline" class="w-5 h-5"></iconify-icon>
                                </a>
                                <a href="#" class="text-red-600 hover:text-red-800">
                                    <iconify-icon icon="mdi:delete" class="w-5 h-5"></iconify-icon>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-3 px-4 text-center text-gray-500">No users found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection
