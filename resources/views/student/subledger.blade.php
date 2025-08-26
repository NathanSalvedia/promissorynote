
@extends('layouts.layout')

@section('content')
<div class="bg-gradient-to-b from-gray-200 to-gray-100 min-h-screen py-2">
	<div class="max-w-5xl mx-auto p-4">
		<div class="flex items-center justify-between mb-4">
			<h2 class="text-2xl font-bold text-gray-800">Account Subledger</h2>
			<a href="{{ route('student.dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded shadow">&laquo; Back</a>
		</div>
		<div class="overflow-x-auto">
			<table class="min-w-full border border-gray-300 rounded-lg shadow">
				<thead>
					<tr class="bg-gray-400 text-white">
						<th class="px-4 py-2 text-left">School Year</th>
						<th class="px-4 py-2 text-left">Sem</th>
						<th class="px-4 py-2 text-left">Date</th>
						<th class="px-4 py-2 text-left">Reference</th>
						<th class="px-4 py-2 text-left">Debit</th>
						<th class="px-4 py-2 text-left">Credit</th>
						<th class="px-4 py-2 text-left">Balance</th>
					</tr>
				</thead>
				<tbody>

					<tr class="bg-green-200 font-bold">
						<td colspan="7" class="px-4 py-2">SY: 2021-2022 SEM: 2</td>
					</tr>
					<tr class="bg-white">
						<td class="px-4 py-2">2021-2022</td>
						<td class="px-4 py-2">2</td>
						<td class="px-4 py-2">2022-02-16</td>
						<td class="px-4 py-2">Billing</td>
						<td class="px-4 py-2">15352.48</td>
						<td class="px-4 py-2">0.00</td>
						<td class="px-4 py-2">15352.48</td>
					</tr>
					<tr class="bg-gray-100">
						<td class="px-4 py-2">2021-2022</td>
						<td class="px-4 py-2">2</td>
						<td class="px-4 py-2">2022-01-27</td>
						<td class="px-4 py-2">655111</td>
						<td class="px-4 py-2">0.00</td>
						<td class="px-4 py-2">600.00</td>
						<td class="px-4 py-2">14752.48</td>
					</tr>
					<tr class="bg-white">
						<td class="px-4 py-2">2021-2022</td>
						<td class="px-4 py-2">2</td>
						<td class="px-4 py-2">2022-08-17</td>
						<td class="px-4 py-2">677122</td>
						<td class="px-4 py-2">0.00</td>
						<td class="px-4 py-2">5000.00</td>
						<td class="px-4 py-2">9752.48</td>
					</tr>
					<tr class="bg-green-200 font-bold">
						<td colspan="7" class="px-4 py-2">SY: 2022-2023 SEM: 1</td>
					</tr>
					<tr class="bg-white">
						<td class="px-4 py-2">2022-2023</td>
						<td class="px-4 py-2">1</td>
						<td class="px-4 py-2">2023-06-05</td>
						<td class="px-4 py-2">Billing</td>
						<td class="px-4 py-2">12346.45</td>
						<td class="px-4 py-2">0.00</td>
						<td class="px-4 py-2">22098.93</td>
					</tr>
					<tr class="bg-gray-100">
						<td class="px-4 py-2">2022-2023</td>
						<td class="px-4 py-2">1</td>
						<td class="px-4 py-2">2022-08-17</td>
						<td class="px-4 py-2">677123</td>
						<td class="px-4 py-2">0.00</td>
						<td class="px-4 py-2">2000.00</td>
						<td class="px-4 py-2">20098.93</td>
					</tr>
					<tr class="bg-white">
						<td class="px-4 py-2">2022-2023</td>
						<td class="px-4 py-2">1</td>
						<td class="px-4 py-2">2022-12-27</td>
						<td class="px-4 py-2">706848</td>
						<td class="px-4 py-2">0.00</td>
						<td class="px-4 py-2">19893.10</td>
						<td class="px-4 py-2">205.83</td>
					</tr>

                    <tr class="bg-green-200 font-bold">
						<td colspan="7" class="px-4 py-2">SY: 2025-2026 SEM: 1</td>
					</tr>

                    <tr class="bg-white">
						<td class="px-4 py-2">2025-2026</td>
						<td class="px-4 py-2">1</td>
						<td class="px-4 py-2">2025-08-18</td>
						<td class="px-4 py-2">Billing</td>
						<td class="px-4 py-2">22744.07</td>
						<td class="px-4 py-2">0.00</td>
						<td class="px-4 py-2">30659.12</td>
					</tr>

                     <tr class="bg-white">
						<td class="px-4 py-2">2025-2026</td>
						<td class="px-4 py-2">1</td>
						<td class="px-4 py-2">2025-08-18</td>
						<td class="px-4 py-2">818556</td>
						<td class="px-4 py-2">0.00</td>
						<td class="px-4 py-2">1000</td>
						<td class="px-4 py-2">29659.12</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
