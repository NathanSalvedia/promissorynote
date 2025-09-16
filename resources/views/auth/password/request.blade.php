@extends('layouts.layout')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Forgot Your Password?</h2>
        <form action="{{ route('password.email')}}" class="space-y-5" method="POST">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email"
                    class="@error('email')  @enderror block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 transition sm:text-sm">
                @error('email')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow transition">
                Send Password Reset Link
            </button>
        </form>
        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline text-sm">Back to Sign In</a>
        </div>
    </div>
</div>

@endsection
