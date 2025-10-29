<?php $__env->startSection('content'); ?>

<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-300 px-2">
    <div class="w-full max-w-md bg-white/90 rounded-2xl shadow-2xl p-4 sm:p-10 backdrop-blur-md border border-gray-200">
        <div class="flex flex-col items-center mb-6">
            <div class="bg-green-100 rounded-full p-3 mb-3">
                <iconify-icon icon="mdi:lock-reset" class="text-green-600 text-3xl"></iconify-icon>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-800 mb-1 tracking-tight">Reset Password</h2>
            <p class="text-green-700 text-md">Enter your email to receive a password reset link.</p>
        </div>
        <form action="<?php echo e(route('password.email')); ?>" class="space-y-6" method="POST">
            <?php echo csrf_field(); ?>
            <div>
                <label for="email" class="block text-md font-medium text-gray-700 mb-2">Email Address:</label>
                <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="your@gmail.com"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 transition sm:text-base text-gray-800 placeholder-gray-400" autocomplete="email" required>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-md mt-2 block"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <button type="submit"
                class="w-full bg-[#660809] hover:bg-black text-white font-bold py-3 px-6 rounded-xl shadow-lg transition-all duration-200 transform hover:scale-[1.03]">
                Send Password Reset Link
            </button>
        </form>
        <div class="mt-8 text-center">
            <a href="<?php echo e(route('login')); ?>" class="text-green-700 font-semibold hover:text-green-900 hover:underline text-md transition flex items-center justify-center gap-1">
                <iconify-icon icon="mdi:arrow-left" class="text-green-700 text-base"></iconify-icon>
                Back to Sign In
            </a>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/auth/password/request.blade.php ENDPATH**/ ?>