<header class="w-full">
    
    <div class="bg-black text-white text-[11px] md:text-xs py-0.5">
        <div class="w-full px-4">
            <div class="marquee flex items-center gap-2">
                <span class="flex items-center gap-2">
                    <img src="/img/logo.png" alt="Logo" class="h-4 w-auto object-contain inline-block">
                    DATA-DRIVEN PROMISSORY NOTE MANAGEMENT SYSTEM WITH INTEGRATED NOTIFICATION AND ANALYTICS SOLUTION
                </span>
            </div>
        </div>
    </div>

    
    <div class="bg-[#660809] text-white">
        <div class="w-full px-4 py-1 text-[11px] md:text-xs flex justify-end gap-6"></div>
    </div>

    
    <div class="bg-white shadow">
        <div class="w-full flex justify-between items-center px-6 py-3">
            <div class="flex items-center gap-3">
                <img src="/img/spc-wordmark.png" alt="SPC" class="h-10 md:h-12 object-contain">
            </div>

            <div class="flex items-center gap-6">
                
                <div id="notification-bell">
                    <?php echo $__env->make('includes.partials.admin-bell', [
                        'notifications' => $notifications ?? collect(),
                        'unreadCount' => $unreadCount ?? 0
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.away="open = false"
                        class="inline-flex items-center px-3 py-2 rounded-md text-sm font-medium focus:outline-none transition bg-[#660809] text-white hover:bg-green-600">
                        Admin User
                        <iconify-icon icon="mdi:chevron-down"
                            class="ml-1 text-white text-lg transform transition-transform duration-200"
                            :class="{'rotate-180': open}"></iconify-icon>
                    </button>

                    <div x-show="open" x-transition
                        class="absolute right-0 mt-2 w-52 rounded-md shadow-lg bg-white z-50 origin-top-right">
                        <div class="py-1">
                            <a href="<?php echo e(route('admin.dashboard')); ?>"
                                class="flex items-center px-3 py-2 text-sm text-gray-800 hover:bg-[#660809] hover:text-white transition">
                                <iconify-icon icon="mdi:view-dashboard-outline" class="mr-2"></iconify-icon>
                                Dashboard
                            </a>
                            <!--
                            <a href="<?php echo e(route('admin.subledger-create')); ?>"
                                class="flex items-center px-3 py-2 text-sm text-gray-800 hover:bg-[#660809] hover:text-white transition">
                                <iconify-icon icon="mdi:file-document-edit-outline" class="mr-2"></iconify-icon>
                                Subledger Entry
                            </a>
                            -->
                            <a href="<?php echo e(route('admin.manage-record')); ?>"
                                class="flex items-center px-3 py-2 text-sm text-gray-800 hover:bg-[#660809] hover:text-white transition">
                                <iconify-icon icon="mdi:file-document-edit-outline" class="mr-2"></iconify-icon>
                                Manage Records
                            </a>
                            <a href="<?php echo e(route('admin.analytics')); ?>"
                                class="flex items-center px-3 py-2 text-sm text-gray-800 hover:bg-[#660809] hover:text-white transition">
                                <iconify-icon icon="mdi:chart-line" class="mr-2"></iconify-icon>
                                Analytics
                            </a>
                            <a href="<?php echo e(route('admin.manage-users')); ?>"
                                class="flex items-center px-3 py-2 text-sm text-gray-800 hover:bg-[#660809] hover:text-white transition">
                                <iconify-icon icon="mdi:account-multiple-outline" class="mr-2"></iconify-icon>
                                Manage Users
                            </a>
                            <a href="<?php echo e(route('admin.payment-tracking')); ?>"
                                class="flex items-center px-3 py-2 text-sm text-gray-800 hover:bg-[#660809] hover:text-white transition">
                                <iconify-icon icon="mdi:cash-multiple" class="mr-2"></iconify-icon>
                                Payment Tracking
                            </a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                    class="flex items-center w-full px-3 py-2 text-sm text-gray-800 hover:bg-[#660809] hover:text-white transition text-left">
                                    <iconify-icon icon="mdi:logout" class="mr-2"></iconify-icon>
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
<?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/includes/admin.blade.php ENDPATH**/ ?>