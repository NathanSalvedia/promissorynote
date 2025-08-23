@extends('layouts.layout')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Register</h2>
        <form action="{{ route('register') }}" method="POST">
                @csrf
            <input type="hidden" name="role" value="student">
            <div class="mb-4">
                <label for="fullname" class="block text-md font-medium text-black">Full Name</label>
                <input type="text" id="fullname"  name="fullname" value="{{ old('fullname') }}" class="@error('fullname') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                @error('fullname')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class=" mb-4">
                <label for="email" class="block text-md font-medium text-black">Email</label>
                <input type="email" id="email"  name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

            </div>

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="course" class="block text-md font-medium text-black">Course</label>
                    <input type="text" id="course"  name="course" value="{{ old('course') }}" class="@error('course') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                        @error('course')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                </div>

                <div>
                <label for="student_id" class="block text-md font-medium text-black">Student ID</label>
                <input type="text" id="student_id" name="student_id" value="{{ old('student_id') }}"  class="@error('student_id') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                    @error('student_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                   @enderror
                </div>

                <div>
                    <label for="year" class="block text-md font-medium text-black">Year</label>
                    <select id="year" name="year" value="{{ old('year') }}" class="@error('year') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                            @error('year')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        <option value="" disabled selected>Select your year</option>
                        <option value="1">1st Year</option>
                        <option value="2">2nd Year</option>
                        <option value="3">3rd Year</option>
                        <option value="4">4th Year</option>
                    </select>
                </div>
            </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
         <div>
             <label for="college" class="block text-md font-medium text-black">College</label>
             <select id="college" name="college" value="{{ old('college') }}" class="@error('college') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                 @error('college')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                 @enderror
                 <option value="" disabled selected>Select your college</option>
                 <option value="college of Arts and Sciences">College of Arts and Sciences</option>
                 <option value="college of Engineering">College of Engineering</option>
                 <option value="college of Business Administration">College of Business Administration</option>
                 <option value="college of Education">College of Education</option>
                 <option value="college of Computer Studies">College of Computer Studies</option>
                 <option value="college of Criminology">College of Criminology</option>
             </select>
         </div>
         <div>
             <label for="gender" class="block text-md font-medium text-black">Gender</label>
             <input type="text" id="gender" name="gender" class="@error('gender') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
             @error('gender')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                 @enderror
         </div>

            </div>

            <div class="mb-4">
                <label for="password" class="block text-md font-medium text-black">Password</label>
                <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-md font-medium text-black">Password Confirmation</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
            </div>
            <button type="submit" class="w-full bg-[#660809] text-white py-2 px-4 rounded-md hover:bg-[#000000]">
                Register
            </button>
        </form>
        <p class="mt-4 text-md text-gray-600 text-center">
            Already have an account? <a href="" class="text-[#660809] hover:underline">Login</a>
        </p>
    </div>
</div>

@endsection
