@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 flex">
    {{-- ✅ Main Content --}}
    <div class="flex-1">
        {{-- ✅ Header/Navbar --}}
        <header class="fixed top-0 left-0 right-0 z-50 shadow bg-white">
            @include('includes.admin')
        </header>

        {{-- ✅ Analytics Page Content --}}
        <main class="p-6 max-w-7xl mx-auto w-full mt-24">
            <h2 class="text-3xl font-extrabold mb-10 text-[#660809] tracking-tight">
                Analytics Dashboard
            </h2>

            {{-- ========== SECTION 1: Promissory Notes ========== --}}
            <section class="mb-16">
                <h3 class="text-xl font-semibold mb-6 text-[#660809] uppercase tracking-wide">
                    I. Promissory Notes
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white/80 backdrop-blur-lg p-6 rounded-2xl shadow-lg border border-gray-200 hover:shadow-2xl transition-all duration-300">
                        <h4 class="font-semibold mb-3 text-gray-700">Status Distribution</h4>
                        <div id="statusChart"></div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-lg p-6 rounded-2xl shadow-lg border border-gray-200 hover:shadow-2xl transition-all duration-300">
                        <h4 class="font-semibold mb-3 text-gray-700">Monthly Submission Trends</h4>
                        <div id="monthlyChart"></div>
                    </div>
                </div>
            </section>

            {{-- ========== SECTION 2: Student Demographics ========== --}}
            <section class="mb-16">
                <h3 class="text-xl font-semibold mb-6 text-[#660809] uppercase tracking-wide">
                    II. Student Demographics
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white/80 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="font-semibold text-gray-700">Department Analysis</h4>
                            <button id="toggleDept" class="text-sm text-[#660809] hover:underline">Switch View</button>
                        </div>
                        <div id="departmentChart"></div>
                    </div>

                    <div class="bg-white/80 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200">
                        <h4 class="font-semibold mb-3 text-gray-700">Gender Distribution</h4>
                        <div id="genderChart"></div>
                    </div>

                    <div class="bg-white/80 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200">
                        <h4 class="font-semibold mb-3 text-gray-700">Year Level Distribution</h4>
                        <div id="yearLevelChart"></div>
                    </div>
                </div>
            </section>

            {{-- ========== SECTION 3: Downpayment Tracking ========== --}}
            <section class="mb-16">
                <h3 class="text-xl font-semibold mb-6 text-[#660809] uppercase tracking-wide">
                    III. Downpayment Tracking
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white/80 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200">
                        <h4 class="font-semibold mb-3 text-gray-700">Payment Progress</h4>
                        <div id="paymentChart"></div>
                    </div>

                    <div class="bg-white/80 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200">
                        <h4 class="font-semibold mb-3 text-gray-700">Amount Distribution</h4>
                        <div id="amountChart"></div>
                    </div>
                </div>
            </section>

            {{-- ========== SECTION 4: Reason for Promissory Note ========== --}}
            <section class="mb-16">
                <h3 class="text-xl font-semibold mb-6 text-[#660809] uppercase tracking-wide">
                    IV. Reason for Promissory Note
                </h3>
                <div class="bg-white/80 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200">
                    <h4 class="font-semibold mb-3 text-gray-700">Reason Categories</h4>
                    <div id="reasonChart"></div>
                </div>
            </section>

            {{-- ========== SECTION 5: Linguistic Analysis ========== --}}
            <section class="mb-20">
                <h3 class="text-xl font-semibold mb-6 text-[#660809] uppercase tracking-wide">
                    V. Linguistic Analysis
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- 🔠 Keyword Frequency Chart --}}
                    <div class="bg-white/80 p-6 rounded-2xl shadow-lg border border-gray-200 hover:shadow-2xl transition-all duration-300">
                        <h4 class="font-semibold mb-3 text-gray-700">Top Keywords in Promissory Notes</h4>
                        <div id="keywordChart"></div>
                    </div>

                    {{-- 🧠 Sentiment & Category Analysis --}}
                    <div class="bg-white/80 p-6 rounded-2xl shadow-lg border border-gray-200 hover:shadow-2xl transition-all duration-300">
                        <h4 class="font-semibold mb-3 text-gray-700">Categorized Reasons (by Linguistic Analysis)</h4>
                        <div id="linguisticCategoryChart"></div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    // 🌈 GLOBAL THEME SETTINGS
    Apex = {
        chart: { foreColor: '#374151', fontFamily: 'Inter, sans-serif', toolbar: { show: false } },
        grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
        tooltip: { theme: 'light' },
        legend: { fontSize: '13px', labels: { colors: '#374151' } },
    };

    const baseAnimation = { enabled: true, easing: 'easeinout', speed: 800 };

    // ✅ 1. Status Chart
    new ApexCharts(document.querySelector("#statusChart"), {
        chart: { type: 'donut', height: 300, animations: baseAnimation },
        series: [32, 180, 33],
        labels: ['Pending', 'Approved', 'Rejected'],
        colors: ['#FACC15', '#22C55E', '#EF4444'],
        legend: { position: 'bottom' }
    }).render();

    // ✅ 2. Monthly Submissions
    new ApexCharts(document.querySelector("#monthlyChart"), {
        chart: { type: 'area', height: 300, animations: baseAnimation },
        series: [
            { name: 'Submissions', data: [20, 35, 50, 40, 60, 70, 90, 85] },
            { name: 'Approvals', data: [10, 30, 40, 35, 50, 60, 80, 70] }
        ],
        xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'] },
        colors: ['#660809', '#16A34A'],
        stroke: { curve: 'smooth', width: 3 },
        fill: { type: 'gradient', gradient: { opacityFrom: 0.8, opacityTo: 0.3 } },
        legend: { position: 'bottom' }
    }).render();

    // ✅ 3. Department Chart
    let deptType = 'count';
    const deptData = { count: [80, 60, 55, 50], amount: [20000, 15000, 17000, 12000] };
    const deptChart = new ApexCharts(document.querySelector("#departmentChart"), {
        chart: { type: 'bar', height: 300, animations: baseAnimation },
        series: [{ name: 'Applications', data: deptData.count }],
        xaxis: { categories: ['BSIT', 'BSBA', 'BEED', 'BSED'] },
        colors: ['#660809']
    });
    deptChart.render();
    document.getElementById('toggleDept').addEventListener('click', () => {
        deptType = deptType === 'count' ? 'amount' : 'count';
        deptChart.updateOptions({
            series: [{ name: deptType === 'count' ? 'Applications' : 'Total Amount (₱)', data: deptData[deptType] }]
        });
    });

    // ✅ 4. Gender Chart
    new ApexCharts(document.querySelector("#genderChart"), {
        chart: { type: 'donut', height: 300 },
        series: [120, 160],
        labels: ['Male', 'Female'],
        colors: ['#3B82F6', '#EC4899']
    }).render();

    // ✅ 5. Year Level
    new ApexCharts(document.querySelector("#yearLevelChart"), {
        chart: { type: 'bar', height: 320 },
        series: [{ name: 'Students', data: [60, 80, 90, 50] }],
        xaxis: { categories: ['1st Year', '2nd Year', '3rd Year', '4th Year'] },
        colors: ['#660809']
    }).render();

    // ✅ 6. Reason Chart
    new ApexCharts(document.querySelector("#reasonChart"), {
        chart: { type: 'donut', height: 300 },
        series: [100, 70, 40, 35],
        labels: ['Tuition', 'Misc Fees', 'Project Expenses', 'Others'],
        colors: ['#660809', '#EA580C', '#EAB308', '#84CC16']
    }).render();

    // ✅ 7. Payment Progress
    new ApexCharts(document.querySelector("#paymentChart"), {
        chart: { type: 'radialBar', height: 320 },
        series: [75],
        labels: ['Completion'],
        colors: ['#660809']
    }).render();

    // ✅ 8. Amount Distribution
    new ApexCharts(document.querySelector("#amountChart"), {
        chart: { type: 'bar', height: 300 },
        series: [{ name: 'Applications', data: [30, 100, 80, 35] }],
        xaxis: { categories: ['₱0–₱1k', '₱1k–₱5k', '₱5k–₱10k', '₱10k+'] },
        colors: ['#660809']
    }).render();

    // ✅ 9. Linguistic Keyword Frequency
    new ApexCharts(document.querySelector("#keywordChart"), {
        chart: { type: 'bar', height: 300 },
        series: [{ name: 'Frequency', data: [45, 38, 30, 27, 22] }],
        xaxis: { categories: ['Tuition', 'Delay', 'Payment', 'Assistance', 'Project'] },
        colors: ['#660809'],
        plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } }
    }).render();

    // ✅ 10. Linguistic Categorization
    new ApexCharts(document.querySelector("#linguisticCategoryChart"), {
        chart: { type: 'pie', height: 300 },
        series: [40, 25, 20, 15],
        labels: ['Financial Difficulty', 'Academic Expense', 'Personal Reason', 'Others'],
        colors: ['#660809', '#EA580C', '#EAB308', '#84CC16']
    }).render();

});
</script>
@endpush
