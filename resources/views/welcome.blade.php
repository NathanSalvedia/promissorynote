@extends('layouts.layout')
@section('title', 'My.SPC')

@section('content')

{{-- ===== styles (marquee + ribbon) ===== --}}
<style>
  /* marquee */
  .marquee{white-space:nowrap;overflow:hidden;box-sizing:border-box}
  .marquee>span{display:inline-block;padding-left:100%;animation:marquee 16s linear infinite}
  .marquee:hover>span{animation-play-state:paused}
  @keyframes marquee{0%{transform:translateX(0)}100%{transform:translateX(-100%)}}

  /* ribbon left angle */
  .ribbon-clip{clip-path:polygon(12% 0,100% 0,100% 100%,0% 100%)}
</style>

<header class="w-full">
  {{-- Top black strip with scrolling text --}}
  <div class="bg-black text-white text-[11px] md:text-xs py-0.5">
    <div class="max-w-7xl mx-auto px-4">
      <div class="marquee">
        <span>Enroll Now  |  Experience a Modern SPC  |  Welcome to My.SPC</span>
      </div>
    </div>
  </div>

  {{-- Maroon contact strip (thin / optional) --}}
  <div class="bg-[#660809] text-white">
    <div class="max-w-7xl mx-auto flex justify-end items-center px-4 py-1 text-[11px] md:text-xs gap-4 md:gap-6">
      {{-- add contact items here if you want --}}
    </div>
  </div>

  {{-- White nav bar --}}
  <div class="bg-white shadow">
    <div class="max-w-10xl mx-auto grid grid-cols-[auto_1fr_auto] items-center gap-4 md:gap-8 px-5 py-1.5">
      {{-- wordmark image (keep your own image path) --}}
      <div class="flex items-center gap-2 md:gap-3">
        <img src="/img/spc-wordmark.png" alt="SPC Wordmark" class="h-12 md:h-16 object-contain">
      </div>

      {{-- center nav (optional) --}}
      <nav class="hidden md:flex items-center gap-5 font-semibold text-[12px]"></nav>

      {{-- login --}}
      <a href="{{ route('auth.login') }}"
         class="justify-self-end bg-[#660809] text-white px-3 py-1.5 rounded-md shadow hover:bg-black flex items-center gap-1 text-[12px]">
        <iconify-icon icon="mdi:login" class="text-sm"></iconify-icon>
        Login
      </a>
    </div>
  </div>
</header>

{{-- ===== MAIN (video bg + center seal + FIXED RIGHT ribbons) ===== --}}
<div class="relative min-h-[calc(100vh-120px)]">
  {{-- background video --}}
  <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
    <source src="{{ asset('videos/background.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <div class="absolute inset-0 bg-black/50"></div>

  <div class="relative z-10 h-full">
    <main class="h-full">
      <div class="h-full max-w-7xl mx-auto relative flex items-center justify-center px-6">

        {{-- center seal/logo (change path if needed) --}}
        

        <div class="fixed z-20 right-0 top-28 md:top-1/3 w-[320px] max-w-[90vw] pr-3 space-y-3">

          <!-- Student Portal -->
          <a href="#{{-- route('student.portal') --}}"
             class="ribbon-clip bg-[#660809]/90 hover:bg-black text-white tracking-wide
                    flex items-center gap-3 pl-6 pr-5 py-3 shadow-md rounded-l-md
                    transition duration-200">
            <iconify-icon icon="mdi:school-outline" class="text-xl"></iconify-icon>
            <div class="flex flex-col leading-tight">
              <span class="font-bold text-base">Student Portal</span>
              <span class="text-[12px] opacity-80">Submit promissory notes, track status, and manage payments</span>
            </div>
          </a>

          <!-- Admin Dashboard -->
          <a href="#{{-- route('admin.dashboard') --}}"
             class="ribbon-clip bg-[#660809]/90 hover:bg-black text-white tracking-wide
                    flex items-center gap-3 pl-6 pr-5 py-3 shadow-md rounded-l-md
                    transition duration-200">
            <iconify-icon icon="mdi:shield-account-outline" class="text-xl"></iconify-icon>
            <div class="flex flex-col leading-tight">
              <span class="font-bold text-base">Admin Dashboard</span>
              <span class="text-[12px] opacity-80">Manage records, approve requests, and handle user accounts</span>
            </div>
          </a>

          <!-- Analytics & Reports -->
          <a href="#{{-- route('analytics.reports') --}}"
             class="ribbon-clip bg-[#660809]/90 hover:bg-black text-white tracking-wide
                    flex items-center gap-3 pl-6 pr-5 py-3 shadow-md rounded-l-md
                    transition duration-200">
            <iconify-icon icon="mdi:chart-line" class="text-xl"></iconify-icon>
            <div class="flex flex-col leading-tight">
              <span class="font-bold text-base">Analytics & Reports</span>
              <span class="text-[12px] opacity-80">Track trends, demographics, and generate reports</span>
            </div>
          </a>
        </div>

      </div>
    </main>
  </div>
</div>

@endsection
