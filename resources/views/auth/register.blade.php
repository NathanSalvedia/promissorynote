@extends('layouts.layout')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100 px-2">
    <div class="bg-gray-100 p-4 sm:p-10 rounded-xl shadow-lg w-full max-w-4xl"> {{-- Changed max-w-lg to max-w-4xl for wider form --}}
        <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Register</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <input type="hidden" name="role" value="student">

            <div class="mb-6">
                <label for="fullname" class="block text-md font-medium text-black mb-1">Full Name</label>
                <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" class="@error('fullname') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                @error('fullname')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block text-md font-medium text-black mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="phone_number" class="block text-md font-medium text-black mb-1">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" class="@error('phone_number') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm" required>
                        @error('phone_number')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label for="course" class="@error('course')  @enderror block text-md font-medium text-black mb-1">Course</label>
                    <select id="course"
                        name="course"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('course') @enderror">
                        <option value="" disabled {{ old('course') ? '' : 'selected' }}>Select your course</option>
                        <option value="BS Computer Science" {{ old('course') == 'BS Computer Science' ? 'selected' : '' }}>BS Computer Science</option>
                        <option value="BS Information Technology" {{ old('course') == 'BS Information Technology' ? 'selected' : '' }}>BS Information Technology</option>
                        <option value="BS Civil Engineering" {{ old('course') == 'BS Civil Engineering' ? 'selected' : '' }}>BS Civil Engineering</option>
                        <option value="BS Electrical Engineering" {{ old('course') == 'BS Electrical Engineering' ? 'selected' : '' }}>BS Electrical Engineering</option>
                        <option value="BS Mechanical Engineering" {{ old('course') == 'BS Mechanical Engineering' ? 'selected' : '' }}>BS Mechanical Engineering</option>
                        <option value="BS Electronics Engineering" {{ old('course') == 'BS Electronics Engineering' ? 'selected' : '' }}>BS Electronics Engineering</option>
                        <option value="BS Computer Engineering" {{ old('course') == 'BS Computer Engineering' ? 'selected' : '' }}>BS Computer Engineering</option>
                        <option value="BS Business Administration - Major in Marketing Management" {{ old('course') == 'BS Business Administration - Major in Marketing Management' ? 'selected' : '' }}>BS Business Administration - Major in Marketing Management</option>
                        <option value="BS Business Administration - Major in Operation Management" {{ old('course') == 'BS Business Administration - Major in Operation Management' ? 'selected' : '' }}>BS Business Administration - Major in Operation Management</option>
                        <option value="BS Business Administration - Major in Financial Management" {{ old('course') == 'BS Business Administration - Major in Financial Management' ? 'selected' : '' }}>BS Business Administration - Major in Financial Management</option>
                        <option value="BS Business Administration - Major in Human Resource Management" {{ old('course') == 'BS Business Administration - Major in Human Resource Management' ? 'selected' : '' }}>BS Business Administration - Major in Human Resource Management</option>
                        <option value="BS Elementary Education" {{ old('course') == 'BS Elementary Education' ? 'selected' : '' }}>BS Elementary Education</option>
                        <option value="BS Secondary Education - Major in English" {{ old('course') == 'BS Secondary Education - Major in English' ? 'selected' : '' }}>BS Secondary Education - Major in English</option>
                        <option value="BS Secondary Education - Major in Filipino" {{ old('course') == 'BS Secondary Education - Major in Filipino' ? 'selected' : '' }}>BS Secondary Education - Major in Filipino</option>
                        <option value="BS Secondary Education - Major in Math" {{ old('course') == 'BS Secondary Education - Major in Math' ? 'selected' : '' }}>BS Secondary Education - Major in Math</option>
                        <option value="BA of Arts in English Language" {{ old('course') == 'BA of Arts in English Language' ? 'selected' : '' }}>BA of Arts in English Language</option>
                        <option value="BA  Political Science" {{ old('course') == 'BA  Political Science' ? 'selected' : '' }}>BA  Political Science</option>
                        <option value="BA  Filipino" {{ old('course') == 'BA  Filipino' ? 'selected' : '' }}>BA  Filipino</option>
                    </select>
                    @error('course')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="student_id" class="block text-md font-medium text-black mb-1">Student ID</label>
                    <input type="text" id="student_id" name="student_id" value="{{ old('student_id') }}" class="@error('student_id') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                    @error('student_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="year" class="block text-md font-medium text-black mb-1">Year</label>
                    <select id="year" name="year" class="@error('year') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                        <option value="" disabled {{ old('year') ? '' : 'selected' }}>Select your year</option>
                        <option value="1" {{ old('year') == '1' ? 'selected' : '' }}>1st Year</option>
                        <option value="2" {{ old('year') == '2' ? 'selected' : '' }}>2nd Year</option>
                        <option value="3" {{ old('year') == '3' ? 'selected' : '' }}>3rd Year</option>
                        <option value="4" {{ old('year') == '4' ? 'selected' : '' }}>4th Year</option>
                    </select>
                    @error('year')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="college" class="block text-md font-medium text-black mb-1">College</label>
                    <select id="college" name="college" class="@error('college') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                        <option value="" disabled {{ old('college') ? '' : 'selected' }}>Select your college</option>
                        <option value="college of Arts and Sciences" {{ old('college') == 'college of Arts and Sciences' ? 'selected' : '' }}>College of Arts and Sciences</option>
                        <option value="college of Engineering" {{ old('college') == 'college of Engineering' ? 'selected' : '' }}>College of Engineering</option>
                        <option value="college of Business Administration" {{ old('college') == 'college of Business Administration' ? 'selected' : '' }}>College of Business Administration</option>
                        <option value="college of Education" {{ old('college') == 'college of Education' ? 'selected' : '' }}>College of Education</option>
                        <option value="college of Computer Studies" {{ old('college') == 'college of Computer Studies' ? 'selected' : '' }}>College of Computer Studies</option>
                        <option value="college of Criminology" {{ old('college') == 'college of Criminology' ? 'selected' : '' }}>College of Criminology</option>
                    </select>
                    @error('college')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="gender" class="block text-md font-medium text-black mb-1">Gender</label>
                    <input type="text" id="gender" name="gender" class="@error('gender') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                    @error('gender')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-md font-medium text-black mb-1">Password</label>
                <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="block text-md font-medium text-black mb-1">Password Confirmation</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
            </div>
            <button type="submit" class="w-full bg-[#660809] text-white py-2 px-4 rounded-md hover:bg-[#000000] transition">
                Register
            </button>
        </form>
        <p class="mt-6 text-md text-gray-600 text-center">
            Already have an account? <a href="{{ route('login') }}" class="text-[#660809] hover:underline">Login</a>
        </p>
    </div>
</div>

@endsection
