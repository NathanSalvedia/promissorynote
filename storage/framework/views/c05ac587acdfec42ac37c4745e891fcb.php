<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($user->role->value === 'student'): ?>
    <tr>
        <td class="px-6 py-4"><?php echo e($user->fullname); ?></td>
        <td class="px-6 py-4"><?php echo e($user->email); ?></td>
        <td class="px-6 py-4"><?php echo e($user->student_id); ?></td>
        <td class="px-6 py-4"><?php echo e(ucfirst($user->role->value)); ?></td>
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
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/admin/partials/user-table.blade.php ENDPATH**/ ?>