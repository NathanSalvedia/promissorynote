<?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $paid = $note->payments->sum('amount') + $note->down_payment;
        $remaining = $note->amount - $paid;
        $isOverdue = $note->due_date <= now()->toDateString() && $remaining > 0;
    ?>
    <tr class="border-b <?php echo e($note->is_settled ? 'bg-green-50' : ($isOverdue ? 'bg-red-50' : 'bg-white')); ?>">
        
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/admin/partials/payment-table.blade.php ENDPATH**/ ?>