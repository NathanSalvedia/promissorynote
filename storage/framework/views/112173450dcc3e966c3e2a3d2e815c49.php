<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-100 flex flex-col">

    <header class="fixed top-0 left-0 right-0 z-50 shadow bg-white">
        <?php echo $__env->make('includes.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </header>

    <main class="p-6 mt-24 w-full">
        <div class="bg-white rounded-2xl shadow border overflow-hidden">

            <div class="px-6 py-4 bg-[#660809] border-b flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <h2 class="text-xl font-bold text-white">User Management</h2>

                
                <a href="<?php echo e(route('admin.dashboard')); ?>"
                    class="inline-flex items-center gap-2 bg-white text-[#660809] hover:bg-gray-100 px-4 py-2 rounded-lg font-semibold shadow transition">
                    <iconify-icon icon="mdi:arrow-left" class="w-5 h-5"></iconify-icon>
                    <span>Back</span>
                </a>
            </div>

            
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Full Name</th>
                            <th class="px-6 py-3 text-left font-semibold">Email</th>
                            <th class="px-6 py-3 text-left font-semibold">Student ID</th>
                            <th class="px-6 py-3 text-left font-semibold">Role</th>
                            <th class="px-6 py-3 text-left font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $nonAdminUsers = $users->where('role', '!=', 'admin');
                        ?>
                        <?php $__empty_1 = true; $__currentLoopData = $nonAdminUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium"><?php echo e($user->fullname); ?></td>
                                <td class="px-6 py-4"><?php echo e($user->email); ?></td>
                                <td class="px-6 py-4"><?php echo e($user->student_id); ?></td>
                                <td class="px-6 py-4">
                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">
                                        <?php echo e(is_string($user->role) ? ucfirst($user->role) : ucfirst($user->role->value)); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="<?php echo e(route('admin.users.show', $user->id)); ?>" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-green-600 hover:bg-green-700 text-white" title="View Details">
                                            <iconify-icon icon="mdi:account-details-outline"></iconify-icon>
                                        </a>
                                        <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-blue-600 hover:bg-blue-700 text-white" title="Edit">
                                            <iconify-icon icon="mdi:square-edit-outline"></iconify-icon>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">No users found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/admin/manage-user.blade.php ENDPATH**/ ?>