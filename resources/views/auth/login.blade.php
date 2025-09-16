@extends('layouts.layout')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
   <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md text-center">

      <!-- Logo -->
      <img src="{{ asset('img/logo.jpg') }}" alt="Logo" 
           class="mx-auto mb-4 w-24 h-24 rounded-full shadow-md">

      <!-- Title with Icon -->
      <h2 class="text-2xl font-extrabold flex items-center justify-center gap-2 mb-2 text-gray-800">
         <i class="fas fa-file-signature text-maroon-700"></i>
         <span class="text-maroon-700">Promissory Note</span>
      </h2>
      <p class="text-gray-500 text-sm mb-6">» Sign In</p>

      <!-- Form -->
      <form action="{{ route('login')}}" method="POST" class="space-y-4 text-left">
         @csrf

         <!-- Email -->
         <div>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
               placeholder="Email"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                      focus:outline-none focus:ring-maroon-700 focus:border-maroon-700 sm:text-sm">
            @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
         </div>

         <!-- Password -->
         <div>
            <input type="password" id="password" name="password"
               placeholder="Password"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                      focus:outline-none focus:ring-maroon-700 focus:border-maroon-700 sm:text-sm">
            @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
         </div>

         <!-- Submit Button -->
         <button type="submit"
            class="bg-[#800000] hover:bg-black text-white font-bold py-3 px-6 rounded-lg w-full transition">
            Sign In
         </button>
      </form>

      <!-- Divider -->
      <div class="border-t border-gray-300 my-6"></div>

      <!-- Links -->
      <p class="text-sm text-left">
         No account yet?
         <a href="{{ route('register')}}" class="text-maroon-700 hover:underline">Sign Up here.</a>
      </p>
      <p class="text-sm mt-2 text-left">
         Forgot Password? Email
         <a href="mailto:spcportal@spc.edu.ph" class="text-maroon-700 hover:underline">spcportal@spc.edu.ph</a>
      </p>
   </div>
</div>

<!-- Footer -->
<footer class="mt-6 text-center text-sm text-gray-600">
   <a href="#" class="text-maroon-700 hover:underline">My.SPC</a> ·
   <a href="#" class="text-maroon-700 hover:underline">St. Peter’s College, Inc.</a>
</footer>
@endsection
