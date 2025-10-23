<?php
    use Carbon\Carbon;
?>


<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('includes.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="w-full mt-8">
        <div class="w-full mt-8">
            <div class="bg-white shadow rounded-lg p-4 sm:p-6 mx-2 sm:mx-10">
                <div class="flex items-center justify-between mb-5">
                    <a href="<?php echo e(route('student.dashboard')); ?>"
                       class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#4a0708] text-white px-4 py-2 rounded-lg shadow transition">
                        <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                        Back to Dashboard
                    </a>
                </div>

                <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-gray-800">Notifications</h2>
                <ul class="space-y-4">
                    <?php if(!auth()->user()->hasVerifiedEmail()): ?>
                        <li>
                            <a
                                href="<?php echo e(route('verification.notice')); ?>"
                                class="flex items-center justify-between bg-[#660809] shadow-md rounded-lg p-4 hover:bg-black text-white transition"
                                target="_blank"
                            >
                                <div>
                                    <span class="font-bold text-white">
                                        Please verify your email address.
                                    </span>
                                    <span class="text-xs text-white mt-1 block">
                                        <?php echo e(Carbon::now()->diffForHumans()); ?>

                                    </span>
                                </div>
                                <span class="ml-4 text-xl text-white">
                                    <iconify-icon icon="mdi:chevron-right"></iconify-icon>
                                </span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li>
                            <a
                                href="<?php echo e($notification->link ?? '#'); ?>"
                                class="flex items-center justify-between bg-[#660809] shadow-md rounded-lg p-4 hover:bg-black text-white transition"
                                target="_blank"
                            >
                                <div>
                                    <span class="font-bold text-white">
                                        <?php echo e($notification->content); ?>

                                    </span>
                                    <span class="text-xs text-white mt-1 block">
                                        <?php echo e($notification->sent_at ? Carbon::parse($notification->sent_at)->diffForHumans() : ''); ?>

                                    </span>
                                </div>
                                <span class="ml-4 text-xl text-white">
                                    <iconify-icon icon="mdi:chevron-right"></iconify-icon>
                                </span>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="py-4 text-gray-500 text-center">No notifications found.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/student/notification-view.blade.php ENDPATH**/ ?>