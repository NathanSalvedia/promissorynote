@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-50 flex">

    {{-- ✅ Sidebar + Header --}}
    <div class="flex-1">
        <header class="fixed top-0 left-0 right-0 z-50 shadow bg-white">
            @include('includes.admin')
        </header>

        {{-- ✅ Analytics Content --}}
        <main class="p-6 max-w-7xl mx-auto w-full mt-24 space-y-10">

            {{-- 📈 KPI Section --}}
            <section>
                <h2 class="text-2xl font-bold mb-6 text-[#660809]">Analytics Dashboard</h2>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">

                    {{-- Card 1 --}}
                    <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
                        <p class="text-sm text-gray-500 mb-1">Total Applications</p>
                        <h3 class="text-3xl font-bold text-[#660809]">245</h3>
                        <div class="w-full bg-gray-200 h-2 mt-2 rounded">
                            <div class="bg-[#660809] h-2 rounded" style="width: 100%;"></div>
                        </div>
                    </div>

                    {{-- Card 2 --}}
                    <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
                        <p class="text-sm text-gray-500 mb-1">Pending</p>
                        <h3 class="text-3xl font-bold text-yellow-500">32</h3>
                        <div class="w-full bg-gray-200 h-2 mt-2 rounded">
                            <div class="bg-yellow-500 h-2 rounded" style="width: 13%;"></div>
                        </div>
                    </div>

                    {{-- Card 3 --}}
                    <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
                        <p class="text-sm text-gray-500 mb-1">Approved</p>
                        <h3 class="text-3xl font-bold text-green-600">180</h3>
                        <div class="w-full bg-gray-200 h-2 mt-2 rounded">
                            <div class="bg-green-600 h-2 rounded" style="width: 73%;"></div>
                        </div>
                    </div>

                    {{-- Card 4 --}}
                    <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
                        <p class="text-sm text-gray-500 mb-1">Rejected</p>
                        <h3 class="text-3xl font-bold text-red-600">33</h3>
                        <div class="w-full bg-gray-200 h-2 mt-2 rounded">
                            <div class="bg-red-600 h-2 rounded" style="width: 14%;"></div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 📊 Visual Charts --}}
            <section class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Pie Chart: Status Distribution --}}
                <div class="bg-white p-6 rounded-xl shadow relative">
                    <h3 class="text-lg font-semibold mb-3 flex justify-between items-center">
                        Status Distribution
                        <button onclick="refreshChart('statusChart')" class="text-sm text-[#660809] hover:underline">⟳ Refresh</button>
                    </h3>
                    <canvas id="statusChart"></canvas>
                </div>

                {{-- Line Chart: Monthly Trends --}}
                <div class="bg-white p-6 rounded-xl shadow relative">
                    <h3 class="text-lg font-semibold mb-3 flex justify-between items-center">
                        Monthly Trends
                        <button onclick="refreshChart('monthlyChart')" class="text-sm text-[#660809] hover:underline">⟳ Refresh</button>
                    </h3>
                    <canvas id="monthlyChart"></canvas>
                </div>

                {{-- Bar Chart: Department Analysis --}}
                <div class="bg-white p-6 rounded-xl shadow relative md:col-span-2">
                    <h3 class="text-lg font-semibold mb-3 flex justify-between items-center">
                        Department Analysis
                        <button onclick="toggleDeptChart()" class="text-sm text-[#660809] hover:underline">🔁 Toggle View</button>
                    </h3>
                    <canvas id="departmentChart"></canvas>
                </div>

                {{-- Doughnut Chart: Reason Categories --}}
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-lg font-semibold mb-3">Reason Categories</h3>
                    <canvas id="reasonChart"></canvas>
                </div>

                {{-- Payment Progress Chart --}}
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-lg font-semibold mb-3">Payment Progress</h3>
                    <canvas id="paymentChart"></canvas>
                </div>

                {{-- Amount Distribution Histogram --}}
                <div class="bg-white p-6 rounded-xl shadow md:col-span-2">
                    <h3 class="text-lg font-semibold mb-3">Amount Distribution</h3>
                    <canvas id="amountChart"></canvas>
                </div>
            </section>

        </main>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart instances
    let charts = {};

    function createCharts() {
        // 1️⃣ Status Distribution
        charts.statusChart = new Chart(document.getElementById('statusChart'), {
            type: 'pie',
            data: {
                labels: ['Pending', 'Approved', 'Rejected'],
                datasets: [{
                    data: [32, 180, 33],
                    backgroundColor: ['#FACC15', '#22C55E', '#EF4444']
                }]
            },
            options: { plugins: { legend: { position: 'bottom' } } }
        });

        // 2️⃣ Monthly Trends
        charts.monthlyChart = new Chart(document.getElementById('monthlyChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [
                    { label: 'Submissions', data: [15, 25, 30, 50, 40, 60], borderColor: '#660809', tension: 0.3 },
                    { label: 'Approvals', data: [10, 20, 28, 45, 35, 55], borderColor: '#16A34A', tension: 0.3 }
                ]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });

        // 3️⃣ Department Analysis
        charts.departmentChart = new Chart(document.getElementById('departmentChart'), {
            type: 'bar',
            data: {
                labels: ['BSIT', 'BSBA', 'BEED', 'BSED'],
                datasets: [{
                    label: 'Count',
                    data: [80, 60, 55, 50],
                    backgroundColor: '#660809'
                }]
            },
            options: { scales: { y: { beginAtZero: true } }, plugins: { legend: { display: false } } }
        });

        // 4️⃣ Reason Categories
        charts.reasonChart = new Chart(document.getElementById('reasonChart'), {
            type: 'doughnut',
            data: {
                labels: ['Tuition', 'Medical', 'Personal', 'Other'],
                datasets: [{
                    data: [120, 45, 55, 25],
                    backgroundColor: ['#DC2626', '#F87171', '#FCA5A5', '#FEE2E2']
                }]
            },
            options: { plugins: { legend: { position: 'bottom' } } }
        });

        // 5️⃣ Payment Progress
        charts.paymentChart = new Chart(document.getElementById('paymentChart'), {
            type: 'pie',
            data: {
                labels: ['Paid', 'Partial', 'Unpaid'],
                datasets: [{
                    data: [120, 75, 50],
                    backgroundColor: ['#22C55E', '#FACC15', '#EF4444']
                }]
            },
            options: { plugins: { legend: { position: 'bottom' } } }
        });

        // 6️⃣ Amount Distribution
        charts.amountChart = new Chart(document.getElementById('amountChart'), {
            type: 'bar',
            data: {
                labels: ['₱0-1000', '₱1001-3000', '₱3001-5000', '₱5001+'],
                datasets: [{
                    label: 'Applications',
                    data: [40, 80, 70, 55],
                    backgroundColor: '#660809'
                }]
            },
            options: { scales: { y: { beginAtZero: true } }, plugins: { legend: { display: false } } }
        });
    }

    // 🔁 Refresh button function
    function refreshChart(id) {
        if (charts[id]) {
            charts[id].destroy();
            createCharts();
        }
    }

    // 🔁 Toggle Department View (Count ↔ Amount)
    let deptMode = 'count';
    function toggleDeptChart() {
        charts.departmentChart.destroy();
        const newData = deptMode === 'count'
            ? [50000, 42000, 35000, 30000]
            : [80, 60, 55, 50];
        const newLabel = deptMode === 'count' ? 'Amount (₱)' : 'Count';
        deptMode = deptMode === 'count' ? 'amount' : 'count';

        charts.departmentChart = new Chart(document.getElementById('departmentChart'), {
            type: 'bar',
            data: {
                labels: ['BSIT', 'BSBA', 'BEED', 'BSED'],
                datasets: [{
                    label: newLabel,
                    data: newData,
                    backgroundColor: '#660809'
                }]
            },
            options: { scales: { y: { beginAtZero: true } }, plugins: { legend: { display: true, position: 'bottom' } } }
        });
    }

    // Initialize all charts on load
    createCharts();
</script>
@endpush
