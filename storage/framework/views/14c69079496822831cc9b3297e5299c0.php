<?php $__env->startSection('content'); ?>

<div class="min-h-screen bg-gray-100 flex flex-col">

   <?php echo $__env->make('includes.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>



    <!-- Move Alpine.js state to main for global access -->
    <main class="p-2 sm:p-6 w-full" x-data="{ guidelinesOpen: false }">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h2 class="text-2xl font-bold text-[#660809]">Student Dashboard</h2>

            <div class="flex gap-3 mt-4 sm:mt-0">

                 <!-- Guidelines Button Styled Like New Promissory Note -->
                <button
                    type="button"
                    @click="guidelinesOpen = true"
                    class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition"
                >
                    <iconify-icon icon="mdi:information-outline"></iconify-icon>
                    Guidelines
                </button>

                <a href="<?php echo e(route('student.promissorynote')); ?>"
                   class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
                    <iconify-icon icon="mdi:plus-circle-outline"></iconify-icon>
                    New Promissory Note
                </a>



                <a href="<?php echo e(route('student.subledger')); ?>"
                   class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
                    <iconify-icon icon="mdi:clipboard-list-outline"></iconify-icon>
                    Account Subledger
                </a>
            </div>
        </div>

        
        <div
            x-show="guidelinesOpen"
            class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40"
            style="display: none; backdrop-filter: blur(2px);"
        >
            <div class="bg-white rounded-xl shadow-lg p-8 max-w-lg w-full relative">
                <button
                    @click="guidelinesOpen = false"
                    class="absolute top-3 right-3 text-[#660809] text-lg hover:text-black flex items-center gap-1"
                    aria-label="Close"
                >
                    <span class="text-sm font-semibold">Close</span>
                </button>
                <h4 class="text-lg text-center font-bold text-[#660809] mb-4">Promissory Note Guidelines</h4>
                <ul class="list-disc pl-5 text-gray-700 space-y-2">
                    <li class="font-bold">Fill out the Promissory Note Form </li>
                      <ul>
                            <li>Complete the promissory Note Form Completely.</li>
                            <li>Attach the following documents for Submission :</li>
                            <li>Student ID</li>
                            <li>Parent/Guardians's ID</li>
                            <li>Employee ID or Certificate of Employment (only for working students)</li>
                        </ul>
                    <li class="font-bold">Approval is subject to review by the Secretary's Office.</li>
                    <li class="font-bold">Check your email and sms for status updates.</li>
                </ul>
            </div>
        </div>

        <?php if(!auth()->user()->hasVerifiedEmail()): ?>
            <div
                x-data="{ open: true }"
                x-show="open"
                class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40"
                style="backdrop-filter: blur(2px);"
            >
                <div class="bg-white rounded-xl shadow-lg p-8 max-w-md w-full relative">
                    <button
                        @click="open = false"
                        class="absolute top-3 right-3 text-[#660809] text-lg hover:text-black flex items-center gap-1"
                        aria-label="Close"
                    >
                        <span class="text-sm font-semibold">Close</span>
                    </button>
                    <div class="flex flex-col items-center gap-4">
                        <iconify-icon icon="mdi:email-alert-outline" class="text-5xl text-yellow-500"></iconify-icon>
                        <h4 class="text-lg font-bold text-[#660809]">Verify Your Email Address</h4>
                        <p class="text-gray-700 text-center">
                            Please check your inbox and click the verification link to activate your account.<br>
                            If you did not receive the email,
                            <form method="POST" action="<?php echo e(route('verification.send')); ?>" class="inline">
                                <?php echo csrf_field(); ?>
                             <button type="submit" class="w-full bg-[#660809] text-white font-semibold py-2 px-2 rounded-lg shadow hover:bg-black transition mb-2">
                                 Verification
                             </button>
                            </form>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-2xl shadow border overflow-hidden">
            <div class="px-6 py-4 bg-[#660809] text-white flex justify-between items-center">
                <h3 class="text-xl font-bold">My Promissory Notes</h3>
            </div>

            <div class="overflow-x-auto" id="promissory-table">
    <?php echo $__env->make('student.partials.promissory-table', ['notes' => $notes], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
        </div>
    </main>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    setInterval(function() {
        fetch("<?php echo e(route('student.promissory.table')); ?>")
            .then(response => response.text())
            .then(html => {
                document.getElementById('promissory-table').innerHTML = html;
            });
    }, 10000); // every 10 seconds
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/student/dashboard.blade.php ENDPATH**/ ?>