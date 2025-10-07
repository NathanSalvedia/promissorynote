@extends('layouts.layout')
@section('title', 'SPC Promissorynote')

@section('content')

<header class="w-full">
    {{-- ✅ Top black strip --}}
    <div class="bg-black text-white text-[11px] md:text-xs py-0.5">
        <div class="max-w-7xl mx-auto px-4">
            <div class="marquee">
                <span>DATA-DRIVEN PROMISSORY NOTE MANAGEMENT SYSTEM WITH INTEGRATED NOTIFICATION AND ANALYTICS SOLUTION</span>
            </div>
        </div>
    </div>

    {{-- ✅ Maroon strip --}}
    <div class="bg-[#660809] text-white py-1"></div>

    {{-- ✅ Navbar --}}
    <div class="bg-white shadow">
        <div class="max-w-10xl mx-auto grid grid-cols-[auto_1fr_auto] items-center gap-4 md:gap-8 px-5 py-1.5">
            <div class="flex items-center gap-2 md:gap-3">
                <img src="/img/spc-wordmark.png" alt="SPC Wordmark" class="h-12 md:h-16 object-contain">
            </div>

            <nav class="hidden md:flex items-center gap-5 font-semibold text-[12px]"></nav>

            <a href="{{ route('auth.login') }}"
               class="justify-self-end bg-[#660809] text-white px-3 py-1.5 rounded-md shadow hover:bg-black flex items-center gap-1 text-[12px]">
                <iconify-icon icon="mdi:login" class="text-sm"></iconify-icon>
                Login
            </a>
        </div>
    </div>
</header>

{{-- ✅ Hero Section --}}
<div class="relative min-h-[calc(100vh-120px)]">
    {{-- Background image --}}
    <img src="{{ asset('img/background.jpg') }}" 
        alt="Background" 
        class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/60"></div>

    {{-- ✅ Popup Cards Container (moved down a bit) --}}
    <div class="relative z-10 flex justify-end h-full pr-8">
        <div id="popup-cards" 
             class="opacity-0 translate-x-10 transition-all duration-1000 ease-out flex flex-col gap-5 max-w-sm w-full sm:w-[350px] mt-24 mb-10">

            {{-- Student Portal Card --}}
            <a href="#"
               class="block bg-white/15 text-white backdrop-blur-lg p-6 rounded-2xl shadow-2xl border border-white/20
                      hover:bg-white/25 hover:scale-[1.03] transition duration-300 ease-in-out group">
                <div class="flex items-start gap-4">
                    <iconify-icon icon="mdi:school-outline" class="text-4xl text-white/90 group-hover:text-yellow-300 transition"></iconify-icon>
                    <div>
                        <h3 class="font-extrabold text-lg">Student Portal</h3>
                        <p class="text-sm opacity-80 mt-1">Submit promissory notes, track status, and manage payments.</p>
                    </div>
                </div>
            </a>

            {{-- Admin Dashboard Card --}}
            <a href="#"
               class="block bg-white/15 text-white backdrop-blur-lg p-6 rounded-2xl shadow-2xl border border-white/20
                      hover:bg-white/25 hover:scale-[1.03] transition duration-300 ease-in-out group">
                <div class="flex items-start gap-4">
                    <iconify-icon icon="mdi:shield-account-outline" class="text-4xl text-white/90 group-hover:text-yellow-300 transition"></iconify-icon>
                    <div>
                        <h3 class="font-extrabold text-lg">Admin Dashboard</h3>
                        <p class="text-sm opacity-80 mt-1">Manage records, approve requests, and handle user accounts.</p>
                    </div>
                </div>
            </a>

            {{-- Analytics & Reports Card --}}
            <a href="#"
               class="block bg-white/15 text-white backdrop-blur-lg p-6 rounded-2xl shadow-2xl border border-white/20
                      hover:bg-white/25 hover:scale-[1.03] transition duration-300 ease-in-out group">
                <div class="flex items-start gap-4">
                    <iconify-icon icon="mdi:chart-line" class="text-4xl text-white/90 group-hover:text-yellow-300 transition"></iconify-icon>
                    <div>
                        <h3 class="font-extrabold text-lg">Analytics & Reports</h3>
                        <p class="text-sm opacity-80 mt-1">Track trends, demographics, and generate reports.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

{{-- ✅ Animation Script --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cards = document.getElementById('popup-cards');
        setTimeout(() => {
            cards.classList.remove('opacity-0', 'translate-x-10');
            cards.classList.add('opacity-100', 'translate-x-0');
        }, 500);
    });
</script>

@endsection
