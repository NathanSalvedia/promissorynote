@extends('layouts.layout')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-300">
    <div class="w-full max-w-md bg-white/90 rounded-2xl shadow-2xl p-8 sm:p-10 backdrop-blur-md border border-gray-200">
        <div class="flex flex-col items-center mb-6">
            <div class="bg-green-100 rounded-full p-3 mb-3">
                <iconify-icon icon="mdi:lock-reset" class="text-green-600 text-3xl"></iconify-icon>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-800 mb-1 tracking-tight">Reset Password</h2>
            <p class="text-green-700 text-md">Enter your email to receive a password reset link.</p>
        </div>
        <form action="{{ route('password.email')}}" class="space-y-6" method="POST">
            @csrf
            <div>
                <label for="email" class="block text-md font-medium text-gray-700 mb-2">Email Address:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="your@gmail.com"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 transition sm:text-base text-gray-800 placeholder-gray-400" autocomplete="email" required>
                @error('email')
                    <span class="text-red-500 text-md mt-2 block">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit"
                class="w-full bg-[#660809] hover:bg-black text-white font-bold py-3 px-6 rounded-xl shadow-lg transition-all duration-200 transform hover:scale-[1.03]">
                Send Password Reset Link
            </button>
        </form>
        <div class="mt-8 text-center">
            <a href="{{ route('login') }}" class="text-green-700 font-semibold hover:text-green-900 hover:underline text-md transition flex items-center justify-center gap-1">
                <iconify-icon icon="mdi:arrow-left" class="text-green-700 text-base"></iconify-icon>
                Back to Sign In
            </a>
        </div>
    </div>
</div>

@endsection
