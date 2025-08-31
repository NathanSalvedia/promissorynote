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
function submitForm() {
    document.getElementById('promissoryForm').submit();
}



document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('promissoryForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var checkStatusUrl = form.getAttribute('data-check-status-url');
            fetch(checkStatusUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.hasUnsettled) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Unsettled Promissory Note',
                            text: 'Settle your previous promissory note before submitting a new one.',
                            confirmButtonText: 'Ok',
                            confirmButtonColor: '#660809',
                            background: '#fff',
                            color: '#660809',
                            customClass: {
                                popup: 'rounded-xl',
                                confirmButton: 'px-6 py-2 text-white font-semibold rounded-lg'
                            },
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        });
                    } else {
                        form.submit();
                    }
                })
                .catch(() => {
                    form.submit();
                });
        });
    }
});
