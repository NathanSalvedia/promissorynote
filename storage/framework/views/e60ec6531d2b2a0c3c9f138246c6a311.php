<?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $paid = $note->payments->sum('amount') + $note->down_payment;
        $remaining = $note->amount - $paid;
        $isOverdue = $note->due_date <= now()->toDateString() && $remaining > 0;
    ?>
    <tr class="border-b <?php echo e($note->is_settled ? 'bg-green-50' : ($isOverdue ? 'bg-red-50' : 'bg-white')); ?>">
        <td class="px-4 py-2">PN-<?php echo e($note->pn_id); ?></td>
        <td class="px-4 py-2">
            <div class="font-semibold"><?php echo e($note->user->fullname ?? 'N/A'); ?></div>
            <div class="text-xs text-gray-500">Student ID: <?php echo e($note->user->student_id ?? 'N/A'); ?></div>
        </td>
        <td class="px-4 py-2">₱<?php echo e(number_format($note->amount, 2)); ?></td>
        <td class="px-4 py-2 text-green-600">₱<?php echo e(number_format($note->down_payment, 2)); ?></td>
        <td class="px-4 py-2"><?php echo e($note->due_date); ?></td>
        <td class="px-4 py-2">
            <?php if($note->is_settled): ?>
                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-semibold">Paid</span>
            <?php elseif($isOverdue): ?>
                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">Overdue</span>
            <?php else: ?>
                <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-xs font-semibold">Not overdue yet</span>
            <?php endif; ?>
        </td>
       <td class="px-4 py-2 flex gap-2">
                                  <form action="<?php echo e(route('admin.promissorynotes.recordPayment', $note->pn_id)); ?>" method="POST" style="display:inline;">
                                  <?php echo csrf_field(); ?>
                                  <button type="submit" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded" title="Record Payment">
                                      <iconify-icon icon="mdi:plus" class="w-4 h-4"></iconify-icon>
                                  </button>
                                 </form>

                                 <a href="<?php echo e(route('admin.subledger-show', $note->user->student_id)); ?>" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-purple-600 hover:bg-purple-700 text-white" title="View Subledger">
                                            <iconify-icon icon="mdi:book-account-outline"></iconify-icon>
                                 </a>

                                   <form action="<?php echo e(route('admin.promissorynotes-archive', $note->pn_id)); ?>" method="POST"  class="archive-form" style="display:inline;">
                                   <?php echo csrf_field(); ?>
                                 <button type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-lg archive-btn" title="Archive">
                                  <span class="iconify" data-icon="mdi:archive" data-width="20" data-height="20"></span>
                                </button>
                               </form>
                            </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/admin/partials/payment-tracking-table.blade.php ENDPATH**/ ?>