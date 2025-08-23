@extends('layouts.layout')


@section('content')

<div class="min-h-screen bg-gray-100 flex flex-col">

    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#660809] ">MY.SPC</h1>
            <p class="text-sm text-[#000000] ">Promissory Note Management System</p>
        </div>

        <div class="flex items-center gap-6">
            <button class="relative text-[#660809]  hover:text-[#000000] ">
                <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
            </button>
            <div class="flex items-center gap-2">
                <iconify-icon icon="mdi:account-circle" class="text-2xl text-gray-700"></iconify-icon>
                <span class="font-medium">{{ auth()->user()->fullname }}</span>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-[#660809] hover:text-[#000000] flex items-center gap-1">
                    <iconify-icon icon="mdi:logout" class="text-xl"></iconify-icon>
                    Logout
                </button>
            </form>
        </div>
      </header>

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

         <form id="promissoryForm" action="{{ route('promissorynotes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

             <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

             <div>
             <label class="block text-sm font-medium mb-1">Full Name</label>
             <input type="text" name="fullname" value="{{ auth()->user()->fullname }}"
             class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
             </div>


             <div>
              <label class="block text-sm font-medium mb-1">Student ID</label>
              <input type="text" name="student_id" value="{{ auth()->user()->student_id }}"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
             </div>

             <div>
              <label class="block text-sm font-medium mb-1">Gender</label>
              <select name="gender"  class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
              <option value="">Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              </select>
             </div>


              <div>
               <label class="block text-sm font-medium mb-1">Department</label>
               <select name="department" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
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
              <label class="block text-sm font-medium mb-1">Phone Number</label>
              <input type="text" name="phone" placeholder="+63 912 345 6789"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
              </div>

              <div>
               <label class="block text-sm font-medium mb-1">Year Level</label>
               <select name="year_level" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                <option value="">Select Year</option>
                <option value="1st Year">1st Year</option>
                <option value="2nd Year">2nd Year</option>
                <option value="3rd Year">3rd Year</option>
                <option value="4th Year">4th Year</option>
                </select>
              </div>

              <div>
               <label class="block text-sm font-medium mb-1">Amount (₱)</label>
               <input type="number" name="amount" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
              </div>

             <div>
              <label class="block text-sm font-medium mb-1">Reason</label>
              <select name="reason" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
               <option value="">Select Reason</option>
               <option value="Financial Problem">Financial Problem</option>
               <option value="Delayed release of salary or allowance">Delayed release of salary or allowance</option>
               <option value="Other">Other</option>
               </select>
                <div id="otherReasonBox" style="display:none;" class="mt-2">
                 <label class="block text-sm font-medium mb-1">Please specify other reason</label>
                 <textarea name="other_reason" rows="2" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm"></textarea>
                </div>
              </div>

              <div>
              <label class="block text-sm font-medium mb-1">Term</label>
              <select name="term" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
               <option value="">Select Term</option>
               <option value="1st Term">1st Term</option>
               <option value="2nd Term">2nd Term</option>
              </select>
             </div>


             <div>
              <label class="block text-sm font-medium mb-1">Academic Year</label>
              <input type="text" name="academic_year" value=""
               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
             </div>


             <div>
              <label class="block text-sm font-medium mb-1">Down Payment (₱)</label>
              <input type="number" name="down_payment"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
             </div>


             <div>
              <label class="block text-sm font-medium mb-1">Payment Due Date</label>
              <input type="date" name="due_date"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
             </div>
             </div>


              <div>
               <label class="block text-sm font-medium mb-1">Additional Notes</label>
               <textarea name="notes" rows="3"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm"></textarea>
              </div>

              <div>
               <label class="block text-sm font-medium mb-1">Upload Supporting Documents</label>
               <input type="file" name="attachments[]" multiple
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                <p class="text-xs text-gray-500 mt-1">Attach ID, proof of hardship, etc.</p>
              </div>

                <div class="pt-4">
                    <button type="submit"
                        class="bg-[#660809]  hover:bg-[#000000]  text-white px-6 py-2 rounded-lg shadow">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>





@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    var reasonSelect = document.querySelector('select[name="reason"]');
    var otherReasonBox = document.getElementById('otherReasonBox');
    if (reasonSelect && otherReasonBox) {
        reasonSelect.addEventListener('change', function() {
            if (this.value === 'Other') {
                otherReasonBox.style.display = 'block';
            } else {
                otherReasonBox.style.display = 'none';
            }
        });
    }
});
</script>
