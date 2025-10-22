@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">

    <!-- Fixed Header -->
    <header class="fixed top-0 left-0 w-full z-50 shadow">
        @include('includes.header')
    </header>

    <!-- Main content -->
    <main class="p-6 max-w-5xl mx-auto w-full mt-28">
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('student.dashboard') }}"
           class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
            <iconify-icon icon="mdi:arrow-left"></iconify-icon>
            Back to Dashboard
        </a>
    </div>

        <!-- Card -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-6">Submit New Promissory Note</h2>


            <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-900 px-6 py-3 mb-8 rounded-lg font-semibold">
                NOTE: Please ensure that the form is filled out completely.
            </div>

            <form id="promissoryForm"
                  action="{{ route('promissorynotes.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="space-y-6"
                  data-check-status-url="{{ route('promissorynote.checkStatus') }}">
                @csrf

             <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


             <div>
                <label for="course" class="@error('course') text-red-600 @enderror block text-sm font-medium mb-1">Course</label>
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
                    <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
             </div>


              <div>
               <label class="block text-sm font-medium mb-1">Department</label>
                <select name="department" class=" block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('department') @enderror">
                 <option value="" disabled {{ old('department') ? '' : 'selected' }}>Select your college</option>
                 <option value="College of Arts and Sciences" {{ old('department') == 'College of Arts and Sciences' ? 'selected' : '' }}>College of Arts and Sciences</option>
                 <option value="College of Engineering" {{ old('department') == 'College of Engineering' ? 'selected' : '' }}>College of Engineering</option>
                 <option value="College of Business Administration" {{ old('department') == 'College of Business Administration' ? 'selected' : '' }}>College of Business Administration</option>
                 <option value="College of Education" {{ old('department') == 'College of Education' ? 'selected' : '' }}>College of Education</option>
                 <option value="College of Computer Studies" {{ old('department') == 'College of Computer Studies' ? 'selected' : '' }}>College of Computer Studies</option>
                 <option value="College of Criminology" {{ old('department') == 'College of Criminology' ? 'selected' : '' }}>College of Criminology</option>
               </select>
               @error('department')
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
              <label class="block text-sm font-medium mb-1">Semester</label>
              <select name="semester" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('semester') @enderror">
                  <option value="">Select Semester</option>
                  <option value="1st Semester" {{ old('semester') == '1st Semester' ? 'selected' : '' }}>1st Semester</option>
                  <option value="2nd Semester" {{ old('semester') == '2nd Semester' ? 'selected' : '' }}>2nd Semester</option>
                  <option value="Summer" {{ old('semester') == 'Summer' ? 'selected' : '' }}>Summer</option>
              </select>
              @error('semester')
                  <span class="text-red-600 text-xs">{{ $message }}</span>
              @enderror
             </div>


             <div>
              <label class="block text-sm font-medium mb-1">Term</label>
              <select name="term" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('term') @enderror">
                  <option value="">Select Term</option>
                  <option value="Prelim" {{ old('term') == 'Prelim' ? 'selected' : '' }}>Prelim</option>
                  <option value="Midterm" {{ old('term') == 'Midterm' ? 'selected' : '' }}>Midterm</option>
                   <option value="Pre-Finals" {{ old('term') == 'Pre-Finals' ? 'selected' : '' }}>Pre-Finals</option>
                  <option value="Finals" {{ old('term') == 'Finals' ? 'selected' : '' }}>Finals</option>
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
               min="0" step="any"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('down_payment') @enderror"
                oninput="this.value = this.value < 0 ? 0 : this.value;">
              @error('down_payment')
                <span class="text-red-600 text-xs">{{ $message }}</span>
              @enderror
             </div>

               <div>
              <label class="block text-sm font-medium mb-1">Payment Due Date</label>
              <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('due_date') @enderror">
              @error('due_date')
                <span class="text-red-600 text-xs">{{ $message }}</span>
              @enderror
             </div>
             </div>

             <!-- Place supporting documents and signature side by side -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div>
                 <label class="block text-sm font-medium mb-1">Upload Supporting Documents</label>
                 <input type="file" name="attachments[]" multiple accept="image/*"
                 class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('attachments.*') @enderror">
                <p class="text-xs text-gray-500 mt-1">Attach ID, proof of hardship, etc.</p>
              @error('attachments.*')
                <span class="text-red-600 text-xs">{{ $message }}</span>
             @enderror
            </div>


    <div class="bg-gray-50 rounded-xl shadow-inner p-6 mb-4">
    <label class="block text-base font-semibold text-gray-700 mb-3">Electronic Signature</label>
    <div class="flex flex-col md:flex-row gap-6 items-start">

        <div class="flex flex-col items-center w-full md:w-auto">
            <canvas id="signature-pad" width="400" height="150"
                class="border-2 border-dashed border-gray-300 rounded-lg bg-white shadow-sm transition focus:ring-2 focus:ring-[#660809]"></canvas>
            <input type="hidden" name="signature" id="signature">
            <button type="button" onclick="clearSignature()"
                class="mt-3 px-4 py-1.5 bg-[#660809] hover:bg-black text-white rounded-lg text-sm font-medium shadow transition">
                Clear Signature
            </button>
                 @error('signature_image')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>


    </div>
    @error('signature')
        <span class="text-red-600 text-xs mt-2 block">{{ $message }}</span>
    @enderror
    <p class="text-xs text-gray-400 mt-4">Draw your signature above or upload an image. This will serve as your electronic signature for this application.</p>
 </div>
 </div>
 <div class="pt-4">
        <button type="button" onclick="reviewApplication()"
                class="bg-[#660809] hover:bg-[#000000] text-white px-6 py-2 rounded-lg shadow ">
            Review Application
        </button>
    </div>
</div>
</form>
</div>
</main>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let canvas = document.getElementById('signature-pad');
    let signatureInput = document.getElementById('signature');
    if (!canvas) return;
    let ctx = canvas.getContext('2d');
    let drawing = false;

    function getPosition(e) {
        let rect = canvas.getBoundingClientRect();
        if (e.touches) {
            return {
                x: e.touches[0].clientX - rect.left,
                y: e.touches[0].clientY - rect.top
            };
        } else {
            return {
                x: e.clientX - rect.left,
                y: e.clientY - rect.top
            };
        }
    }

    canvas.addEventListener('mousedown', function(e) {
        drawing = true;
        let pos = getPosition(e);
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
    });

    canvas.addEventListener('mouseup', function(e) {
        drawing = false;
        signatureInput.value = canvas.toDataURL();
    });

    canvas.addEventListener('mousemove', function(e) {
        if (!drawing) return;
        let pos = getPosition(e);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
    });

    canvas.addEventListener('mouseout', function(e) {
        drawing = false;
    });


    canvas.addEventListener('touchstart', function(e) {
        drawing = true;
        let pos = getPosition(e);
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
    });

    canvas.addEventListener('touchend', function(e) {
        drawing = false;
        signatureInput.value = canvas.toDataURL();
    });

    canvas.addEventListener('touchmove', function(e) {
        if (!drawing) return;
        let pos = getPosition(e);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
        e.preventDefault();
    });

    canvas.addEventListener('touchcancel', function(e) {
        drawing = false;
    });

    window.clearSignature = function() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        signatureInput.value = '';
    }

    document.getElementById('promissoryForm').addEventListener('submit', function() {
        signatureInput.value = canvas.toDataURL();
    });
});
</script>
@endsection





