document.addEventListener('DOMContentLoaded', function() {
    var reasonSelect = document.querySelector('select[name="reason"]');
    var otherReasonBox = document.getElementById('otherReasonBox');
    var otherReasonTextarea = document.querySelector('textarea[name="other_reason"]');
    if (reasonSelect && otherReasonBox && otherReasonTextarea) {
        function toggleOtherReason() {
            if (reasonSelect.value === 'Other') {
                otherReasonBox.style.display = 'block';
                otherReasonTextarea.setAttribute('required', 'required');
            } else {
                otherReasonBox.style.display = 'none';
                otherReasonTextarea.removeAttribute('required');
            }
        }
        reasonSelect.addEventListener('change', toggleOtherReason);
        toggleOtherReason();
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
                    }
                })
                .catch(() => {
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
        });
    }

    const selectAllIcon = document.getElementById('select-all-icon');
    let allChecked = false;

    if (selectAllIcon) {
        selectAllIcon.addEventListener('click', function() {
            allChecked = !allChecked;
            toggleAll({ checked: allChecked });

            const icon = selectAllIcon.querySelector('iconify-icon');
            if (allChecked) {
                icon.setAttribute('icon', 'mdi:checkbox-marked');
                icon.classList.add('text-[#660809]');
            } else {
                icon.setAttribute('icon', 'mdi:checkbox-blank-outline');
                icon.classList.remove('text-[#660809]');
            }
        });
    }


    const dueDateInput = document.getElementById('due_date');
    if (dueDateInput) {
        dueDateInput.addEventListener('change', function() {
            const selected = new Date(this.value);
            const today = new Date();
            today.setHours(0,0,0,0);

            if (selected < today) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Invalid Due Date',
                    text: 'You cannot select a past date for Payment Due Date.',
                    showConfirmButton: false,
                    timer: 3500,
                    timerProgressBar: true,
                    background: '#fffbe6',
                    color: '#d7263d',
                    customClass: {
                        popup: 'rounded-xl shadow-lg px-4 py-3'
                    }
                });
                this.value = '';
            }
        });
    }
});

function renderEntry(entry) {
    if (entry.isFile && entry.value.type.startsWith('image/')) {

        return `
            <div class="flex flex-col items-center mb-2">
                <img src="${URL.createObjectURL(entry.value)}" alt="${entry.value.name}" class="max-w-[120px] max-h-[120px] rounded shadow border border-gray-300 mb-1">
                <span class="text-xs text-gray-500">${entry.value.name}</span>
            </div>
        `;
    } else if (entry.isFile) {
        return `
            <div class="mb-2">
                <span class="font-semibold text-gray-700">${entry.key.replace("_", " ").toUpperCase()}:</span>
                <span class="text-gray-500 ml-1">${entry.value.name}</span>
            </div>
        `;
    } else {
        return `
            <div class="mb-2">
                <span class="font-semibold text-gray-700">${entry.key.replace("_", " ").toUpperCase()}:</span>
                <span class="text-gray-600 ml-1">${entry.value}</span>
            </div>
        `;
    }
}

function reviewApplication() {
    const form = document.getElementById('promissoryForm');
    const formData = new FormData(form);

    const entries = [];
    const attachments = [];
    for (let [key, value] of formData.entries()) {
        if (key !== "_token" && value) {
            if (value instanceof File && value.name) {
                attachments.push({ key, value, isFile: true });
            } else {
                entries.push({ key, value, isFile: false });
            }
        }
    }

    const mid = Math.ceil(entries.length / 2);
    const col1 = entries.slice(0, mid);
    const col2 = entries.slice(mid);

    let htmlContent = `
        <div class="text-left max-h-[400px] overflow-y-auto p-2">
            <div class="flex gap-6 text-[14px] leading-6">
                <div class="flex-1">
    `;
    col1.forEach(entry => {
        htmlContent += renderEntry(entry);
    });
    htmlContent += `</div><div class="flex-1">`;
    col2.forEach(entry => {
        htmlContent += renderEntry(entry);
    });

    // Render attachments in two columns
    if (attachments.length > 0) {
        htmlContent += `
            <div class="col-span-2 mt-4">
                <span class="font-semibold text-gray-700 block mb-2">ATTACHMENTS:</span>
                <div class="grid grid-cols-2 gap-4">
        `;
        attachments.forEach(att => {
            htmlContent += renderEntry(att);
        });
        htmlContent += `
                </div>
            </div>
        `;
    }

    htmlContent += `</div></div></div>`;

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

function toggleAll(source) {
    const checkboxes = document.getElementsByName('selected[]');
    for (let i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
}



document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.archive-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'warning',
                title: 'Archive Record?',
                text: 'Are you sure you want to archive this record?',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Yes, archive it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                background: '#fffbe6',
                color: '#333',
                customClass: {
                    popup: 'rounded-xl shadow-lg',
                    confirmButton: 'px-4 py-2 font-semibold rounded-lg',
                    cancelButton: 'px-4 py-2 font-semibold rounded-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = btn.closest('form');
                    const row = btn.closest('tr');

                    if (row) {
                        // Prepare a smooth collapse + fade + slide animation before submit
                        row.style.transition = 'transform 600ms ease, opacity 600ms ease, height 600ms ease, margin 600ms ease, padding 600ms ease';
                        row.style.transformOrigin = 'left center';

                        // Fix current height so we can animate to 0
                        const startHeight = row.getBoundingClientRect().height;
                        row.style.height = startHeight + 'px';
                        row.style.boxSizing = 'border-box';

                        // Force reflow to ensure transition starts
                        void row.offsetHeight;

                        // Apply end styles
                        row.style.opacity = '0';
                        row.style.transform = 'translateX(30px) scale(0.98)';
                        row.style.height = '0px';
                        row.style.margin = '0px';
                        row.style.paddingTop = '0px';
                        row.style.paddingBottom = '0px';

                        // After animation completes, submit the form
                        const onTransitionEnd = function(e) {
                            // ensure we only handle the height/opacity transition end
                            if (e.propertyName === 'height' || e.propertyName === 'opacity') {
                                row.removeEventListener('transitionend', onTransitionEnd);
                                // small delay to ensure visual completion
                                setTimeout(() => form.submit(), 80);
                            }
                        };
                        row.addEventListener('transitionend', onTransitionEnd);

                        // Fallback: if transitionend doesn't fire, submit after timeout
                        setTimeout(() => {
                            if (!form._submittedByAnimation) {
                                form._submittedByAnimation = true;
                                form.submit();
                            }
                        }, 900);
                    } else {
                        form.submit();
                    }
                }
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.restore-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Restore Record?',
                    text: 'Are you sure you want to restore this record?',
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Yes, restore it!',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    background: '#fffbe6',
                    color: '#333',
                    customClass: {
                        popup: 'rounded-xl shadow-lg',
                        confirmButton: 'px-4 py-2 font-semibold rounded-lg',
                        cancelButton: 'px-4 py-2 font-semibold rounded-lg'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        btn.closest('form').submit();
                    }
                });
        });
    });
});


document.getElementById('subledgerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Save Entry?',
        html: `
            <div class="flex flex-col items-center">
                <span class="iconify" data-icon="mdi:content-save-outline" data-width="48" data-height="48" style="color:#660809;"></span>
                <div class="mt-4 text-gray-700">Please confirm you want to save this subledger entry.</div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Yes, Save',
        cancelButtonText: 'Cancel',
        customClass: {
            popup: 'rounded-xl',
            confirmButton: 'bg-[#660809] text-white px-6 py-2 rounded-lg font-bold shadow-none',
            cancelButton: 'bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-bold shadow-none ml-2'
        },
        buttonsStyling: false,
        background: '#fff',
        color: '#222',
        focusConfirm: false,
        didOpen: () => {

            if (window.Iconify) {
                Iconify.scan();
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            e.target.submit();
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        const minDate = `${yyyy}-${mm}-${dd}`;
        document.getElementById('due_date').setAttribute('min', minDate);
    });

document.addEventListener('DOMContentLoaded', function() {
    const downPaymentInput = document.querySelector('input[name="down_payment"]');
    if (downPaymentInput) {
        downPaymentInput.addEventListener('input', function(e) {
            if (this.value < 0 || isNaN(this.value)) {
                this.value = '';
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Invalid Down Payment',
                    text: 'Down Payment cannot be negative or non-numeric.',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#fffbe6',
                    color: '#d7263d',
                    customClass: {
                        popup: 'rounded-xl shadow-lg px-4 py-3'
                    }
                });
            }
        });
    }
});

