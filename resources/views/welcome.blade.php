@extends('layouts.layout')

@section('content')

 <div class="min-h-screen bg-gray-100 flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#000000] hover:underline hover:text-green-700">My.SPC</h1>
            <p class="text-md text-[#000000]">Promissory Note Management System</p>
        </div>
        <a href="{{ route('auth.login') }}"
           class="bg-[#660809] text-white px-4 py-2 rounded-lg shadow hover:bg-[#000000] flex items-center gap-2">
            <iconify-icon icon="mdi:login" class="text-xl"></iconify-icon>
            Login
        </a>
    </header>


    <main class="flex flex-col items-center justify-center py-6 px-6">
        <div class=" p-3 rounded-full mb-3">
            <img src="/img/logo.jpg" alt="Logo" class="w-24 h-24 rounded-full mx-auto">
        </div>

        <h2 class="text-3xl font-bold text-[#000000] mb-2 hover:underline hover:text-green-700">Welcome to My.SPC</h2>
        <p class="text-[#000000] text-lg mb-10">Data-Driven Promissory Note Management System</p>

        <!-- Feature Cards -->
        <div class="grid md:grid-cols-3 gap-6 w-full max-w-5xl">

            <!-- Student Portal -->
            <div class="bg-[#660809] text-white rounded-xl p-6 shadow-lg hover:scale-105 transition">
                <div class="flex justify-center mb-4">
                    <iconify-icon icon="mdi:school-outline" class="text-4xl"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-2">Student Portal</h3>
                <p class="text-sm mb-4">Submit promissory notes, track status, and manage payments</p>
                <a href="#" class="text-sm underline">Click to learn more →</a>
            </div>

            <!-- Admin Dashboard -->
            <div class="bg-[#660809] text-white rounded-xl p-6 shadow-lg hover:scale-105 transition">
                <div class="flex justify-center mb-4">
                    <iconify-icon icon="mdi:shield-account-outline" class="text-4xl"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-2">Admin Dashboard</h3>
                <p class="text-sm mb-4">Manage records, approve requests, and handle user accounts</p>
                <a href="#" class="text-sm underline">Click to learn more →</a>
            </div>

            <!-- Analytics & Reports -->
            <div class="bg-[#660809] text-white rounded-xl p-6 shadow-lg hover:scale-105 transition">
                <div class="flex justify-center mb-4">
                    <iconify-icon icon="mdi:chart-line" class="text-4xl"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-2">Analytics & Reports</h3>
                <p class="text-sm mb-4">Track trends, demographics, and generate comprehensive reports</p>
                <a href="#" class="text-sm underline">Click to learn more →</a>
            </div>

        </div>
    </main>

</div>




@endsection
