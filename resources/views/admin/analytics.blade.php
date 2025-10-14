@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-white flex">

    {{-- ✅ Main Content --}}
    <div class="flex-1">

        {{-- ✅ Header/Navbar --}}
        <header class="fixed top-0 left-0 right-0 z-50 shadow bg-white">
            @include('includes.admin')
        </header>

        {{-- ✅ Analytics Page Content --}}
        <main class="p-6 w-full mt-24">

            <h2 class="text-2xl font-bold mb-8 text-[#660809]">Analytics Dashboard</h2>

            {{-- ========== SECTION 1: Promissory Notes ========== --}}
            <h3 class="text-xl font-semibold mb-4 text-[#660809]">I. Promissory Notes</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                {{-- Status Distribution --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Status Distribution</h4>
                    <div id="statusChart"></div>
                </div>

                {{-- Monthly Trends --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Monthly Submission Trends</h4>
                    <div id="monthlyChart"></div>
                </div>
            </div>

            {{-- ========== SECTION 2: Student Demographics ========== --}}
            <h3 class="text-xl font-semibold mb-4 text-[#660809]">II. Student Demographics</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                {{-- Department Analysis --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="font-semibold">Department Analysis</h4>
                        <button id="toggleDept" class="text-sm text-[#660809] hover:underline">Switch View</button>
                    </div>
                    <div id="departmentChart"></div>
                </div>

                {{-- Gender Distribution --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Gender Distribution</h4>
                    <div id="genderChart"></div>
                </div>

                {{-- Year Level Distribution --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Year Level Distribution</h4>
                    <div id="yearLevelChart"></div>
                </div>
            </div>

            {{-- ========== SECTION 3: Downpayment Tracking ========== --}}
            <h3 class="text-xl font-semibold mb-4 text-[#660809]">III. Downpayment Tracking</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                {{-- Payment Progress --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Payment Progress</h4>
                    <div id="paymentChart"></div>
                </div>

                {{-- Amount Distribution --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Amount Distribution</h4>
                    <div id="amountChart"></div>
                </div>
            </div>

            {{-- ========== SECTION 4: Reason for Promissory Note ========== --}}
            <h3 class="text-xl font-semibold mb-4 text-[#660809]">IV. Reason for Promissory Note</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Reason Categories</h4>
                    <div id="reasonChart"></div>
                </div>
            </div>

        </main>
    </div>
</div>
@endsection

@section('scripts')
<script>
    window.analyticsData = {!! json_encode($analyticsData, JSON_HEX_TAG) !!};
    // quick debug in browser console: window.analyticsData
</script>
@endsection



