@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">


    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#660809]">MY.SPC</h1>
            <p class="text-sm text-[#000000]">Promissory Note Management System</p>
        </div>

        <div class="flex items-center gap-6">

            <button class="relative text-[#660809] hover:text-[#000000]" title="Notifications">
                <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
                <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 rounded-full">3</span>
            </button>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-[#660809] hover:text-[#000000] flex items-center gap-1" title="Logout">
                        <iconify-icon icon="mdi:logout" class="text-xl"></iconify-icon>
                        Logout
                    </button>
                </form>

            <div class="flex items-center gap-2">
                <iconify-icon icon="mdi:account-circle" class="text-2xl text-gray-700"></iconify-icon>
                <span class="font-medium">
                    @auth
                        {{ auth()->user()->fullname }}
                    @else
                        Guest
                    @endauth
                </span>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-[#660809] hover:text-[#000000] flex items-center gap-1">
                    <iconify-icon icon="mdi:logout" class="text-xl"></iconify-icon>
                    Logout
                </button>
            </form>
    </header>


    <main class="p-6 max-w-7xl mx-auto w-full">


        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h2 class="text-2xl font-bold">Admin Dashboard</h2>

            <div class="flex gap-3 mt-4 sm:mt-0">

               <a href="{{ route('admin.manage-record') }}"
                       class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#000000] text-white px-4 py-2 rounded-lg shadow"
                       title="Manage promissory note records">
                        <iconify-icon icon="mdi:file-document-edit-outline"></iconify-icon>
                        Manage Records
                    </a>

                <a href="#"
                   class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#000000] text-white px-4 py-2 rounded-lg shadow"
                   title="View analytics and reports">
                    <iconify-icon icon="mdi:chart-line"></iconify-icon>
                    Analytics
                </a>

                <a href="#"
                   class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#000000] text-white px-4 py-2 rounded-lg shadow"
                   title="Manage user accounts">
                    <iconify-icon icon="mdi:account-multiple-outline"></iconify-icon>
                    Manage Users
                </a>

            </div>
        </div>


        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">
            <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:file-document-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Total Notes</p>
                        <p class="text-3xl font-bold">{{ $totalNotes }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:clock-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Pending Review</p>
                        <p class="text-3xl font-bold">{{ $pendingNotes }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Approved</p>
                        <p class="text-3xl font-bold">{{ $approvedNotes }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:close-circle-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Rejected</p>
                        <p class="text-3xl font-bold">{{ $rejectedNotes }}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
