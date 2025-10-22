<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Promissory Note Submitted</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col items-center py-8">
        <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg border border-gray-200 p-8">

            <h2 class="text-lg font-semibold text-gray-800 mb-2 text-center">Thank you for submitting your promissory note!</h2>

            <p class="mt-6 text-gray-700 text-center">We will process your request and notify you of any updates.</p>
            <p class="mt-2 text-gray-700 text-center">Thank you,<br><span class="font-semibold"><?php echo e(config('app.name')); ?> Team</span></p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/emails/promissory_note_submitted.blade.php ENDPATH**/ ?>