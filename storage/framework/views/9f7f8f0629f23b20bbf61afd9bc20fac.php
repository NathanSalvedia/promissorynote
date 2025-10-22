<header class="w-full">
    
    <div class="bg-black text-white text-[11px] md:text-xs py-0.5">
        <div class="w-full px-4">
            <div class="marquee">
                <span>  DATA-DRIVEN PROMISSORY NOTE MANAGEMENT SYSTEM WITH INTEGRATED NOTIFICATION AND ANALYTICS SOLUTION
 </span>
            </div>
        </div>
    </div>

    
    <div class="bg-[#660809] text-white">
        <div class="w-full px-4 py-1 text-[11px] md:text-xs flex justify-end gap-6"></div>
    </div>

    
    <div class="bg-white shadow">
        <div class="w-full flex flex-col sm:flex-row justify-between items-center px-3 sm:px-6 py-2 sm:py-3 gap-2">
            <div class="flex items-center gap-2 sm:gap-3">
                <img src="/img/spc-wordmark.png" alt="SPC" class="h-10 sm:h-12 object-contain">
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-2 sm:gap-6 mt-2 sm:mt-0">
                
                <div x-data="{ open: false }" class="relative">
                    <button
                        @click="
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
                        class="relative text-[#660809] hover:text-[#000000]">
                        <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
                        <?php if(isset($unreadCount) && $unreadCount > 0): ?>
                            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 rounded-full"><?php echo e($unreadCount); ?></span>
                        <?php endif; ?>
                    </button>

                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform translate-y-1"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform translate-y-1"
                         class="absolute right-0 mt-2 w-72 bg-white shadow-lg rounded-lg z-50 text-sm">
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
                </div>
                
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        :class="open ? 'bg-green-600 text-white' : 'bg-[#660809] text-white hover:bg-green-600'"
                        class="inline-flex items-center px-2.5 py-1 rounded-md text-sm font-medium focus:outline-none transition">
                        <?php echo e(auth()->user()->fullname); ?>

                        <iconify-icon :class="{'rotate-180': open}"
                                      icon="mdi:chevron-down"
                                      class="ml-1 text-white text-lg transform transition-transform duration-200">
                        </iconify-icon>
                    </button>

                    <div x-show="open" @click.away="open = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95 -translate-y-1"
                        x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 transform scale-95 -translate-y-1"
                        class="absolute right-0 mt-1 w-40 rounded-md shadow-lg bg-white z-50 origin-top-right">
                        <div class="py-1">
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                    <button type="submit"
                                     class="block w-full px-3 py-1.5 text-sm bg-white text-black hover:bg-[#660809] hover:text-white text-left rounded-md transition">
                                     <iconify-icon icon="mdi:logout" class="mr-1"></iconify-icon>
                                     Logout
                                    </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
/* Responsive marquee for mobile */
.marquee {
    overflow: hidden;
    white-space: nowrap;
    animation: marquee 18s linear infinite;
}
@keyframes marquee {
    0% { transform: translateX(100%);}
    100% { transform: translateX(-100%);}
}
</style>

<?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/includes/header.blade.php ENDPATH**/ ?>