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
});

function reviewApplication() {
    const form = document.getElementById('promissoryForm');
    const formData = new FormData(form);

    const entries = [];
    for (let [key, value] of formData.entries()) {
        if (key !== "_token" && value) {
            entries.push({ key, value });
        }
    }

    const mid = Math.ceil(entries.length / 2);
    const col1 = entries.slice(0, mid);
    const col2 = entries.slice(mid);

    let htmlContent = `
        <div style="text-align:left; max-height:400px; overflow-y:auto; padding:5px;">
            <div style="display:flex; gap:24px; font-size:14px; line-height:1.5;">
                <div style="flex:1;">
    `;
    col1.forEach(entry => {
        htmlContent += `
            <div style="padding:8px; border-bottom:1px solid #eee;">
                <span style="font-weight:600; color:#333;">${entry.key.replace("_", " ").toUpperCase()}:</span>
                <span style="color:#555; margin-left:4px;">${entry.value}</span>
            </div>
        `;
    });
    htmlContent += `</div><div style="flex:1;">`;
    col2.forEach(entry => {
        htmlContent += `
            <div style="padding:8px; border-bottom:1px solid #eee;">
                <span style="font-weight:600; color:#333;">${entry.key.replace("_", " ").toUpperCase()}:</span>
                <span style="color:#555; margin-left:4px;">${entry.value}</span>
            </div>
        `;
    });
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
