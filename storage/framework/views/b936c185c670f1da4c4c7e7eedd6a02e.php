<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 px-2">
    <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-8 w-full max-w-md">
        <div class="flex flex-col items-center mb-6">
            <!-- Iconify Email Icon -->
            <span class="iconify bg-blue-100 text-[#660809] rounded-full p-3 mb-3" data-icon="mdi:email-check-outline" data-width="65" data-height="65"></span>
            <h2 class="text-2xl font-bold text-[#660809] text-center">
                Welcome, <span class="text-green-500"><?php echo e(Auth::user()->fullname); ?></span>
            </h2>
        </div>
        <div class="mb-4">
            <p class="font-semibold text-lg text-gray-900 mb-2 text-center">Thanks for signing up!</p>
            <p class="text-gray-600 mb-2">
                Please verify your email address by clicking the link we just sent to your inbox.
            </p>
            <p class="text-gray-900 mb-2">
                Didn’t get the email? We’ll gladly send you another.
            </p>
            <?php if(session('status') == 'verification-link-sent'): ?>
                <div class="mb-2 text-green-600 text-sm font-medium">
                    A new verification link has been sent to your email address.
                </div>
            <?php endif; ?>
        </div>
        <form method="POST" action="<?php echo e(route('verification.send')); ?>" class="flex flex-col items-center">
            <?php echo csrf_field(); ?>
            <button type="submit" class="w-full bg-[#660809] text-white font-semibold py-2 rounded-lg shadow hover:bg-black transition mb-2">
                Resend Email Verification
            </button>
        </form>
        <div class="mt-4 text-md text-gray-900 text-center">
            Need help? <a href="#" class="text-[#660809] hover:underline">Contact support</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/auth/verify-email.blade.php ENDPATH**/ ?>