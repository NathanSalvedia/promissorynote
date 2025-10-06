@extends('layouts.layout')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100 bg-cover bg-center bg-fixed relative" 
    style="background-image: url('{{ asset('img/background.jpg') }}');">

    {{-- ✅ Dark overlay --}}
    <div class="absolute inset-0 bg-black opacity-60"></div>

    {{-- ✅ Login Card --}}
    <div class="relative z-10 bg-white/10 rounded-2xl shadow-2xl p-8 sm:p-10 w-full max-w-md text-center backdrop-blur-md border border-white/20">

        {{-- ✅ Logo --}}
        <img src="{{ asset('img/logo.jpg') }}" 
            alt="School Logo"
            class="mx-auto mb-5 w-20 h-20 rounded-full border-4 border-white shadow-lg">

        {{-- ✅ Title & Subtitle --}}
        <h2 class="text-3xl font-extrabold text-white mb-1 tracking-tight">Sign In</h2>
        <p class="text-gray-200 text-sm mb-8">Access your Promissory Note Portal</p>

        {{-- ✅ FORM --}}
        <form id="loginForm" action="{{ route('login') }}" method="POST" class="space-y-6 text-left w-full max-w-sm mx-auto px-4">
            @csrf

            {{-- Email Field --}}
            <div class="flex items-center border border-white/40 rounded-lg bg-transparent focus-within:ring-2 focus-within:ring-[#660809]">
                <iconify-icon icon="mdi:email-outline" class="text-white/70 text-xl ml-3"></iconify-icon>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    placeholder="Email Address"
                    class="w-full px-3 py-3 bg-transparent text-white placeholder-gray-300 focus:outline-none rounded-lg" />
            </div>
            @error('email')
                <span class="text-red-300 text-xs mt-1 block">{{ $message }}</span>
            @enderror

            {{-- Password Field --}}
            <div class="flex items-center border border-white/40 rounded-lg bg-transparent focus-within:ring-2 focus-within:ring-[#660809]">
                <iconify-icon icon="mdi:lock-outline" class="text-white/70 text-xl ml-3"></iconify-icon>
                <input type="password" id="password" name="password" required
                    placeholder="Password"
                    class="w-full px-3 py-3 bg-transparent text-white placeholder-gray-300 focus:outline-none rounded-lg" />
            </div>
            @error('password')
                <span class="text-red-300 text-xs mt-1 block">{{ $message }}</span>
            @enderror

            {{-- Sign In Button --}}
            <button type="submit"
                class="bg-[#660809] hover:bg-black text-white font-bold py-3 px-6 rounded-xl w-full transition-all duration-300 shadow-lg shadow-[#660809]/60 transform hover:scale-[1.03]">
                Sign In
            </button>
        </form>

        {{-- ✅ Footer Links --}}
        <div class="border-t border-white/20 mt-8 pt-6 space-y-3 text-sm">
            <p class="text-gray-100">
                No account yet? 
                <a href="{{ route('register') }}" class="text-white font-semibold hover:text-gray-300 hover:underline transition">
                    Sign Up here.
                </a>
            </p>

            <p class="text-gray-300">
                Forgot Password? Email
                <a href="mailto:spcportal@spc.edu.ph" class="text-white hover:text-gray-300 hover:underline transition">
                    spcportal@spc.edu.ph
                </a>
            </p>
        </div>
    </div>

    {{-- ✅ Loading Screen Overlay --}}
    <div id="loadingScreen" class="hidden fixed inset-0 bg-black bg-opacity-80 flex flex-col items-center justify-center z-50">
        <img src="{{ asset('img/logo.jpg') }}" class="w-24 h-24 mb-6 animate-pulse rounded-full border-4 border-white">
        <div class="loader border-t-4 border-white rounded-full w-12 h-12 animate-spin mb-3"></div>
        <p class="text-white text-lg font-semibold animate-pulse">Signing in...</p>
    </div>

</div>

<footer class="text-center py-4 bg-white shadow-inner border-t border-gray-200 text-sm text-gray-500">
   <p>&copy; {{ date('Y') }} My.SPC · St. Peter’s College, Inc.</p>
</footer>

{{-- ✅ Script --}}
<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Stop default form submission
    const loading = document.getElementById('loadingScreen');
    loading.classList.remove('hidden'); // Show the loader

    // Wait a bit before submitting (simulate loading)
    setTimeout(() => {
        this.submit();
    }, 2000); // 2 seconds
});
</script>

{{-- ✅ Spinner Style --}}
<style>
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.animate-spin {
    animation: spin 1s linear infinite;
}
</style>
@endsection
