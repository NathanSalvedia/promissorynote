@extends('layouts.layout')

@section('content')



  <div class="min-h-screen bg-gray-100 flex flex-col">

    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#660809] ">MY.SPC</h1>
            <p class="text-sm text-[#000000] ">Promissory Note Management System</p>
        </div>

        <div class="flex items-center gap-6">
            <button class="relative text-[#660809] hover:text-[#000000] ">
                <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
                <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 rounded-full">3</span>
            </button>

            <div class="flex items-center gap-2">
                <iconify-icon icon="mdi:account-circle" class="text-2xl text-gray-700"></iconify-icon>
                <span class="font-medium">{{ auth()->user()->fullname }}</span>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-[#660809] hover:text-[#000000] flex items-center gap-1">
                    <iconify-icon icon="mdi:logout" class="text-xl"></iconify-icon>
                    Logout
                </button>
            </form>
        </div>
    </header>


    <main class="p-6 max-w-6xl mx-auto w-full">

        <h2 class="text-xl font-bold mb-4">Student Portal</h2>
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">
            <div class="bg-[#660809]  text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:file-document-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Total Notes</p>
                        <p class="text-3xl font-bold">3</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#660809]  text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:clock-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Pending</p>
                        <p class="text-3xl font-bold">2</p>
                    </div>
                </div>
            </div>


            <div class="bg-[#660809]  text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Approved</p>
                        <p class="text-3xl font-bold">1</p>
                    </div>
                </div>
            </div>


            <div class="bg-[#660809]  text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:currency-php" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Total Amount</p>
                        <p class="text-2xl font-bold">₱15,500</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <a href=""
            class="bg-[#660809]  hover:bg-[#000000]  text-white px-5 py-2 rounded-lg shadow flex items-center gap-2">
                <iconify-icon icon="mdi:plus-circle-outline" class="text-lg"></iconify-icon>
                New Promissory Note
            </a>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">My Promissory Notes</h3>
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border">Note ID</th>
                        <th class="py-2 px-4 border">Amount</th>
                        <th class="py-2 px-4 border">Reason</th>
                        <th class="py-2 px-4 border">Status</th>
                        <th class="py-2 px-4 border">Date</th>
                        <th class="py-2 px-4 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border">PN-2024-001</td>
                        <td class="py-2 px-4 border">₱5,000</td>
                        <td class="py-2 px-4 border">Tuition Fee</td>
                        <td class="py-2 px-4 border text-[#660809] font-semibold">Approved</td>
                        <td class="py-2 px-4 border">2024-01-15</td>
                        <td class="py-2 px-4 border text-[#660809]  cursor-pointer flex items-center gap-1">
                            <iconify-icon icon="mdi:eye-outline"></iconify-icon> View
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">PN-2024-002</td>
                        <td class="py-2 px-4 border">₱3,000</td>
                        <td class="py-2 px-4 border">Laboratory Fee</td>
                        <td class="py-2 px-4 border text-[#000000]  font-semibold">Pending</td>
                        <td class="py-2 px-4 border">2024-01-20</td>
                        <td class="py-2 px-4 border text-[#660809]  cursor-pointer flex items-center gap-1">
                            <iconify-icon icon="mdi:eye-outline"></iconify-icon> View
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">PN-2024-003</td>
                        <td class="py-2 px-4 border">₱7,500</td>
                        <td class="py-2 px-4 border">Tuition Fee</td>
                        <td class="py-2 px-4 border text-[#000000]  font-semibold">Pending</td>
                        <td class="py-2 px-4 border">2024-01-22</td>
                        <td class="py-2 px-4 border text-[#660809]  cursor-pointer flex items-center gap-1">
                            <iconify-icon icon="mdi:eye-outline"></iconify-icon> View
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>




@endsection
