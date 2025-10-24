@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex">

    {{-- ✅ Main Content --}}
    <div class="flex-1">

       {{-- ✅ Header/Navbar (always on top, full width) --}}
        <header class="fixed top-0 left-0 right-0 z-50 shadow bg-white">
            @include('includes.admin')
        </header>

      {{-- ✅ Dashboard Content --}}
<main class="p-6 w-full mt-24">
    <h2 class="text-2xl font-bold mb-6">Admin Dashboard</h2>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">
        <!-- Total Notes -->
        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100">
                <iconify-icon icon="mdi:file-document-outline" class="text-blue-600 text-2xl"></iconify-icon>
            </div>
            <div>
                <p class="text-sm opacity-80">Total Notes</p>
                <p class="text-3xl font-bold">{{ $totalNotes }}</p>
            </div>
        </div>

        <!-- Pending Review -->
        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-yellow-100">
                <iconify-icon icon="mdi:clock-time-four-outline" class="text-yellow-600 text-2xl"></iconify-icon>
            </div>
            <div>
                <p class="text-sm opacity-80">Pending Review</p>
                <p class="text-3xl font-bold">{{ $pendingNotes }}</p>
            </div>
        </div>

        <!-- Approved -->
        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-100">
                <iconify-icon icon="mdi:check-circle-outline" class="text-green-600 text-2xl"></iconify-icon>
            </div>
            <div>
                <p class="text-sm opacity-80">Approved</p>
                <p class="text-3xl font-bold">{{ $approvedNotes }}</p>
            </div>
        </div>

        <!-- Rejected -->
        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100">
                <iconify-icon icon="mdi:close-circle-outline" class="text-red-600 text-2xl"></iconify-icon>
            </div>
            <div>
                <p class="text-sm opacity-80">Rejected</p>
                <p class="text-3xl font-bold">{{ $rejectedNotes }}</p>
            </div>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="bg-white rounded-2xl shadow border overflow-hidden">
    <div class="px-6 py-4 bg-[#660809] border-b flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <h3 class="text-xl font-bold text-[#ffffff]">Pending Requests</h3>

                                         <form method="GET" action="{{ route('admin.dashboard') }}"
                        class="flex flex-col sm:flex-row sm:items-center gap-4  px-4 py-3 rounded-xl">

                        <!-- Search -->
                        <div class="relative flex-1 bg-white rounded-lg">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#660809] focus:border-[#660809] pl-10 pr-4 py-2 text-sm"
                                placeholder="Search by Course">
                            <iconify-icon icon="mdi:magnify"
                                class="absolute left-3 top-7 transform -translate-y-1/2 text-gray-400 text-lg"></iconify-icon>
                        </div>

                        <!-- Department Filter -->
                        <div class="bg-white rounded-lg">
                            <select id="department" name="department"
                                class="text-gray-400 w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#660809] focus:border-[#660809] py-2 px-3 text-sm">
                                <option value="">All Departments</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                                @endforeach
                            </select>
                        </div>


                    </form>

                </div>

                {{-- Table --}}
                <div class="overflow-x-auto" id="pending-requests-table">
                    @include('admin.partials.pending-requests-table', ['notes' => $notes])
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@if($notes->where('is_new', true)->count())
    <script src="{{ asset('js/reuse.js') }}"></script>
@endif

@push('scripts')
<script>
    setInterval(function() {
        fetch("{{ route('admin.dashboard.table') }}?{{ http_build_query(request()->all()) }}")
            .then(response => response.text())
            .then(html => {
                document.getElementById('pending-requests-table').innerHTML = html;
            });
    }, 10000); // every 10 seconds
</script>
@endpush
