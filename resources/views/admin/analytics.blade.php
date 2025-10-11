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
        <main class="p-6 max-w-7xl mx-auto w-full mt-24">

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


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {

    // ✅ Global Chart Animation + Theme
    const baseAnimation = {
        enabled: true,
        easing: 'easeinout',
        speed: 800,
        animateGradually: { enabled: true, delay: 150 },
        dynamicAnimation: { enabled: true, speed: 400 }
    };

    const tooltipTheme = {
        theme: 'light',
        style: { fontSize: '13px' }
    };

    // 1️⃣ Status Distribution (Pie Chart)
    new ApexCharts(document.querySelector("#statusChart"), {
        chart: { type: 'pie', height: 300, animations: baseAnimation },
        series: [32, 180, 33],
        labels: ['Pending', 'Approved', 'Rejected'],
        colors: ['#FACC15', '#22C55E', '#EF4444'],
        legend: { position: 'bottom' },
        tooltip: tooltipTheme
    }).render();

    // 2️⃣ Monthly Trends (Animated Line Chart)
    new ApexCharts(document.querySelector("#monthlyChart"), {
        chart: { type: 'line', height: 300, animations: baseAnimation },
        series: [
            { name: 'Submissions', data: [20, 35, 50, 40, 60, 70, 90, 85] },
            { name: 'Approvals', data: [10, 30, 40, 35, 50, 60, 80, 70] }
        ],
        xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'] },
        colors: ['#660809', '#22C55E'],
        stroke: { curve: 'smooth', width: 3 },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: "vertical",
                gradientToColors: ['#ef4444', '#86efac'],
                opacityFrom: 0.8,
                opacityTo: 0.3,
                stops: [0, 100]
            }
        },
        markers: { size: 4, colors: ['#fff'], strokeColors: ['#660809', '#22C55E'] },
        legend: { position: 'bottom' },
        tooltip: tooltipTheme
    }).render();

    // 3️⃣ Department Analysis (Toggleable Bar Chart)
    let deptType = 'count';
    const deptData = {
        count: [80, 60, 55, 50],
        amount: [20000, 15000, 17000, 12000]
    };
    let deptChart = new ApexCharts(document.querySelector("#departmentChart"), {
        chart: { type: 'bar', height: 300, animations: baseAnimation },
        series: [{ name: 'Applications', data: deptData.count }],
        xaxis: { categories: ['BSIT', 'BSBA', 'BEED', 'BSED'] },
        colors: ['#b91c1c'],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: "vertical",
                gradientToColors: ['#ef4444'],
                opacityFrom: 0.9,
                opacityTo: 1,
                stops: [0, 90, 100]
            }
        },
        plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } },
        legend: { position: 'bottom' },
        tooltip: tooltipTheme
    });
    deptChart.render();

    document.getElementById('toggleDept').addEventListener('click', () => {
        deptType = deptType === 'count' ? 'amount' : 'count';
        deptChart.updateOptions({
            series: [{
                name: deptType === 'count' ? 'Applications' : 'Total Amount (₱)',
                data: deptData[deptType]
            }]
        });
    });

    // 4️⃣ Gender Distribution (Donut Chart)
    new ApexCharts(document.querySelector("#genderChart"), {
        chart: { type: 'donut', height: 300, animations: baseAnimation },
        series: [120, 160],
        labels: ['Male', 'Female'],
        colors: ['#3B82F6', '#EC4899'],
        legend: { position: 'bottom' },
        tooltip: tooltipTheme
    }).render();

    // 5️⃣ Year Level Distribution (Enhanced Vivid Gradient)
    new ApexCharts(document.querySelector("#yearLevelChart"), {
        chart: { 
            type: 'bar', 
            height: 320, 
            animations: baseAnimation,
            toolbar: { show: false }
        },
        series: [{ name: 'Students', data: [60, 80, 90, 50] }],
        xaxis: { 
            categories: ['1st Year', '2nd Year', '3rd Year', '4th Year'],
            labels: { style: { colors: '#4B5563', fontSize: '13px' } }
        },
        yaxis: { labels: { style: { colors: '#4B5563', fontSize: '13px' } } },
        colors: ['#b91c1c'],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: "vertical",
                gradientToColors: ['#ef4444'],
                opacityFrom: 0.95,
                opacityTo: 1,
                stops: [0, 90, 100]
            }
        },
        plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } },
        dataLabels: { enabled: false },
        grid: { borderColor: '#e5e7eb', strokeDashArray: 4 },
        tooltip: tooltipTheme
    }).render();

    // 6️⃣ Reason Categories (Donut Chart)
    new ApexCharts(document.querySelector("#reasonChart"), {
        chart: { type: 'donut', height: 300, animations: baseAnimation },
        series: [100, 70, 40, 35],
        labels: ['Tuition', 'Misc Fees', 'Project Expenses', 'Others'],
        colors: ['#DC2626', '#EA580C', '#EAB308', '#84CC16'],
        legend: { position: 'bottom' },
        tooltip: tooltipTheme
    }).render();

    // 7️⃣ Payment Progress (Pie Chart)
    new ApexCharts(document.querySelector("#paymentChart"), {
        chart: { type: 'pie', height: 300, animations: baseAnimation },
        series: [120, 60, 40],
        labels: ['Fully Paid', 'Partially Paid', 'Unpaid'],
        colors: ['#16A34A', '#F59E0B', '#DC2626'],
        legend: { position: 'bottom' },
        tooltip: tooltipTheme
    }).render();

    // 8️⃣ Amount Distribution (Bar Chart)
    new ApexCharts(document.querySelector("#amountChart"), {
        chart: { type: 'bar', height: 300, animations: baseAnimation },
        series: [{ name: 'Number of Applications', data: [30, 100, 80, 35] }],
        xaxis: { categories: ['₱0–₱1k', '₱1k–₱5k', '₱5k–₱10k', '₱10k+'] },
        colors: ['#b91c1c'],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: "vertical",
                gradientToColors: ['#ef4444'],
                opacityFrom: 0.9,
                opacityTo: 1,
                stops: [0, 90, 100]
            }
        },
        plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } },
        tooltip: tooltipTheme
    }).render();

});
</script>
@endpush
