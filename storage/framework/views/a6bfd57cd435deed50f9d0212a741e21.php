  <div x-data="{ open: false }" class="relative">
                    <button
                        @click="
                            open = !open;
                            if(open) {
                                fetch('<?php echo e(route('admin.notifications.markRead')); ?>', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                                        'Accept': 'application/json'
                                    }
                                });
                            }
                        "
                        @click.away="open = false"
                        class="relative text-[#660809] hover:text-black">
                        <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
                        <?php if(isset($unreadCount) && $unreadCount > 0): ?>
                            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 rounded-full"><?php echo e($unreadCount); ?></span>
                        <?php endif; ?>
                    </button>

                    <div x-show="open" x-transition
                        class="absolute right-0 mt-2 w-72 bg-white shadow-lg rounded-lg z-50 text-sm">
                        <div class="p-3 border-b font-semibold">Notifications</div>
                        <ul>
                            <?php if(isset($notifications) && $notifications->count()): ?>
                                <?php $__currentLoopData = $notifications->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li
                                        class="px-3 py-2 border-b <?php echo e($notification->is_read ? 'opacity-60' : 'font-bold'); ?>">
                                        <?php echo e($notification->content); ?>

                                        <br>
                                        <span
                                            class="text-xs text-gray-500"><?php echo e($notification->sent_at ? \Carbon\Carbon::parse($notification->sent_at)->diffForHumans() : ''); ?></span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <li class="px-3 py-2 text-gray-500">No notifications.</li>
                            <?php endif; ?>
                        </ul>
                        <div class="p-2 text-right">
                            <a href="<?php echo e(route('admin.notifications')); ?>"
                                class="text-[#660809] text-xs hover:underline">View all</a>
                        </div>
                    </div>
                </div>
<?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/includes/partials/admin-bell.blade.php ENDPATH**/ ?>