@extends('layouts.layout')

@section('content')

{{-- ===== styles (marquee scrolling) ===== --}}
<style>
  .marquee{white-space:nowrap;overflow:hidden;box-sizing:border-box}
  .marquee>span{display:inline-block;padding-left:100%;animation:marquee 16s linear infinite}
  .marquee:hover>span{animation-play-state:paused}
  @keyframes marquee{0%{transform:translateX(0)}100%{transform:translateX(-100%)}}
</style>

<div class="min-h-screen bg-gray-100 flex flex-col">
<header class="w-full">
  {{-- Top black strip with scrolling text --}}
  <div class="bg-black text-white text-[11px] md:text-xs py-0.5">
    <div class="max-w-7xl mx-auto px-4">
      <div class="marquee">
        <span>Enroll Now  |  Experience a Modern SPC  |  Welcome to My.SPC Promissorynote Management System</span>
      </div>
    </div>
  </div>

  {{-- Thin maroon strip --}}
  <div class="bg-[#660809] text-white">
    <div class="max-w-7xl mx-auto px-4 py-1 text-[11px] md:text-xs flex justify-end gap-6"></div>
  </div>

  {{-- White navbar with logo + system title + user tools --}}
  <div class="bg-white shadow">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
      {{-- Left: Title --}}
      <div class="flex items-center gap-3">
        <img src="/img/spc-wordmark.png" alt="SPC" class="h-10 md:h-12 object-contain">
      </div>

      <div class="flex items-center gap-6">
        <button class="relative text-[#660809] hover:text-[#000000]">
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
    </div>
  </div>
</header>

<main class="p-6 max-w-5xl mx-auto w-full">
  <div class="mb-4">
    <a href="{{ route('student.dashboard') }}" class="flex items-center gap-2 text-[#660809] hover:text-[#000000]">
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
        {{-- inputs unchanged --}}
        {{-- Full Name --}}
        <div>
          <label class="block text-sm font-medium mb-1">Full Name</label>
          <input type="text" name="fullname" value="{{ auth()->user()->fullname }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-600 focus:border-green-600 sm:text-sm">
        </div>
        {{-- Student ID --}}
        <div>
          <label class="block text-sm font-medium mb-1">Student ID</label>
          <input type="text" name="student_id" value="{{ auth()->user()->student_id }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-600 focus:border-green-600 sm:text-sm">
        </div>
        {{-- Gender --}}
        <div>
          <label class="block text-sm font-medium mb-1">Gender</label>
          <select name="gender" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-600 focus:border-green-600 sm:text-sm">
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        {{-- Department --}}
        <div>
          <label class="block text-sm font-medium mb-1">Department</label>
          <select name="department" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-600 focus:border-green-600 sm:text-sm">
            <option value="" disabled selected>Select your college</option>
            <option value="college of Arts and Sciences">College of Arts and Sciences</option>
            <option value="college of Engineering">College of Engineering</option>
            <option value="college of Business Administration">College of Business Administration</option>
            <option value="college of Education">College of Education</option>
            <option value="college of Computer Studies">College of Computer Studies</option>
            <option value="college of Criminology">College of Criminology</option>
          </select>
        </div>
        {{-- Phone --}}
        <div>
          <label class="block text-sm font-medium mb-1">Phone Number</label>
          <input type="text" name="phone" placeholder="+63 912 345 6789" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-600 focus:border-green-600 sm:text-sm">
        </div>
        {{-- Year Level --}}
        <div>
          <label class="block text-sm font-medium mb-1">Year Level</label>
          <select name="year_level" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-600 focus:border-green-600 sm:text-sm">
            <option value="">Select Year</option>
            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>
          </select>
        </div>
        {{-- Amount --}}
        <div>
          <label class="block text-sm font-medium mb-1">Amount (₱)</label>
          <input type="number" name="amount" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-600 focus:border-green-600 sm:text-sm">
        </div>
        {{-- Reason --}}
        <div>
          <label class="block text-sm font-medium mb-1">Reason</label>
          <select name="reason" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-600 focus:border-green-600 sm:text-sm">
            <option value="">Select Reason</option>
            <option value="Financial Problem">Financial Problem</option>
            <option value="Delayed release of salary or allowance">Delayed release of salary or allowance</option>
            <option value="Other">Other</option>
          </select>
          <div id="otherReasonBox" style="display:none;" class="mt-2">
            <label class="block text-sm font-medium mb-1">Please specify other reason</label>
            <textarea name="other_reason" rows="2" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-600 focus:border-green-600 sm:text-sm"></textarea>
          </div>
        </div>
        {{-- Term --}}
        <div>
          <label class="block text-sm font-medium mb-1">Term</label>
          <select name="term" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-600 focus:border-green-600 sm:text-sm">
            <option value="">Select Term</option>
            <option value="1st Term">1st Term</option>
            <option value="2nd Term">2nd Term</option>
          </select>
        </div>
        {{-- Academic Year --}}
        <div>
          <label class="block text-sm font-medium mb-1">Academic Year</label>
          <input type="text" name="academic_year" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-600 focus:border-green-600 sm:text-sm">
        </div>
        {{-- Down Payment --}}
        <div>
          <label class="block text-sm font-medium mb-1">Down Payment (₱)</label>
          <input type="number" name="down_payment" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-600 focus:border-green-600 sm:text-sm">
        </div>
        {{-- Due Date --}}
        <div>
          <label class="block text-sm font-medium mb-1">Payment Due Date</label>
          <input type="date" name="due_date" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-600 focus:border-green-600 sm:text-sm">
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Additional Notes</label>
        <textarea name="notes" rows="3" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-600 focus:border-green-600 sm:text-sm"></textarea>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Upload Supporting Documents</label>
        <input type="file" name="attachments[]" multiple accept="image/*" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-600 focus:border-green-600 sm:text-sm">
        <p class="text-xs text-gray-500 mt-1">Attach ID, proof of hardship, etc.</p>
      </div>

      <div class="grid grid-cols-2 gap-4 mb-4">
        <div class="pt-4">
          <button type="button" onclick="reviewApplication()" class="bg-[#660809] hover:bg-[#000000] text-white px-6 py-2 rounded-lg shadow">
            Review Application
          </button>
        </div>
        <div class="pt-4 text-right">
          <button type="submit" class="bg-[#660809] hover:bg-[#000000] text-white px-6 py-2 rounded-lg shadow ml-4">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Show/hide other reason
  var reasonSelect = document.querySelector('select[name="reason"]');
  var otherReasonBox = document.getElementById('otherReasonBox');
  if (reasonSelect && otherReasonBox) {
    reasonSelect.addEventListener('change', function() {
      otherReasonBox.style.display = this.value === 'Other' ? 'block' : 'none';
    });
  }

  // Highlight filled fields
  var fields = document.querySelectorAll('input[type="text"], input[type="number"], input[type="date"], select, textarea');
  fields.forEach(function(field) {
    field.addEventListener('input', function() {
      if (field.value.trim() !== '') {
        field.classList.add('border-green-600');
      } else {
        field.classList.remove('border-green-600');
      }
    });
    if (field.value.trim() !== '') {
      field.classList.add('border-green-600');
    }
  });
});

// Review modal logic
function reviewApplication() {
  var form = document.getElementById('promissoryForm');
  var formData = new FormData(form);
  var reviewHtml = '<div class="grid grid-cols-2 md:grid-cols-2 gap-4">';
  var fields = [
    {name: 'fullname', label: 'Full Name'},
    {name: 'student_id', label: 'Student ID'},
    {name: 'gender', label: 'Gender'},
    {name: 'department', label: 'Department'},
    {name: 'phone', label: 'Phone Number'},
    {name: 'year_level', label: 'Year Level'},
    {name: 'amount', label: 'Amount'},
    {name: 'reason', label: 'Reason'},
    {name: 'other_reason', label: 'Other Reason'},
    {name: 'term', label: 'Term'},
    {name: 'academic_year', label: 'Academic Year'},
    {name: 'down_payment', label: 'Down Payment'},
    {name: 'due_date', label: 'Payment Due Date'},
    {name: 'notes', label: 'Additional Notes'}
  ];
  fields.forEach(function(field) {
    var value = formData.get(field.name) || '';
    if (field.name === 'amount' || field.name === 'down_payment') {
      value = value ? '₱ ' + value : '';
    }
    reviewHtml += `<div class='bg-gray-50 rounded p-3 shadow-sm'><div class='text-xs text-gray-500 mb-1'>${field.label}</div><div class='font-semibold text-gray-800'>${value}</div></div>`;
  });
  reviewHtml += '</div>';
  var files = form.querySelector('input[name="attachments[]"]').files;
  if (files.length > 0) {
    reviewHtml += '<div class="mt-4"><div class="text-xs text-gray-500 mb-1 font-semibold">Attachments:</div><div class="grid grid-cols-1 md:grid-cols-2 gap-2">';
    for (var i = 0; i < files.length; i++) {
      reviewHtml += `<div class='bg-white rounded p-2 border border-gray-200 flex items-center gap-2'><span class='text-gray-700'>${files[i].name}</span></div>`;
    }
    reviewHtml += '</div></div>';
  }
  document.getElementById('reviewContent').innerHTML = reviewHtml;
  document.getElementById('reviewModal').classList.remove('hidden');
}
function closeReviewModal() {
  document.getElementById('reviewModal').classList.add('hidden');
}

// ✅ Fixed submit handler
document.addEventListener('DOMContentLoaded', function() {
  var form = document.getElementById('promissoryForm');
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      fetch('{{ route("promissorynote.checkStatus") }}')
        .then(response => response.json())
        .then(data => {
          if (data.hasUnsettled) {
            alert('Settle your previous promissory note.');
          } else {
            HTMLFormElement.prototype.submit.call(form); // real submit
          }
        })
        .catch(() => {
          HTMLFormElement.prototype.submit.call(form);
        });
    });
  }
});
</script>
