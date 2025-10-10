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

            <h2 class="text-2xl font-bold mb-6 text-[#660809]">Analytics Overview</h2>

            {{-- ✅ KPI Section --}}
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-10">
                <div class="bg-[#660809] text-white p-6 rounded-xl shadow text-center">
                    <p class="text-sm opacity-80">Total Notes</p>
                    <p class="text-3xl font-bold">245</p>
                    <div class="w-full bg-red-900 h-2 mt-3 rounded-full">
                        <div class="bg-white h-2 rounded-full w-[80%]"></div>
                    </div>
                </div>

                <div class="bg-[#660809] text-white p-6 rounded-xl shadow text-center">
                    <p class="text-sm opacity-80">Pending</p>
                    <p class="text-3xl font-bold">32</p>
                    <div class="w-full bg-red-900 h-2 mt-3 rounded-full">
                        <div class="bg-yellow-400 h-2 rounded-full w-[30%]"></div>
                    </div>
                </div>

                <div class="bg-[#660809] text-white p-6 rounded-xl shadow text-center">
                    <p class="text-sm opacity-80">Approved</p>
                    <p class="text-3xl font-bold">180</p>
                    <div class="w-full bg-red-900 h-2 mt-3 rounded-full">
                        <div class="bg-green-400 h-2 rounded-full w-[70%]"></div>
                    </div>
                </div>

                <div class="bg-[#660809] text-white p-6 rounded-xl shadow text-center">
                    <p class="text-sm opacity-80">Rejected</p>
                    <p class="text-3xl font-bold">33</p>
                    <div class="w-full bg-red-900 h-2 mt-3 rounded-full">
                        <div class="bg-red-400 h-2 rounded-full w-[20%]"></div>
                    </div>
                </div>
            </div>

            {{-- ✅ Chart Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- 📊 1. Status Distribution Pie Chart --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Status Distribution</h3>
                        <button class="text-sm text-[#660809] hover:underline">Refresh</button>
                    </div>
                    <canvas id="statusChart"></canvas>
                </div>

                {{-- 📈 2. Monthly Trends Line Chart --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Monthly Submission Trends</h3>
                        <button class="text-sm text-[#660809] hover:underline">Refresh</button>
                    </div>
                    <canvas id="monthlyChart"></canvas>
                </div>

                {{-- 🏫 3. Department Analysis Bar Chart --}}
                <div class="bg-white p-6 rounded-xl shadow border md:col-span-2">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Department Analysis</h3>
                        <button class="text-sm text-[#660809] hover:underline" id="toggleDept">Switch View</button>
                    </div>
                    <canvas id="departmentChart"></canvas>
                </div>

                {{-- 📋 4. Reason Categories Doughnut Chart --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Reason Categories</h3>
                        <button class="text-sm text-[#660809] hover:underline">Refresh</button>
                    </div>
                    <canvas id="reasonChart"></canvas>
                </div>

                {{-- 💰 5. Payment Progress Chart --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Payment Progress</h3>
                        <button class="text-sm text-[#660809] hover:underline">Refresh</button>
                    </div>
                    <canvas id="paymentChart"></canvas>
                </div>

                {{-- 💸 6. Amount Distribution Histogram --}}
                <div class="bg-white p-6 rounded-xl shadow border md:col-span-2">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Amount Distribution</h3>
                        <button class="text-sm text-[#660809] hover:underline">Refresh</button>
                    </div>
                    <canvas id="amountChart"></canvas>
                </div>

            </div>

        </main>
    </div>
</div>
@endsection

@push('scripts')
{{-- ✅ Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1️⃣ Status Pie Chart
    new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: ['Pending', 'Approved', 'Rejected'],
            datasets: [{
                data: [32, 180, 33],
                backgroundColor: ['#FACC15', '#22C55E', '#EF4444']
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    // 2️⃣ Monthly Trends Line Chart
    new Chart(document.getElementById('monthlyChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
            datasets: [
                { label: 'Submissions', data: [20, 35, 50, 40, 60, 70, 90, 85], borderColor: '#660809', fill: false },
                { label: 'Approvals', data: [10, 30, 40, 35, 50, 60, 80, 70], borderColor: '#22C55E', fill: false }
            ]
        },
        options: { responsive: true, tension: 0.3 }
    });

    // 3️⃣ Department Analysis (switchable)
    let deptType = 'count';
    const deptChartCanvas = document.getElementById('departmentChart');
    const deptChart = new Chart(deptChartCanvas, {
        type: 'bar',
        data: {
            labels: ['BSIT', 'BSBA', 'BEED', 'BSED'],
            datasets: [{
                label: 'Applications',
                data: [80, 60, 55, 50],
                backgroundColor: '#660809'
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
    document.getElementById('toggleDept').addEventListener('click', () => {
        deptType = deptType === 'count' ? 'amount' : 'count';
        deptChart.data.datasets[0].data = deptType === 'count' ? [80, 60, 55, 50] : [20000, 15000, 17000, 12000];
        deptChart.data.datasets[0].label = deptType === 'count' ? 'Applications' : 'Total Amount (₱)';
        deptChart.update();
    });

    // 4️⃣ Reason Categories Doughnut Chart
    new Chart(document.getElementById('reasonChart'), {
        type: 'doughnut',
        data: {
            labels: ['Tuition', 'Misc Fees', 'Project Expenses', 'Others'],
            datasets: [{
                data: [100, 70, 40, 35],
                backgroundColor: ['#DC2626', '#EA580C', '#EAB308', '#84CC16']
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    // 5️⃣ Payment Progress Pie Chart
    new Chart(document.getElementById('paymentChart'), {
        type: 'pie',
        data: {
            labels: ['Fully Paid', 'Partially Paid', 'Unpaid'],
            datasets: [{
                data: [120, 60, 40],
                backgroundColor: ['#16A34A', '#F59E0B', '#DC2626']
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    // 6️⃣ Amount Distribution Histogram
    new Chart(document.getElementById('amountChart'), {
        type: 'bar',
        data: {
            labels: ['₱0–₱1k', '₱1k–₱5k', '₱5k–₱10k', '₱10k+'],
            datasets: [{
                label: 'Number of Applications',
                data: [30, 100, 80, 35],
                backgroundColor: '#991b1b'
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
</script>
@endpush
