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
                    <canvas id="statusChart"></canvas>
                </div>

                {{-- Monthly Trends --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Monthly Submission Trends</h4>
                    <canvas id="monthlyChart"></canvas>
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
                    <canvas id="departmentChart"></canvas>
                </div>

                {{-- Gender Distribution --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Gender Distribution</h4>
                    <canvas id="genderChart"></canvas>
                </div>

                {{-- Year Level Distribution --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Year Level Distribution</h4>
                    <canvas id="yearLevelChart"></canvas>
                </div>
            </div>

            {{-- ========== SECTION 3: Downpayment Tracking ========== --}}
            <h3 class="text-xl font-semibold mb-4 text-[#660809]">III. Downpayment Tracking</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                {{-- Payment Progress --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Payment Progress</h4>
                    <canvas id="paymentChart"></canvas>
                </div>

                {{-- Amount Distribution --}}
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Amount Distribution</h4>
                    <canvas id="amountChart"></canvas>
                </div>
            </div>

            {{-- ========== SECTION 4: Reason for Promissory Note ========== --}}
            <h3 class="text-xl font-semibold mb-4 text-[#660809]">IV. Reason for Promissory Note</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <div class="bg-white p-6 rounded-xl shadow border">
                    <h4 class="font-semibold mb-3">Reason Categories</h4>
                    <canvas id="reasonChart"></canvas>
                </div>
            </div>

        </main>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1️⃣ Status Distribution
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

    // 2️⃣ Monthly Trends
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

    // 3️⃣ Department Analysis
    let deptType = 'count';
    const deptChart = new Chart(document.getElementById('departmentChart'), {
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

    // 4️⃣ Gender Distribution
    new Chart(document.getElementById('genderChart'), {
        type: 'pie',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                data: [120, 160],
                backgroundColor: ['#3B82F6', '#EC4899']
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    // 5️⃣ Year Level Distribution
    new Chart(document.getElementById('yearLevelChart'), {
        type: 'bar',
        data: {
            labels: ['1st Year', '2nd Year', '3rd Year', '4th Year'],
            datasets: [{
                label: 'Students',
                data: [60, 80, 90, 50],
                backgroundColor: '#991B1B'
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    // 6️⃣ Reason Categories
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

    // 7️⃣ Payment Progress
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

    // 8️⃣ Amount Distribution
    new Chart(document.getElementById('amountChart'), {
        type: 'bar',
        data: {
            labels: ['₱0–₱1k', '₱1k–₱5k', '₱5k–₱10k', '₱10k+'],
            datasets: [{
                label: 'Number of Applications',
                data: [30, 100, 80, 35],
                backgroundColor: '#991B1B'
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
</script>
@endpush
