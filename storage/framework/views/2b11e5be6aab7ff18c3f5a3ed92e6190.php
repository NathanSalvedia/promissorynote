<div x-data="{ open: false }" class="relative">
    <button
        @click.stop.prevent="
            open = !open;
            if(open) {
                fetch('<?php echo e(route('student.notifications.markRead')); ?>', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Accept': 'application/json'
                    }
                });
            }
        "
        class="relative text-[#660809] hover:text-[#000000] aria-haspopup=true"
        aria-expanded="false"
    >
        <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
        <?php if(isset($unreadCount) && $unreadCount > 0): ?>
            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 rounded-full"><?php echo e($unreadCount); ?></span>
        <?php endif; ?>
    </button>

    <!-- Desktop dropdown -->
    <div x-show="open" x-cloak @click.away="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform translate-y-1"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-1"
         class="hidden sm:block absolute right-0 mt-2 w-72 bg-white shadow-lg rounded-lg z-50 text-sm">
        <div class="p-3 border-b font-semibold">Notifications</div>
        <ul>
            <?php if(!auth()->user()->hasVerifiedEmail()): ?>
                <li class="px-3 py-2 border-b font-bold flex items-start gap-2">
                    <iconify-icon icon="mdi:email-alert-outline" class="text-xl text-yellow-500 mt-0.5"></iconify-icon>
                    <div>
                        Please verify your email address.
                        <form method="POST" action="<?php echo e(route('verification.send')); ?>" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-[#660809] underline hover:text-black font-semibold">Resend Verification Email</button>
                        </form>
                        <br>
                        <span class="text-xs text-gray-500"><?php echo e(now()->diffForHumans()); ?></span>
                    </div>
                </li>
            <?php endif; ?>

            <?php $__empty_1 = true; $__currentLoopData = $notifications->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="px-3 py-2 border-b <?php echo e($notification->is_read ? 'opacity-60' : 'font-bold'); ?>">
                    <?php echo e($notification->content); ?>

                    <br>
                    <span class="text-xs text-gray-500"><?php echo e($notification->sent_at ? \Carbon\Carbon::parse($notification->sent_at)->diffForHumans() : ''); ?></span>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="px-3 py-2 text-gray-500">No notifications.</li>
            <?php endif; ?>
        </ul>
        <div class="p-2 text-right">
            <a href="<?php echo e(route('student.notification-view')); ?>" class="text-[#660809] text-xs hover:underline">View all</a>
        </div>
    </div>

    <!-- Mobile full-panel -->
    <div x-show="open" x-cloak @keydown.escape.window="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="sm:hidden fixed inset-0 z-50 flex items-start justify-center">
        <!-- backdrop -->
        <div @click="open = false" class="absolute inset-0 bg-black/40"></div>

        <!-- panel -->
        <div class="relative w-full max-w-[400px] mx-auto mt-16 bg-white rounded-lg shadow-lg overflow-hidden max-h-[70vh]">
            <div class="flex items-center justify-between px-4 py-3 border-b">
                <h3 class="text-sm font-semibold text-gray-800">Notifications</h3>
                <button @click="open = false" class="p-1 rounded hover:bg-gray-100">
                    <iconify-icon icon="mdi:close" class="text-gray-700"></iconify-icon>
                </button>
            </div>

            <div class="max-h-[58vh] overflow-y-auto">
                <?php if(!auth()->user()->hasVerifiedEmail() && ($notifications ?? collect())->isEmpty()): ?>
                    <div class="p-4 text-center text-gray-500">No notifications.</div>
                <?php else: ?>
                    <ul class="divide-y">
                        <?php if(!auth()->user()->hasVerifiedEmail()): ?>
                            <li class="px-4 py-3 flex items-start gap-3">
                                <iconify-icon icon="mdi:email-alert-outline" class="text-xl text-yellow-500 mt-0.5"></iconify-icon>
                                <div class="flex-1">
                                    <div class="font-medium text-gray-800">Please verify your email address.</div>
                                    <div class="text-xs text-gray-500 mt-1"><?php echo e(now()->diffForHumans()); ?></div>
                                    <form method="POST" action="<?php echo e(route('verification.send')); ?>" class="mt-2">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="text-[#660809] text-sm underline hover:text-black font-semibold">Resend Verification Email</button>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>

                        <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="px-4 py-3">
                                <a href="<?php echo e($notification->link ?? '#'); ?>" class="block">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="text-sm <?php echo e($notification->is_read ? 'text-gray-700' : 'font-semibold text-gray-800'); ?> truncate"><?php echo e($notification->content); ?></div>
                                            <div class="text-xs text-gray-500 mt-1"><?php echo e($notification->sent_at ? \Carbon\Carbon::parse($notification->sent_at)->diffForHumans() : ''); ?></div>
                                        </div>
                                        <div class="ml-3 flex-shrink-0">
                                            <iconify-icon icon="mdi:chevron-right" class="text-gray-400"></iconify-icon>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="px-4 py-6 text-center text-gray-500">No notifications.</li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="px-4 py-3 border-t text-right">
                <a href="<?php echo e(route('student.notification-view')); ?>" class="text-sm text-[#660809] hover:underline">View all</a>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/includes/partials/student-bell.blade.php ENDPATH**/ ?>