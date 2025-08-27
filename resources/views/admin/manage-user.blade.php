@extends('layouts.layout')

@section('content')

<div class="bg-white rounded-xl shadow p-8 max-w-4xl mx-auto mt-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">User Management</h2>
        <div class="flex gap-3">
            <button class="bg-red-700 text-white px-5 py-2 rounded-lg flex items-center gap-2 hover:bg-red-800">
                <span class="font-bold text-lg">+</span> Add User
            </button>
            <a href="{{ route('admin.dashboard')}}" class="ml-2 text-gray-600 hover:text-gray-900 flex items-center">
                <iconify-icon icon="mdi:arrow-left" class="w-6 h-6"></iconify-icon>
                <span class="ml-1">Back</span>
            </a>
        </div>
     </div>

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
                <tr class="border-b">
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
@endsection
