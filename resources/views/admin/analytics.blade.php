@extends('layouts.layout')

@section('content')

 @include('includes.header')

 <main class="max-w-7xl mx-auto px-6 pb-10">
        {{-- TOP KPI CARDS (keep yours) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4 mb-6">
            <div class="rounded-2xl shadow bg-[#660809] text-white p-6">
                <div class="flex items-start gap-4">
                    <div class="bg-white/15 rounded-xl p-3">
                        <iconify-icon icon="mdi:calendar-month-outline" class="text-2xl"></iconify-icon>
                    </div>
                    <div class="flex-1">
                        <p class="text-lg font-semibold">This Term</p>
                        <p class="text-4xl font-extrabold mt-1">5</p>
                        <p class="text-sm mt-2 text-white/90">+12% from last term</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl shadow bg-[#660809] text-white p-6">
                <div class="flex items-start gap-4">
                    <div class="bg-white/15 rounded-xl p-3">
                        <iconify-icon icon="mdi:account-group" class="text-2xl"></iconify-icon>
                    </div>
                    <div class="flex-1">
                        <p class="text-lg font-semibold">Active Students</p>
                        <p class="text-4xl font-extrabold mt-1">2</p>
                        <p class="text-sm mt-2 text-white/90">With promissory notes</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl shadow bg-[#660809] text-white p-6">
                <div class="flex items-start gap-4">
                    <div class="bg-white/15 rounded-xl p-3">
                        <iconify-icon icon="mdi:cash-multiple" class="text-2xl"></iconify-icon>
                    </div>
                    <div class="flex-1">
                        <p class="text-lg font-semibold">Total Amount</p>
                        <p class="text-4xl font-extrabold mt-1">₱19,700</p>
                        <p class="text-sm mt-2 text-white/90">Outstanding balance</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl shadow bg-[#660809] text-white p-6">
                <div class="flex items-start gap-4">
                    <div class="bg-white/15 rounded-xl p-3">
                        <iconify-icon icon="mdi:percent-outline" class="text-2xl"></iconify-icon>
                    </div>
                    <div class="flex-1">
                        <p class="text-lg font-semibold">Approval Rate</p>
                        <p class="text-4xl font-extrabold mt-1">75%</p>
                        <p class="text-sm mt-2 text-white/90">Last 30 days</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ====== ANALYTICS GRID (like your screenshot) ====== --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- I. Promissory Notes Analysis --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-xl font-bold mb-4">I. Promissory Notes Analysis</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div class="rounded-xl bg-indigo-50 p-4 text-center">
                        <p class="text-3xl font-extrabold text-indigo-700">5</p>
                        <p class="text-xs text-slate-600 mt-1">Per Term</p>
                    </div>
                    <div class="rounded-xl bg-green-50 p-4 text-center">
                        <p class="text-3xl font-extrabold text-green-700">10</p>
                        <p class="text-xs text-slate-600 mt-1">Per Semester</p>
                    </div>
                    <div class="rounded-xl bg-violet-50 p-4 text-center">
                        <p class="text-3xl font-extrabold text-violet-700">20</p>
                        <p class="text-xs text-slate-600 mt-1">Per Year</p>
                    </div>
                </div>
            </div>

            {{-- II. Student Demographics --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-xl font-bold mb-6">II. Student Demographics</h3>

                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="text-slate-700 font-medium w-48">Gender Distribution</span>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">Male: 45%</span>
                            <span class="px-3 py-1 text-xs rounded-full bg-rose-100 text-rose-700">Female: 55%</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-slate-700 font-medium w-48">Top Department</span>
                        <span class="px-3 py-1 text-xs rounded-full bg-rose-100 text-rose-700">Computer Science</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-slate-700 font-medium w-48">Most Active Year</span>
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">2nd Year</span>
                    </div>
                </div>
            </div>

            {{-- III. Downpayment Tracking --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-xl font-bold mb-4">III. Downpayment Tracking</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between bg-gray-50 rounded-xl px-4 py-3">
                        <span class="text-slate-700">Average Down Payment</span>
                        <span class="font-bold text-emerald-600">52%</span>
                    </div>
                    <div class="flex items-center justify-between bg-gray-50 rounded-xl px-4 py-3">
                        <span class="text-slate-700">Full Payment Rate</span>
                        <span class="font-bold text-blue-600">23%</span>
                    </div>
                    <div class="flex items-center justify-between bg-gray-50 rounded-xl px-4 py-3">
                        <span class="text-slate-700">Partial Payment Rate</span>
                        <span class="font-bold text-orange-600">77%</span>
                    </div>
                    <div class="flex items-center justify-between bg-gray-50 rounded-xl px-4 py-3">
                        <span class="text-slate-700">Compliance Rate</span>
                        <span class="font-bold text-green-600">89%</span>
                    </div>
                </div>
            </div>

            {{-- IV. Reason Analysis --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-xl font-bold mb-4">IV. Reason Analysis</h3>

                <div class="space-y-5">
                    @foreach([
                        ['label'=>'Delayed Remittance','val'=>45,'color'=>'bg-rose-600'],
                        ['label'=>'Family Emergency','val'=>30,'color'=>'bg-orange-500'],
                        ['label'=>'Job Loss/Unemployment','val'=>15,'color'=>'bg-amber-600'],
                        ['label'=>'Others','val'=>10,'color'=>'bg-slate-500'],
                    ] as $row)
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-slate-700">{{ $row['label'] }}</span>
                            <span class="text-slate-600 font-medium">{{ $row['val'] }}%</span>
                        </div>
                        <div class="h-2.5 w-full bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-2.5 {{ $row['color'] }} rounded-full" style="width: {{ $row['val'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- ====== /ANALYTICS GRID ====== --}}
    </main>
</div>

@endsection
