@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-white flex flex-col">

    <!-- ✅ Fixed Header -->
    <header class="fixed top-0 left-0 w-full z-50 shadow bg-white">
        @include('includes.header')
    </header>

    <!-- ✅ Main Content -->
    <main class="p-6 max-w-5xl mx-auto w-full mt-28">

        <!-- 🔙 Back Button -->
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('student.dashboard') }}" 
               class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Back to Dashboard
            </a>
        </div>

        <!-- 🧾 Paper-style Card -->
        <div class="bg-white p-10 rounded-xl shadow-lg border border-gray-200 relative overflow-hidden">

            <!-- 🏫 Logo & Title -->
            <div class="text-center mb-8 relative">
                <img src="{{ asset('img/logo.jpg') }}" alt="School Logo" class="w-20 h-20 mx-auto mb-4">
                <h2 class="text-2xl font-bold text-[#660809]">Promissory Note Application Form</h2>
                <p class="text-gray-500 text-sm">Please fill in all the required details below</p>
            </div>

            <form id="promissoryForm" 
                  action="{{ route('promissorynotes.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="space-y-8"
                  data-check-status-url="{{ route('promissorynote.checkStatus') }}">
                @csrf

                <!-- 🧩 Form Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- Full Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="fullname" placeholder="Enter your full name"
                            value="{{ auth()->user()->fullname }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm" />
                    </div>

                    <!-- Student ID -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Student ID</label>
                        <input type="text" name="student_id" placeholder="Enter your student ID"
                            value="{{ auth()->user()->student_id }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm" />
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gender</label>
                        <select name="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm">
                            <option value="">Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <!-- Course -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Course</label>
                        <input type="text" name="course" placeholder="Enter your course"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm" />
                    </div>

                    <!-- Department -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Department</label>
                        <select name="department" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm">
                            <option value="">Select department</option>
                            <option>College of Arts and Sciences</option>
                            <option>College of Engineering</option>
                            <option>College of Business Administration</option>
                            <option>College of Education</option>
                            <option>College of Computer Studies</option>
                            <option>College of Criminology</option>
                        </select>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone" placeholder="+63 912 345 6789"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm" />
                    </div>

                    <!-- Year Level -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Year Level</label>
                        <select name="year_level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm">
                            <option value="">Select year level</option>
                            <option>1st Year</option>
                            <option>2nd Year</option>
                            <option>3rd Year</option>
                            <option>4th Year</option>
                        </select>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Amount (₱)</label>
                        <input type="number" name="amount" placeholder="Enter total amount"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm" />
                    </div>

                    <!-- Reason -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Reason</label>
                        <select name="reason" onchange="toggleOtherReason(this)" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm">
                            <option value="">Select reason</option>
                            <option value="Financial Problem">Financial Problem</option>
                            <option value="Delayed release of salary or allowance">Delayed release of salary or allowance</option>
                            <option value="Other">Other</option>
                        </select>
                        <div id="otherReasonBox" class="mt-3 hidden">
                            <textarea name="other_reason" rows="2" placeholder="Please specify your reason"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm"></textarea>
                        </div>
                    </div>

                    <!-- Term -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Term</label>
                        <select name="term" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm">
                            <option value="">Select term</option>
                            <option>1st Term</option>
                            <option>2nd Term</option>
                        </select>
                    </div>

                    <!-- Academic Year -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Academic Year</label>
                        <input type="text" name="academic_year" placeholder="Ex. 2025-2026"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm" />
                    </div>

                    <!-- Down Payment -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Down Payment (₱)</label>
                        <input type="number" name="down_payment" placeholder="Enter down payment"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm" />
                    </div>

                    <!-- Due Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Payment Due Date</label>
                        <input type="date" name="due_date"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm" />
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Additional Notes</label>
                    <textarea name="notes" rows="3" placeholder="Add any additional information here..."
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm"></textarea>
                </div>

                <!-- Attachments -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Upload Supporting Documents</label>
                    <input type="file" name="attachments[]" multiple accept="image/*"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#660809] focus:ring-[#660809] sm:text-sm" />
                    <p class="text-xs text-gray-500 mt-1">Attach valid ID, proof of hardship, or related documents.</p>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between pt-6 border-t border-gray-200">
                    <button type="button" onclick="reviewApplication()"
                        class="bg-[#660809] hover:bg-black text-white px-6 py-2 rounded-lg shadow transition">
                        Review Application
                    </button>
                    <button type="submit"
                        class="bg-[#660809] hover:bg-black text-white px-6 py-2 rounded-lg shadow transition">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function toggleOtherReason(select) {
    document.getElementById('otherReasonBox').style.display =
        select.value === 'Other' ? 'block' : 'none';
}

function reviewApplication() {
    const form = document.getElementById('promissoryForm');
    const formData = new FormData(form);
    let html = `
        <div style="background:#fff; padding:15px; border-radius:10px; text-align:left; max-height:400px; overflow-y:auto;">
    `;
    formData.forEach((value, key) => {
        if (value && key !== '_token' && key !== 'attachments[]') {
            const label = key.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
            html += `
                <div style="margin-bottom:8px;">
                    <strong style="color:#660809;">${label}:</strong>
                    <span style="color:#333;"> ${value}</span>
                </div>
            `;
        }
    });
    html += "</div>";

    Swal.fire({
        title: '📋 Review Your Application',
        html: html,
        width: 600,
        background: '#f9f9f9',
        showCancelButton: true,
        confirmButtonText: '✅ Submit',
        cancelButtonText: '✏️ Edit',
        confirmButtonColor: '#660809',
        scrollbarPadding: false
    }).then(result => {
        if (result.isConfirmed) form.requestSubmit();
    });
}
</script>
@endsection
