@extends('layouts.layout')

@section('content')

 <div class="min-h-screen bg-gray-100 flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#000000] hover:underline hover:text-green-700">My.SPC</h1>
            <p class="text-md text-[#000000]">Promissory Note Management System</p>
        </div>
        <button onclick="document.getElementById('loginModal').classList.remove('hidden')"
           class="bg-[#660809] text-white px-4 py-2 rounded-lg shadow hover:bg-[#000000] flex items-center gap-2">
            <iconify-icon icon="mdi:login" class="text-xl"></iconify-icon>
            Login
        </button>
    </header>


    <main class="flex flex-col items-center justify-center py-6 px-6">
        <div class=" p-3 rounded-full mb-3">
            <img src="/img/logo.jpg" alt="Logo" class="w-24 h-24 rounded-full mx-auto">
        </div>

        <h2 class="text-3xl font-bold text-[#000000] mb-2 hover:underline hover:text-green-700">Welcome to My.SPC</h2>
        <p class="text-[#000000] text-lg mb-10">Data-Driven Promissory Note Management System</p>

        <!-- Feature Cards -->
        <div class="grid md:grid-cols-3 gap-6 w-full max-w-5xl">

            <!-- Student Portal -->
            <div class="bg-[#660809] text-white rounded-xl p-6 shadow-lg hover:scale-105 transition">
                <div class="flex justify-center mb-4">
                    <iconify-icon icon="mdi:school-outline" class="text-4xl"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-2">Student Portal</h3>
                <p class="text-sm mb-4">Submit promissory notes, track status, and manage payments</p>
                <a href="#" class="text-sm underline">Click to learn more →</a>
            </div>

            <!-- Admin Dashboard -->
            <div class="bg-[#660809] text-white rounded-xl p-6 shadow-lg hover:scale-105 transition">
                <div class="flex justify-center mb-4">
                    <iconify-icon icon="mdi:shield-account-outline" class="text-4xl"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-2">Admin Dashboard</h3>
                <p class="text-sm mb-4">Manage records, approve requests, and handle user accounts</p>
                <a href="#" class="text-sm underline">Click to learn more →</a>
            </div>

            <!-- Analytics & Reports -->
            <div class="bg-[#660809] text-white rounded-xl p-6 shadow-lg hover:scale-105 transition">
                <div class="flex justify-center mb-4">
                    <iconify-icon icon="mdi:chart-line" class="text-4xl"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-2">Analytics & Reports</h3>
                <p class="text-sm mb-4">Track trends, demographics, and generate comprehensive reports</p>
                <a href="#" class="text-sm underline">Click to learn more →</a>
            </div>

        </div>
    </main>

</div>


<!-- LOGIN MODAL -->
<div id="loginModal" class="hidden fixed inset-0 bg-gray-200 flex justify-center items-center z-50">
    <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-8 relative">

        <!-- Close Button -->
        <button onclick="document.getElementById('loginModal').classList.add('hidden')"
            class="absolute top-3 right-3 text-[#660809] hover:text-[#000000]">
            ✖
        </button>
           <img src="/img/logo.jpg" alt="Logo" class="mx-auto mb-4 w-24 h-24 rounded-full">

     <h2 class="text-xl font-bold text-center">
        <span class="text-black hover:underline hover:text-green-700">My.SPC</span> <span class="text-black">» Sign In</span>
     </h2>

     <form action="{{ route('login')}}"  class="mt-6 text-left" method="POST">
        @csrf
      <input type="text" name="email" placeholder="email"
       class="mt-1 mb-3 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">

      <input type="password" name="password" placeholder="Password"
        class="mt-1 mb-3 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">

      <button type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-lg mx-auto block">
        Sign In
      </button>
     </form>

     <div class="border-t border-gray-500 my-6"></div>

     <p class="text-sm text-left">
         No account yet?
         <a href="register.html" class="text-black hover:underline hover:text-green-700">Sign Up here.</a>
     </p>
     <p class="text-sm mt-2 text-left">
         Forgot Password? Email
        <a href="mailto:spcportal@spc.edu.ph" class="text-black hover:underline hover:text-green-700">spcportal@spc.edu.ph</a>
    </p>
  </div>
</div>

@endsection
