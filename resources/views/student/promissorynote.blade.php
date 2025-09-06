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
            <h2 class="text-xl font-bold mb-6">Submit New Promissory Note</h2>

            <form id="promissoryForm" 
                  action="{{ route('promissorynotes.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="space-y-6" 
                  data-check-status-url="{{ route('promissorynote.checkStatus') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Full Name -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Full Name</label>
                        <input type="text" name="fullname" value="{{ auth()->user()->fullname }}"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                               focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                    </div>

                    <!-- Student ID -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Student ID</label>
                        <input type="text" name="student_id" value="{{ auth()->user()->student_id }}"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                               focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Gender</label>
                        <select name="gender" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <!-- Course -->
                    <div>
                        <label for="course" class="block text-md font-medium text-black">Course</label>
                        <input type="text" id="course" name="course"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                               focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                    </div>

                    <!-- Department -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Department</label>
                        <select name="department" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                            <option value="" disabled selected>Select your college</option>
                            <option value="college of Arts and Sciences">College of Arts and Sciences</option>
                            <option value="college of Engineering">College of Engineering</option>
                            <option value="college of Business Administration">College of Business Administration</option>
                            <option value="college of Education">College of Education</option>
                            <option value="college of Computer Studies">College of Computer Studies</option>
                            <option value="college of Criminology">College of Criminology</option>
                        </select>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Phone Number</label>
                        <input type="text" name="phone" placeholder="+63 912 345 6789"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                               focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                    </div>

                    <!-- Year Level -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Year Level</label>
                        <select name="year_level" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                            <option value="">Select Year</option>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                        </select>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Amount (₱)</label>
                        <input type="number" name="amount"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                               focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                    </div>

                    <!-- Reason -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Reason</label>
                        <select name="reason" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm"
                                onchange="toggleOtherReason(this)">
                            <option value="">Select Reason</option>
                            <option value="Financial Problem">Financial Problem</option>
                            <option value="Delayed release of salary or allowance">Delayed release of salary or allowance</option>
                            <option value="Other">Other</option>
                        </select>
                        <div id="otherReasonBox" style="display:none;" class="mt-2">
                            <label class="block text-sm font-medium mb-1">Please specify other reason</label>
                            <textarea name="other_reason" rows="2"
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                      focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm"></textarea>
                        </div>
                    </div>

                    <!-- Term -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Term</label>
                        <select name="term" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                            <option value="">Select Term</option>
                            <option value="1st Term">1st Term</option>
                            <option value="2nd Term">2nd Term</option>
                        </select>
                    </div>

                    <!-- Academic Year -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Academic Year</label>
                        <input type="text" name="academic_year"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                               focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                    </div>

                    <!-- Down Payment -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Down Payment (₱)</label>
                        <input type="number" name="down_payment"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                               focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                    </div>

                    <!-- Due Date -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Payment Due Date</label>
                        <input type="date" name="due_date"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                               focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-sm font-medium mb-1">Additional Notes</label>
                    <textarea name="notes" rows="3"
                              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                              focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm"></textarea>
                </div>

                <!-- Attachments -->
                <div>
                    <label class="block text-sm font-medium mb-1">Upload Supporting Documents</label>
                    <input type="file" name="attachments[]" multiple accept="image/*"
                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                           focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                    <p class="text-xs text-gray-500 mt-1">Attach ID, proof of hardship, etc.</p>
                </div>

                <!-- Buttons -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="pt-4">
                        <button type="button" onclick="reviewApplication()"
                                class="bg-[#660809] hover:bg-[#000000] text-white px-6 py-2 rounded-lg shadow">
                            Review Application
                        </button>
                    </div>
                    <div class="pt-4 text-right">
                        <button type="submit"
                                class="bg-[#660809] hover:bg-[#000000] text-white px-6 py-2 rounded-lg shadow ml-4">
                            Submit Application
                        </button>
                    </div>
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
        const box = document.getElementById('otherReasonBox');
        if (select.value === 'Other') {
            box.style.display = 'block';
        } else {
            box.style.display = 'none';
        }
    }

    // Review Application with SweetAlert
    function reviewApplication() {
        const form = document.getElementById('promissoryForm');
        const formData = new FormData(form);

        let htmlContent = `
            <div style="text-align:left; max-height:400px; overflow-y:auto; padding:5px;">
                <div style="font-size:14px; line-height:1.5;">
        `;

        for (let [key, value] of formData.entries()) {
            if (key !== "_token" && value) {
                htmlContent += `
                    <div style="padding:8px; border-bottom:1px solid #eee;">
                        <span style="font-weight:600; color:#333;">${key.replace("_", " ").toUpperCase()}:</span> 
                        <span style="color:#555; margin-left:4px;">${value}</span>
                    </div>
                `;
            }
        }

        htmlContent += `</div></div>`;

        Swal.fire({
            title: '📋 Review Your Application',
            html: htmlContent,
            showCancelButton: true,
            confirmButtonText: '✅ Submit Application',
            cancelButtonText: '✏️ Edit',
            confirmButtonColor: '#228B22',
            cancelButtonColor: '#555',
            width: 700,
            padding: '2em',
            background: '#f9f9f9',
            color: '#333',
            customClass: {
                popup: 'animate__animated animate__fadeInDown animate__slower',
                confirmButton: 'rounded-lg shadow px-4 py-2',
                cancelButton: 'rounded-lg shadow px-4 py-2'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.requestSubmit(); 
            }
        });
    }

    // Success alert after submit
    document.getElementById('promissoryForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        Swal.fire({
            icon: 'success',
            title: '✅ Submitted Successfully!',
            text: 'Your promissory note has been submitted.',
            showConfirmButton: false,
            timer: 2000,
            background: '#f0fff4',
            color: '#22543d'
        }).then(() => {
            form.submit();
        });
    });
</script>
@endsection
