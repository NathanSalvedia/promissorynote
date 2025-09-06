@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">

       @include('includes.header')
      <main class="p-6 max-w-5xl mx-auto w-full">

        <div class="mb-4">
            <a href="{{ route('student.dashboard') }}" class="flex items-center gap-2 text-[#660809]  hover:text-[#000000] ">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Back to Dashboard
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-6">Submit New Promissory Note</h2>

         <form  id="promissoryForm" action="{{ route('promissorynotes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" data-check-status-url="{{ route('promissorynote.checkStatus') }}">
              @csrf

             <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

             <div>
             <label class="block text-sm font-medium mb-1">Full Name</label>
             <input type="text" name="fullname" value="{{ old('fullname')}}"
             class="@error('fullname') is-invalid @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
               @error('fullname')
                <span class="text-red-600 text-xs">{{ $message }}</span>
               @enderror
             </div>


             <div>
              <label class="block text-sm font-medium mb-1">Student ID</label>
              <input type="text" name="student_id" value="{{ old('student_id')}}"
              class=" @error('student_id')
                   is-invalid
              @enderror w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
              @error('student_id')
               <span class="text-red-600 text-xs">{{ $message }}</span>
              @enderror
             </div>

             <div>
              <label class="block text-sm font-medium mb-1">Gender</label>
              <select name="gender"  class="@error('gender')
              @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
              <option value="">Select Gender</option>
              <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
              <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
              </select>
               @error('gender')
                <span class="text-red-600 text-xs">{{ $message }}</span>
              @enderror
             </div>

              <div>
                <label for="course" value="{{ old('course')}}" class="@error('course')

                @enderror block text-md font-medium text-black">Course</label>
                <input type="text" id="course" name="course"class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                  @error('course')
                  <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
              </div>

              <div>
               <label class="block text-sm font-medium mb-1">Department</label>
                <select name="department" class=" block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('department') @enderror">
                 <option value="" disabled {{ old('department') ? '' : 'selected' }}>Select your college</option>
                 <option value="college of Arts and Sciences" {{ old('department') == 'college of Arts and Sciences' ? 'selected' : '' }}>College of Arts and Sciences</option>
                 <option value="college of Engineering" {{ old('department') == 'college of Engineering' ? 'selected' : '' }}>College of Engineering</option>
                 <option value="college of Business Administration" {{ old('department') == 'college of Business Administration' ? 'selected' : '' }}>College of Business Administration</option>
                 <option value="college of Education" {{ old('department') == 'college of Education' ? 'selected' : '' }}>College of Education</option>
                 <option value="college of Computer Studies" {{ old('department') == 'college of Computer Studies' ? 'selected' : '' }}>College of Computer Studies</option>
                 <option value="college of Criminology" {{ old('department') == 'college of Criminology' ? 'selected' : '' }}>College of Criminology</option>
               </select>
               @error('department')
                 <span class="text-red-600 text-xs">{{ $message }}</span>
               @enderror
             </div>

              <div>
              <label class="block text-sm font-medium mb-1">Phone Number</label>
              <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+63 912 345 6789"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('phone') @enderror">
              @error('phone')
                <span class="text-red-600 text-xs">{{ $message }}</span>
              @enderror
              </div>

               <div>
               <label class="block text-sm font-medium mb-1">Year Level</label>
               <select name="year_level" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('year_level') @enderror">
                <option value="">Select Year</option>
                <option value="1st Year" {{ old('year_level') == '1st Year' ? 'selected' : '' }}>1st Year</option>
                <option value="2nd Year" {{ old('year_level') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                <option value="3rd Year" {{ old('year_level') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                <option value="4th Year" {{ old('year_level') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                </select>
                @error('year_level')
                  <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
              </div>


              <div>
               <label class="block text-sm font-medium mb-1">Amount (₱)</label>
               <input type="number" name="amount" value="{{ old('amount') }}"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('amount') @enderror">
               @error('amount')
                 <span class="text-red-600 text-xs">{{ $message }}</span>
               @enderror
              </div>


               <div>
              <label class="block text-sm font-medium mb-1">Reason</label>
              <select name="reason" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('reason')  @enderror" onchange="toggleOtherReasonBox(this)">
               <option value="">Select Reason</option>
               <option value="Financial Problem" {{ old('reason') == 'Financial Problem' ? 'selected' : '' }}>Financial Problem</option>
               <option value="Delayed release of salary or allowance" {{ old('reason') == 'Delayed release of salary or allowance' ? 'selected' : '' }}>Delayed release of salary or allowance</option>
               <option value="Other" {{ old('reason') == 'Other' ? 'selected' : '' }}>Other</option>
               </select>
                <div id="otherReasonBox" style="display:{{ old('reason') == 'Other' ? 'block' : 'none' }};" class="mt-2">
                 <label class="block text-sm font-medium mb-1">Please specify other reason</label>
                 <textarea name="other_reason" rows="2" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('other_reason') @enderror">{{ old('other_reason') }}</textarea>
                 @error('other_reason')
                   <span class="text-red-600 text-xs">{{ $message }}</span>
                 @enderror
                </div>
                @error('reason')
                  <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
              </div>


               <div>
              <label class="block text-sm font-medium mb-1">Term</label>
              <select name="term" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('term')  @enderror">
               <option value="">Select Term</option>
               <option value="1st Term" {{ old('term') == '1st Term' ? 'selected' : '' }}>1st Term</option>
               <option value="2nd Term" {{ old('term') == '2nd Term' ? 'selected' : '' }}>2nd Term</option>
              </select>
              @error('term')
                <span class="text-red-600 text-xs">{{ $message }}</span>
              @enderror
             </div>


             <div>
              <label class="block text-sm font-medium mb-1">Academic Year</label>
              <input type="text" name="academic_year" value="{{ old('academic_year') }}"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('academic_year') @enderror">
              @error('academic_year')
                <span class="text-red-600 text-xs">{{ $message }}</span>
              @enderror
             </div>



               <div>
              <label class="block text-sm font-medium mb-1">Down Payment (₱)</label>
              <input type="number" name="down_payment" value="{{ old('down_payment') }}"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('down_payment') @enderror">
              @error('down_payment')
                <span class="text-red-600 text-xs">{{ $message }}</span>
              @enderror
             </div>


               <div>
              <label class="block text-sm font-medium mb-1">Payment Due Date</label>
              <input type="date" name="due_date" value="{{ old('due_date') }}"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('due_date') @enderror">
              @error('due_date')
                <span class="text-red-600 text-xs">{{ $message }}</span>
              @enderror
             </div>
             </div>

             <div>
               <label class="block text-sm font-medium mb-1">Additional Notes</label>
               <textarea name="notes" rows="3"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">{{ old('notes') }}</textarea>
              </div>


            <div>
               <label class="block text-sm font-medium mb-1">Upload Supporting Documents</label>
               <input type="file" name="attachments[]" multiple accept="image/*"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('attachments.*') @enderror">
                <p class="text-xs text-gray-500 mt-1">Attach ID, proof of hardship, etc.</p>
                @error('attachments.*')
                  <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
              </div>


              <div class="grid grid-cols-2 gap-4 mb-4">

                <div class="pt-4">
                    <button type="button" onclick="reviewApplication()"
                            class="bg-[#660809] hover:bg-[#000000] text-white px-6 py-2 rounded-lg shadow ">
                        Review Application
                    </button>
                </div>

               <div class="pt-4 text-right">
                    <button type="submit"
                        class="bg-[#660809]  hover:bg-[#000000]  text-white px-6 py-2 rounded-lg shadow ml-4">
                        Submit Application
                    </button>
                </div>
              </div>
            </form>
        </div>
    </main>
</div>


<!-- Review Modal -->
<div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
        <h3 class="text-lg font-bold mb-4 text-center">Review Your Application</h3>
        <div id="reviewContent"></div>
        <div class="mt-4 flex justify-end gap-2">
            <button onclick="closeReviewModal()" class="bg-[#660809] hover:bg-[#000000] text-white px-4 py-2 rounded">Close</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection



