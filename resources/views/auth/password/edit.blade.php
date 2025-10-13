@extends('layouts.layout')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 via-white to-gray-200">
    <div class="w-full max-w-md bg-white/90 rounded-2xl shadow-2xl p-8 sm:p-10 backdrop-blur-md border border-gray-200">
        <div class="flex flex-col items-center mb-6">
            <div class="bg-blue-100 rounded-full p-3 mb-3">
                <iconify-icon icon="mdi:lock-reset" class="text-blue-600 text-3xl"></iconify-icon>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-800 mb-1 tracking-tight">Create New Password</h2>
            <p class="text-green-700 text-md text-center">Set a strong password for your account.</p>
        </div>
        <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-md font-medium text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" id="email"
                    class="block w-full px-4 py-3 border rounded-xl shadow-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 transition sm:text-base text-gray-800 placeholder-gray-400 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}"
                    value="{{ request()->email }}" autocomplete="email" required placeholder="your@email.com" />
                @error('email')
                    <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-md font-medium text-gray-700 mb-2">New Password</label>
                <input type="password" name="password" id="password"
                    class="block w-full px-4 py-3 border rounded-xl shadow-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 transition sm:text-base text-gray-800 placeholder-gray-400 @error('password') border-red-500 @else border-gray-300 @enderror"
                    autocomplete="new-password" required placeholder="Enter new password" />
                @error('password')
                    <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-md font-medium text-gray-700 mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 transition sm:text-base text-gray-800 placeholder-gray-400"
                    autocomplete="new-password" required placeholder="Confirm new password" />
                <input type="hidden" name="token" value="{{ request()->route('token') }}">
            </div>
            <button type="submit"
                class="w-full bg-[#660809] hover:bg-black text-white font-bold py-3 px-6 rounded-xl shadow-lg transition-all duration-200 transform hover:scale-[1.03]">
                Reset Password
            </button>
        </form>
        <div class="mt-8 text-center">
            <a href="{{ route('login') }}" class="text-green-700  font-semibold hover:text-blue-800 hover:underline text-md transition flex items-center justify-center gap-1">
                <iconify-icon icon="mdi:arrow-left" class="text-green-700 text-base"></iconify-icon>
                Back to Sign In
            </a>
        </div>
    </div>
</div>
@endsection
