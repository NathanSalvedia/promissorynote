@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">

    <!-- Fixed Header -->
    <header class="fixed top-0 left-0 w-full z-50 shadow">
        @include('includes.header')
    </header>

    <!-- Main content -->
    <main class="p-6 max-w-5xl mx-auto w-full mt-24">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('student.dashboard') }}"
               class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Back to Dashboard
            </a>
        </div>
        <!-- Card -->
        <div class="bg-white p-6 rounded-lg shadow">

            <h2 class="text-xl font-bold mb-6">Resubmit Promissory Note</h2>

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

                <input type="hidden" name="parent_pn_id" value="{{ $note->pn_id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label for="course" class="@error('course') text-red-600 @enderror block text-sm font-medium mb-1">Course</label>
                        <select id="course" name="course" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('course') @enderror">
                            <option value="" disabled {{ old('course', $note->course ?? '') == '' ? 'selected' : '' }}>Select your course</option>
                            <option value="BS Computer Science" {{ old('course', $note->course ?? '') == 'BS Computer Science' ? 'selected' : '' }}>BS Computer Science</option>
                            <option value="BS Information Technology" {{ old('course', $note->course ?? '') == 'BS Information Technology' ? 'selected' : '' }}>BS Information Technology</option>
                            <option value="BS Civil Engineering" {{ old('course', $note->course ?? '') == 'BS Civil Engineering' ? 'selected' : '' }}>BS Civil Engineering</option>
                            <option value="BS Electrical Engineering" {{ old('course', $note->course ?? '') == 'BS Electrical Engineering' ? 'selected' : '' }}>BS Electrical Engineering</option>
                            <option value="BS Mechanical Engineering" {{ old('course', $note->course ?? '') == 'BS Mechanical Engineering' ? 'selected' : '' }}>BS Mechanical Engineering</option>
                            <option value="BS Electronics Engineering" {{ old('course', $note->course ?? '') == 'BS Electronics Engineering' ? 'selected' : '' }}>BS Electronics Engineering</option>
                            <option value="BS Computer Engineering" {{ old('course', $note->course ?? '') == 'BS Computer Engineering' ? 'selected' : '' }}>BS Computer Engineering</option>
                            <option value="BS Business Administration - Major in Marketing Management" {{ old('course', $note->course ?? '') == 'BS Business Administration - Major in Marketing Management' ? 'selected' : '' }}>BS Business Administration - Major in Marketing Management</option>
                            <option value="BS Business Administration - Major in Operation Management" {{ old('course', $note->course ?? '') == 'BS Business Administration - Major in Operation Management' ? 'selected' : '' }}>BS Business Administration - Major in Operation Management</option>
                            <option value="BS Business Administration - Major in Financial Management" {{ old('course', $note->course ?? '') == 'BS Business Administration - Major in Financial Management' ? 'selected' : '' }}>BS Business Administration - Major in Financial Management</option>
                            <option value="BS Business Administration - Major in Human Resource Management" {{ old('course', $note->course ?? '') == 'BS Business Administration - Major in Human Resource Management' ? 'selected' : '' }}>BS Business Administration - Major in Human Resource Management</option>
                            <option value="BS Elementary Education" {{ old('course', $note->course ?? '') == 'BS Elementary Education' ? 'selected' : '' }}>BS Elementary Education</option>
                            <option value="BS Secondary Education - Major in English" {{ old('course', $note->course ?? '') == 'BS Secondary Education - Major in English' ? 'selected' : '' }}>BS Secondary Education - Major in English</option>
                            <option value="BS Secondary Education - Major in Filipino" {{ old('course', $note->course ?? '') == 'BS Secondary Education - Major in Filipino' ? 'selected' : '' }}>BS Secondary Education - Major in Filipino</option>
                            <option value="BS Secondary Education - Major in Math" {{ old('course', $note->course ?? '') == 'BS Secondary Education - Major in Math' ? 'selected' : '' }}>BS Secondary Education - Major in Math</option>
                            <option value="BA of Arts in English Language" {{ old('course', $note->course ?? '') == 'BA of Arts in English Language' ? 'selected' : '' }}>BA of Arts in English Language</option>
                            <option value="BA  Political Science" {{ old('course', $note->course ?? '') == 'BA  Political Science' ? 'selected' : '' }}>BA  Political Science</option>
                            <option value="BA  Filipino" {{ old('course', $note->course ?? '') == 'BA  Filipino' ? 'selected' : '' }}>BA  Filipino</option>
                        </select>
                        @error('course')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Department</label>
                        <select name="department" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('department') @enderror">
                            <option value="" disabled {{ old('department', $note->department ?? '') == '' ? 'selected' : '' }}>Select your college</option>
                            <option value="College of Arts and Sciences" {{ old('department', $note->department ?? '') == 'College of Arts and Sciences' ? 'selected' : '' }}>College of Arts and Sciences</option>
                            <option value="College of Engineering" {{ old('department', $note->department ?? '') == 'College of Engineering' ? 'selected' : '' }}>College of Engineering</option>
                            <option value="College of Business Administration" {{ old('department', $note->department ?? '') == 'College of Business Administration' ? 'selected' : '' }}>College of Business Administration</option>
                            <option value="College of Education" {{ old('department', $note->department ?? '') == 'College of Education' ? 'selected' : '' }}>College of Education</option>
                            <option value="College of Computer Studies" {{ old('department', $note->department ?? '') == 'College of Computer Studies' ? 'selected' : '' }}>College of Computer Studies</option>
                            <option value="College of Criminology" {{ old('department', $note->department ?? '') == 'College of Criminology' ? 'selected' : '' }}>College of Criminology</option>
                        </select>
                        @error('department')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Gender</label>
                        <select name="gender" class="@error('gender') @enderror block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender', $note->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $note->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $note->phone ?? '') }}" placeholder="+63 912 345 6789"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('phone') @enderror">
                        @error('phone')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Year Level</label>
                        <select name="year_level" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('year_level') @enderror">
                            <option value="">Select Year</option>
                            <option value="1st Year" {{ old('year_level', $note->year_level ?? '') == '1st Year' ? 'selected' : '' }}>1st Year</option>
                            <option value="2nd Year" {{ old('year_level', $note->year_level ?? '') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                            <option value="3rd Year" {{ old('year_level', $note->year_level ?? '') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                            <option value="4th Year" {{ old('year_level', $note->year_level ?? '') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                        </select>
                        @error('year_level')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Amount (₱)</label>
                        <input type="number" name="amount" value="{{ old('amount', $note->amount ?? '') }}"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('amount') @enderror">
                        @error('amount')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Reason</label>
                        <select name="reason" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('reason')  @enderror" onchange="toggleOtherReasonBox(this)">
                            <option value="">Select Reason</option>
                            <option value="Financial Problem" {{ old('reason', $note->reason ?? '') == 'Financial Problem' ? 'selected' : '' }}>Financial Problem</option>
                            <option value="Delayed release of salary or allowance" {{ old('reason', $note->reason ?? '') == 'Delayed release of salary or allowance' ? 'selected' : '' }}>Delayed release of salary or allowance</option>
                            <option value="Other" {{ old('reason', $note->reason ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <div id="otherReasonBox" style="display:{{ old('reason', $note->reason ?? '') == 'Other' ? 'block' : 'none' }};" class="mt-2">
                            <label class="block text-sm font-medium mb-1">Please specify other reason</label>
                            <textarea name="other_reason" rows="2" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('other_reason') @enderror">{{ old('other_reason', $note->other_reason ?? '') }}</textarea>
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
                            <option value="1st Semester" {{ old('semester', $note->semester ?? '') == '1st Semester' ? 'selected' : '' }}>1st Semester</option>
                            <option value="2nd Semester" {{ old('semester', $note->semester ?? '') == '2nd Semester' ? 'selected' : '' }}>2nd Semester</option>
                            <option value="Summer" {{ old('semester', $note->semester ?? '') == 'Summer' ? 'selected' : '' }}>Summer</option>
                        </select>
                        @error('semester')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Academic Year</label>
                        <input type="text" name="academic_year" value="{{ old('academic_year', $note->academic_year ?? '') }}"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('academic_year') @enderror">
                        @error('academic_year')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Down Payment (₱)</label>
                        <input type="number" name="down_payment" value="{{ old('down_payment', $note->down_payment ?? '') }}"
                            min="0" step="any"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('down_payment') @enderror"
                            oninput="this.value = this.value < 0 ? 0 : this.value;">
                        @error('down_payment')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Payment Due Date</label>
                        <input type="date" id="due_date" name="due_date" value="{{ old('due_date', $note->due_date ?? '') }}"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('due_date') @enderror">
                        @error('due_date')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Term</label>
                        <select name="term" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('term') @enderror">
                            <option value="">Select Term</option>
                            <option value="Prelim" {{ old('term', $note->term ?? '') == 'Prelim' ? 'selected' : '' }}>Prelim</option>
                            <option value="Midterm" {{ old('term', $note->term ?? '') == 'Midterm' ? 'selected' : '' }}>Midterm</option>
                            <option value="Finals" {{ old('term', $note->term ?? '') == 'Finals' ? 'selected' : '' }}>Finals</option>
                        </select>
                        @error('term')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Attachments and Signature side by side --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium mb-1">Upload Supporting Documents</label>
                        <input type="file" name="attachments[]" multiple accept="image/*"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm @error('attachments.*') @enderror">
                        <p class="text-xs text-gray-500 mt-1">Attach ID, proof of hardship, etc.</p>
                        @error('attachments.*')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Electronic Signature</label>
                        @php
                            use Illuminate\Support\Str;
                            $prevSignature = '';
                            if (!empty($note->signature_path)) {
                                if (Str::startsWith($note->signature_path, 'data:image')) {
                                    $prevSignature = $note->signature_path;
                                } else {
                                    $prevSignature = asset('storage/' . ltrim($note->signature_path, '/'));
                                }
                            }
                        @endphp
                        <input type="hidden" id="prev-signature" value="{{ $prevSignature }}">
                        <div class="border border-gray-300 rounded-md p-2 bg-gray-50">
                            <canvas id="signature-pad" width="300" height="120" class="border rounded bg-white"></canvas>
                            <div class="mt-2 flex gap-2">
                                <button type="button" onclick="clearSignature()" class="mt-3 px-4 py-1.5 bg-[#660809] hover:bg-black text-white rounded-lg text-sm font-medium shadow transition">Clear Signature</button>
                            </div>
                            <input type="hidden" name="signature" id="signature-input">
                            @error('signature')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Sign above using your mouse or touch.</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
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

{{-- Signature Pad Script --}}
<script>
let canvas = document.getElementById('signature-pad');
let signaturePad = canvas.getContext('2d');
let drawing = false;

// Load previous signature if exists
let prevSignature = document.getElementById('prev-signature').value;
if (prevSignature) {
    let img = new Image();
    img.onload = function() {
        signaturePad.clearRect(0, 0, canvas.width, canvas.height);
        signaturePad.drawImage(img, 0, 0, canvas.width, canvas.height);
        updateSignatureInput();
    };
    img.src = prevSignature;
}

canvas.addEventListener('mousedown', function(e) {
    drawing = true;
    signaturePad.beginPath();
    signaturePad.moveTo(e.offsetX, e.offsetY);
});
canvas.addEventListener('mousemove', function(e) {
    if (drawing) {
        signaturePad.lineTo(e.offsetX, e.offsetY);
        signaturePad.stroke();
    }
});
canvas.addEventListener('mouseup', function() {
    drawing = false;
    updateSignatureInput();
});
canvas.addEventListener('mouseleave', function() {
    drawing = false;
    updateSignatureInput();
});

// Touch events for mobile
canvas.addEventListener('touchstart', function(e) {
    e.preventDefault();
    drawing = true;
    let rect = canvas.getBoundingClientRect();
    let touch = e.touches[0];
    signaturePad.beginPath();
    signaturePad.moveTo(touch.clientX - rect.left, touch.clientY - rect.top);
});
canvas.addEventListener('touchmove', function(e) {
    e.preventDefault();
    if (drawing) {
        let rect = canvas.getBoundingClientRect();
        let touch = e.touches[0];
        signaturePad.lineTo(touch.clientX - rect.left, touch.clientY - rect.top);
        signaturePad.stroke();
    }
});
canvas.addEventListener('touchend', function() {
    drawing = false;
    updateSignatureInput();
});

function clearSignature() {
    signaturePad.clearRect(0, 0, canvas.width, canvas.height);
    document.getElementById('signature-input').value = '';
}

function updateSignatureInput() {
    document.getElementById('signature-input').value = canvas.toDataURL('image/png');
}

// On form submit, update the signature input
document.getElementById('promissoryForm').addEventListener('submit', function() {
    updateSignatureInput();
});
</script>
@endsection




