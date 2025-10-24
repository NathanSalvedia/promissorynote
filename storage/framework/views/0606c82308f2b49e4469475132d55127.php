<table class="min-w-full table-auto text-lg">
    <thead class="bg-gray-50 text-gray-700">
        <tr>
            <th class="px-6 py-3 text-left font-semibold">PN ID</th>
            <th class="px-6 py-3 text-left font-semibold">Full Name</th>
            <th class="px-6 py-3 text-left font-semibold">Department</th>
            <th class="px-6 py-3 text-left font-semibold">Course</th>
            <th class="px-6 py-3 text-left font-semibold">Amount</th>
            <th class="px-6 py-3 text-left font-semibold">Status</th>
            <th class="px-6 py-3 text-left font-semibold">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $statusColors = [
                'pending' => 'bg-yellow-100 text-yellow-800',
                'approved' => 'bg-green-100 text-green-800',
                'rejected' => 'bg-red-100 text-red-800',
            ];
        ?>
        <?php $__empty_1 = true; $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">
                    PN-<?php echo e($note->pn_id); ?>

                    <?php if($note->is_new): ?>
                        <span id="new-label-pn<?php echo e($note->pn_id); ?>" class="ml-2 inline-block bg-green-200 text-green-800 text-xs px-2 py-1 rounded-full font-bold">New</span>
                    <?php endif; ?>
                    <?php if($note->parent_pn_id): ?>
                        <span class="ml-2 inline-flex items-center gap-1 px-3 py-2 rounded-full font-bold text-xs"
                              style="background: linear-gradient(90deg, #f7c948 0%, #f7b32b 100%); color: #7c4700;">
                            <iconify-icon icon="mdi:refresh" class="text-base mr-1"></iconify-icon>
                            Resubmission
                        </span>
                    <?php endif; ?>
                    <?php if($note->status == 'rejected'): ?>
                        <span class="ml-2 inline-flex items-center gap-1 px-3 py-2 rounded-full font-bold text-xs"
                              style="background: linear-gradient(90deg, #f87171 0%, #ef4444 100%); color: #7f1d1d;">
                            <iconify-icon icon="mdi:close-circle" class="text-base mr-1"></iconify-icon>
                            Rejected
                        </span>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4">
                    <div class="font-semibold"><?php echo e($note->user->fullname ?? 'N/A'); ?></div>
                    <div class="text-gray-500 text-xs">Student ID: <?php echo e($note->user->student_id ?? 'N/A'); ?></div>
                </td>
                <td class="px-6 py-4">
                    <span class="inline-block bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">
                        <?php echo e($note->department); ?>

                    </span>
                </td>
                <td class="px-6 py-4 align-middle">
                  <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-3 py-1 rounded-full font-semibold whitespace-nowrap w-full text-center">
                   <?php echo e($note->course ?? 'N/A'); ?>

                   </span>
                </td>
                <td class="px-6 py-4 font-semibold">₱<?php echo e(number_format($note->amount, 2)); ?></td>
                <td class="px-6 py-4">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold <?php echo e($statusColors[$note->status] ?? 'bg-gray-100 text-gray-800'); ?>">
                        <?php echo e(ucfirst($note->status)); ?>

                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <?php if($note->status == 'pending'): ?>
                            <form method="POST" action="<?php echo e(route('admin.promissory.approve', $note->pn_id)); ?>" style="display:inline-block;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-green-600 hover:bg-green-700 text-white" title="Approve">
                                    <iconify-icon icon="mdi:check"></iconify-icon>
                                </button>
                            </form>
                        <?php endif; ?>
                        <a href="<?php echo e(route('admin.promissorynote-detail', $note->pn_id)); ?>" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-blue-600 hover:bg-blue-700 text-white" title="View">
                            <iconify-icon icon="mdi:eye-outline"></iconify-icon>
                        </a>
                        <a href="<?php echo e(route('admin.subledger', $note->user->student_id)); ?>" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-purple-600 hover:bg-purple-700 text-white" title="View Subledger">
                            <iconify-icon icon="mdi:book-account-outline"></iconify-icon>
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="8" class="px-6 py-8 text-center text-gray-500">No pending requests.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/admin/partials/pending-requests-table.blade.php ENDPATH**/ ?>