<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Promissory Note Rejected</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col items-center py-8">
        <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg border border-gray-200 p-8">

            <h2 class="text-lg font-semibold text-gray-800 mb-2 text-center">Your promissory note has been rejected</h2>

            <p class="mt-6 text-gray-700 text-center">We regret to inform you that your promissory note (PN-<?php echo e($note->pn_id); ?>) has been <strong>rejected</strong>.</p>

            <p class="mt-2 text-gray-700 text-center"><strong>Reason for rejection:</strong></p>
            <p class="mt-2 text-gray-700 text-center" style="color: #b91c1c;"><?php echo e($note->denial_reason); ?></p>

            <p class="mt-4 text-gray-700 text-center">If you have questions, please email <a href="mailto:OPsecretary@spc.edu.ph" class="text-blue-600 hover:underline">OPsecretary@spc.edu.ph</a></p>

            <p class="mt-4 text-gray-700 text-center">Thank you,<br><span class="font-semibold"><?php echo e(config('app.name')); ?> Team</span></p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/emails/promissory_note_rejected.blade.php ENDPATH**/ ?>