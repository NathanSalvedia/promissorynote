@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">

    <header class="fixed top-0 left-0 right-0 z-50 shadow bg-white">
        @include('includes.admin')
    </header>

    <main class="p-6 mt-24 w-full">
        <div class="bg-white rounded-2xl shadow border overflow-hidden">

            <div class="px-6 py-4 bg-[#660809] border-b flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <h2 class="text-xl font-bold text-white">User Management</h2>

                {{-- Back Button --}}
                <a href="{{ route('admin.dashboard')}}"
                    class="inline-flex items-center gap-2 bg-white text-[#660809] hover:bg-gray-100 px-4 py-2 rounded-lg font-semibold shadow transition">
                    <iconify-icon icon="mdi:arrow-left" class="w-5 h-5"></iconify-icon>
                    <span>Back</span>
                </a>
            </div>

            {{-- ✅ Table Section --}}
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
                    <tbody id="user-table">
                        @include('admin.partials.user-table', ['users' => $users])
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</div>
@endsection

@section('scripts')
<script>
function updateUserTable(html) {
    document.getElementById('user-table').innerHTML = html;
}

setInterval(function() {
    fetch('/admin/manage-users-data')
        .then(res => res.text())
        .then(html => {
            updateUserTable(html);
        });
}, 10000);
</script>
@endsection
