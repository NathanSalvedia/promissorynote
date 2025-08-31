@extends('layouts.layout')

@section('content')
@include('includes.header')
 <div class="max-w-5xl mx-auto bg-white rounded-xl shadow p-6 mt-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Payment Tracking</h2>
        <div class="flex gap-2">
            <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold flex items-center gap-2">
                <iconify-icon icon="mdi:plus" class="w-5 h-5"></iconify-icon>
                Record Payment
            </a>
            <a href="{{ route('admin.dashboard')}}" class="text-gray-600 hover:text-gray-900 flex items-center gap-1">
                <iconify-icon icon="mdi:arrow-left" class="w-5 h-5"></iconify-icon>
                Back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-green-50 border-l-4 border-green-400 rounded-lg p-4 flex items-center gap-4">
            <div class="text-green-600">
                <iconify-icon icon="mdi:cash" class="w-8 h-8"></iconify-icon>
            </div>
            <div>
                <div class="text-sm text-gray-500">Total Collected</div>
                <div class="text-2xl font-bold text-green-700">₱245,000</div>
            </div>
        </div>
        <div class="bg-blue-50 border-l-4 border-blue-400 rounded-lg p-4 flex items-center gap-4">
            <div class="text-blue-600">
                <iconify-icon icon="mdi:percent" class="w-8 h-8"></iconify-icon>
            </div>
            <div>
                <div class="text-sm text-gray-500">Avg Down Payment</div>
                <div class="text-2xl font-bold text-blue-700">52%</div>
            </div>
        </div>
        <div class="bg-orange-50 border-l-4 border-orange-400 rounded-lg p-4 flex items-center gap-4">
            <div class="text-orange-600">
                <iconify-icon icon="mdi:clock-outline" class="w-8 h-8"></iconify-icon>
            </div>
            <div>
                <div class="text-sm text-gray-500">Pending Payments</div>
                <div class="text-2xl font-bold text-orange-700">15</div>
            </div>
        </div>
        <div class="bg-red-50 border-l-4 border-red-400 rounded-lg p-4 flex items-center gap-4">
            <div class="text-red-600">
                <iconify-icon icon="mdi:alert" class="w-8 h-8"></iconify-icon>
            </div>
            <div>
                <div class="text-sm text-gray-500">Overdue</div>
                <div class="text-2xl font-bold text-red-700">3</div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 rounded-xl p-4">
        <h3 class="text-lg font-semibold mb-4">Payment Compliance Monitoring</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-2 font-semibold text-left">Note ID</th>
                        <th class="px-4 py-2 font-semibold text-left">Student</th>
                        <th class="px-4 py-2 font-semibold text-left">Total Amount</th>
                        <th class="px-4 py-2 font-semibold text-left">Down Payment</th>
                        <th class="px-4 py-2 font-semibold text-left">Remaining</th>
                        <th class="px-4 py-2 font-semibold text-left">Due Date</th>
                        <th class="px-4 py-2 font-semibold text-left">Status</th>
                        <th class="px-4 py-2 font-semibold text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b">
                        <td class="px-4 py-2">PN-2024-001</td>
                        <td class="px-4 py-2">
                            <span class="font-semibold">John Doe</span>
                            <div class="text-xs text-gray-500">2021-12345</div>
                        </td>
                        <td class="px-4 py-2">₱5,000</td>
                        <td class="px-4 py-2 text-green-600">₱0</td>
                        <td class="px-4 py-2 text-orange-600">₱5,000</td>
                        <td class="px-4 py-2">2024-03-15</td>
                        <td class="px-4 py-2">
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">Overdue</span>
                        </td>
                        <td class="px-4 py-2 flex gap-2">
                            <button class="bg-green-500 hover:bg-green-600 text-white p-2 rounded" title="Record Payment">
                                <iconify-icon icon="mdi:plus" class="w-4 h-4"></iconify-icon>
                            </button>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded" title="View Details">
                                <iconify-icon icon="mdi:history" class="w-4 h-4"></iconify-icon>
                            </button>
                            <button class="bg-red-500 hover:bg-red-600 text-white p-2 rounded" title="Alert">
                                <iconify-icon icon="mdi:alert" class="w-4 h-4"></iconify-icon>
                            </button>
                        </td>
                    </tr>
                    <tr class="bg-white">
                        <td class="px-4 py-2">PN-2024-004</td>
                        <td class="px-4 py-2">
                            <span class="font-semibold">Jane Smith</span>
                            <div class="text-xs text-gray-500">2021-67890</div>
                        </td>
                        <td class="px-4 py-2">₱4,200</td>
                        <td class="px-4 py-2 text-green-600">₱0</td>
                        <td class="px-4 py-2 text-orange-600">₱4,200</td>
                        <td class="px-4 py-2">2024-03-15</td>
                        <td class="px-4 py-2">
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">Overdue</span>
                        </td>
                        <td class="px-4 py-2 flex gap-2">
                            <button class="bg-green-500 hover:bg-green-600 text-white p-2 rounded" title="Record Payment">
                                <iconify-icon icon="mdi:plus" class="w-4 h-4"></iconify-icon>
                            </button>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded" title="View Details">
                                <iconify-icon icon="mdi:history" class="w-4 h-4"></iconify-icon>
                            </button>
                            <button class="bg-red-500 hover:bg-red-600 text-white p-2 rounded" title="Alert">
                                <iconify-icon icon="mdi:alert" class="w-4 h-4"></iconify-icon>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
 @endsection
