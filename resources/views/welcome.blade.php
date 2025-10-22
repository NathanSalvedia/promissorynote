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
        <div class="max-w-10xl mx-auto flex flex-col md:grid md:grid-cols-[auto_1fr_auto] items-center gap-2 md:gap-8 px-3 sm:px-5 py-1.5">
            <div class="flex items-center gap-2 md:gap-3">
                <img src="/img/spc-wordmark.png" alt="SPC Wordmark" class="h-10 sm:h-12 md:h-16 object-contain">
            </div>

            <nav class="hidden md:flex items-center gap-5 font-semibold text-xs"></nav>

            {{-- ✅ Login button --}}
            <a href="{{ route('auth.login') }}"
               id="login-btn"
               class="mt-2 md:mt-0 bg-[#660809] text-white px-3 py-1.5 rounded-md shadow hover:bg-black flex items-center gap-1 text-xs relative z-30">
                <iconify-icon icon="mdi:login" class="text-sm"></iconify-icon>
                Login
            </a>
        </div>
    </div>
</header>

{{-- ✅ Hero Section --}}
<div class="relative min-h-[calc(100vh-120px)] overflow-hidden">

    {{-- ✅ Slideshow --}}
    <div id="slideshow" class="absolute inset-0 w-full h-full z-0">
        <img src="{{ asset('img/background1.jpg') }}" class="slide active" alt="Slide 1">
        <img src="{{ asset('img/background2.jpg') }}" class="slide" alt="Slide 2">
        <img src="{{ asset('img/background3.jpg') }}" class="slide" alt="Slide 3">
    </div>

    {{-- ✅ Overlay --}}
    <div class="absolute inset-0 bg-black/60 z-10"></div>

    {{-- ✅ Popup Cards --}}
    <div class="relative z-20 flex justify-end sm:pr-8 h-full">
        <div id="popup-cards"
             class="opacity-0 translate-x-10 transition-all duration-1000 ease-out flex flex-col gap-5 w-full max-w-xs sm:max-w-sm md:w-[350px] mt-10 sm:mt-24 mb-6 sm:mb-10 mx-2 sm:mx-0">

            {{-- Student Portal --}}
            <a href="#"
               class="block bg-white/15 text-white backdrop-blur-lg p-6 rounded-2xl shadow-2xl border border-white/20
                      hover:bg-white/25 hover:scale-[1.03] transition duration-300 ease-in-out group">
                <div class="flex items-start gap-4">
                    <iconify-icon icon="mdi:school-outline" class="text-4xl text-white/90 group-hover:text-[#660809] transition"></iconify-icon>
                    <div>
                        <h3 class="font-extrabold text-lg">Student Portal</h3>
                        <p class="text-sm opacity-80 mt-1">Submit promissory notes, track status, and manage payments.</p>
                    </div>
                </div>
            </a>

            {{-- Admin Dashboard --}}
            <a href="#"
               class="block bg-white/15 text-white backdrop-blur-lg p-6 rounded-2xl shadow-2xl border border-white/20
                      hover:bg-white/25 hover:scale-[1.03] transition duration-300 ease-in-out group">
                <div class="flex items-start gap-4">
                    <iconify-icon icon="mdi:shield-account-outline" class="text-4xl text-white/90 group-hover:text-[#660809] transition"></iconify-icon>
                    <div>
                        <h3 class="font-extrabold text-lg">Admin Dashboard</h3>
                        <p class="text-sm opacity-80 mt-1">Manage records, approve requests, and handle user accounts.</p>
                    </div>
                </div>
            </a>

            {{-- Analytics & Reports --}}
            <a href="#"
               class="block bg-white/15 text-white backdrop-blur-lg p-6 rounded-2xl shadow-2xl border border-white/20
                      hover:bg-white/25 hover:scale-[1.03] transition duration-300 ease-in-out group">
                <div class="flex items-start gap-4">
                    <iconify-icon icon="mdi:chart-line" class="text-4xl text-white/90 group-hover:text-[#660809] transition"></iconify-icon>
                    <div>
                        <h3 class="font-extrabold text-lg">Analytics & Reports</h3>
                        <p class="text-sm opacity-80 mt-1">Track trends, demographics, and generate reports.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- ✅ Dots --}}
    <div id="dots" class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-3 z-20">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
</div>

{{-- ✅ Transparent Loading Box with SPC Logo --}}
<div id="loading-overlay" class="fixed inset-0 bg-black/40 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-500 z-50">
    <div class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-8 py-6 rounded-2xl shadow-2xl flex flex-col items-center animate-fadeIn">
        <img src="/img/logo.png" alt="SPC Logo" class="spc-logo mb-3 w-28 animate-bounce">
        <p class="text-[#660809] font-semibold text-sm tracking-wide animate-pulse">Loading...</p>
    </div>
</div>

<script>
window.addEventListener('load', () => {
    const cards = document.getElementById('popup-cards');
    setTimeout(() => {
        cards.classList.remove('opacity-0', 'translate-x-10');
        cards.classList.add('opacity-100', 'translate-x-0');
    }, 500);

    const slides = document.querySelectorAll('#slideshow .slide');
    const dots = document.querySelectorAll('#dots .dot');
    let index = 0;

    function showSlide(i) {
        slides.forEach((slide, idx) => {
            slide.classList.toggle('active', idx === i);
            dots[idx].classList.toggle('active', idx === i);
        });
    }

    setInterval(() => {
        index = (index + 1) % slides.length;
        showSlide(index);
    }, 5000);

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            index = i;
            showSlide(index);
        });
    });

    // ✅ Login SPC Logo Loading Animation
    const loginBtn = document.getElementById('login-btn');
    const overlay = document.getElementById('loading-overlay');
    loginBtn.addEventListener('click', (e) => {
        e.preventDefault();
        overlay.classList.remove('opacity-0', 'pointer-events-none');
        overlay.classList.add('opacity-100');

        setTimeout(() => {
            window.location.href = loginBtn.getAttribute('href');
        }, 2000);
    });
});
</script>

<style>
#slideshow {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}
#slideshow .slide {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    opacity: 0;
    transform: scale(1);
    transition: opacity 1.5s ease-in-out, transform 6s ease-in-out;
}
#slideshow .slide.active {
    opacity: 1;
    transform: scale(1.08);
}

/* ✅ Dots */
#dots .dot {
    width: 10px;
    height: 10px;
    border-radius: 9999px;
    background-color: rgba(255,255,255,0.4);
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
}
#dots .dot.active {
    background-color: #660809;
    transform: scale(1.3);
}
#dots .dot:hover {
    background-color: black;
}

/* ✅ SPC Logo Animation */
.spc-logo {
    animation: floatLogo 1.5s ease-in-out infinite;
}
@keyframes floatLogo {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}

/* ✅ Fade In */
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
.animate-fadeIn {
    animation: fadeIn 0.4s ease-out;
}

@media (max-width: 640px) {
    #popup-cards {
        margin-top: 2rem !important;
        margin-bottom: 2rem !important;
    }
}
</style>

@endsection
