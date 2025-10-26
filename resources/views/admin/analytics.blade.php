@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-white flex">
    <div class="flex-1">
        <header class="fixed top-0 left-0 right-0 z-50 shadow bg-white">
            @include('includes.admin')
        </header>
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
                {{-- Row with Year Level (left) and Payment Progress (right) --}}
                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-xl shadow border">
                        <h4 class="font-semibold mb-3">Year Level Distribution</h4>
                        <div id="yearLevelChart"></div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow border">
                        <h4 class="font-semibold mb-3">Payment Progress</h4>
                        <div id="paymentChart"></div>
                    </div>
                </div>
            </div>

            {{-- ========== SECTION 3: Downpayment Tracking & Reason for Promissory Note ========== --}}
            <h3 class="text-xl font-semibold mb-4 text-[#660809]">III. Partial Downpayment Tracking / Downpayment Tracking</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                {{-- Partial Payment --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Partial Payment</h4>
                    <div id="downpaymentamountChart"></div>
                </div>
                {{-- Down Payment --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Down Payment</h4>
                    <div id="partialamountChart"></div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                {{-- Reason for Promissory Note --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h3 class="text-xl font-semibold mb-4 text-[#660809]">IV. Reason for Promissory Note</h3>
                    <h4 class="font-semibold mb-3">Reason Categories</h4>
                    <div id="reasonChart"></div>
                </div>
                {{-- Other Reasons --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h3 class="text-xl font-semibold mb-4 text-[#660809]">IV. Other Reasons</h3>
                    <h4 class="font-semibold mb-3">Other Reasons Chart</h4>
                    <div id="otherReasonChart"></div>
                </div>
            </div>

            {{-- ========== SECTION 4: College Courses & Promissory Note Trend Analysis ========== --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                {{-- College Courses --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h3 class="text-xl font-semibold mb-4 text-[#660809]">IV. College Courses</h3>
                    <h4 class="font-semibold mb-3">Courses Distribution</h4>
                    <div id="collegeCourseChart"></div>
                </div>
                {{-- Per Academic Term --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h3 class="text-xl font-semibold mb-4 text-[#660809]">IV. Promissory Note Trend Analysis</h3>
                    <h4 class="font-semibold mb-3">Per Academic Term</h4>
                    <div id="termChart"></div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                {{-- Semester Trend --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Per Semester</h4>
                    <div id="semesterChart"></div>
                </div>
                {{-- Academic Year Trend --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Per Academic Year</h4>
                    <div id="acadYearChart"></div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@section('scripts')
<script>
window.analyticsData = {!! json_encode($analyticsData, JSON_HEX_TAG) !!};
</script>
@endsection
