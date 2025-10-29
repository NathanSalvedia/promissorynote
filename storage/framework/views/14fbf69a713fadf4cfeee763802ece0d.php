<?php $__env->startSection('content'); ?>
 <?php echo $__env->make('includes.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="bg-gradient-to-b from-gray-200 to-gray-100 min-h-screen py-2">
    <div class="max-w-5xl mx-auto p-2 sm:p-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-2 relative">
            <h2 class="text-2xl font-bold text-gray-800">Account Subledger</h2>

            
            <a href="<?php echo e(route('student.dashboard')); ?>"
               class="absolute top-0 right-0 mt-1 mr-1 flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-700 rounded shadow z-10 px-3 py-1 text-sm font-medium"
               style="min-width:70px;">
                <span aria-hidden="true" class="text-lg mr-1">&laquo;</span>
                <span>Back</span>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-md sm:text-sm border border-gray-300 rounded-lg shadow">
                <thead>
                    <tr class="bg-gray-400 text-white">
                        <th class="px-4 py-2 text-left whitespace-nowrap overflow-hidden text-ellipsis">School Year</th>
                        <th class="px-4 py-2 text-left">Sem</th>
                        <th class="px-4 py-2 text-left whitespace-nowrap overflow-hidden text-ellipsis">Date</th>
                        <th class="px-4 py-2 text-left">Reference</th>
                        <th class="px-4 py-2 text-left">Debit</th>
                        <th class="px-4 py-2 text-left">Credit</th>
                        <th class="px-4 py-2 text-left">Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $currentSy = '';
                        $currentSem = '';
                    ?>
                    <?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($currentSy !== $entry->school_year || $currentSem !== $entry->semester): ?>
                            <tr class="bg-green-200 font-bold">
                                <td colspan="7" class="px-4 py-2">
                                    SY: <?php echo e($entry->school_year); ?> SEM: <?php echo e($entry->semester); ?>

                                </td>
                            </tr>
                            <?php
                                $currentSy = $entry->school_year;
                                $currentSem = $entry->semester;
                            ?>
                        <?php endif; ?>
                        <tr class="<?php echo e($loop->even ? 'bg-gray-100' : 'bg-white'); ?>">
                            <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis"><?php echo e($entry->school_year); ?></td>
                            <td class="px-4 py-2"><?php echo e($entry->semester); ?></td>
                            <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis"><?php echo e($entry->date); ?></td>
                            <td class="px-4 py-2"><?php echo e($entry->reference); ?></td>
                            <td class="px-4 py-2"><?php echo e(number_format($entry->debit, 2)); ?></td>
                            <td class="px-4 py-2"><?php echo e(number_format($entry->credit, 2)); ?></td>
                            <td class="px-4 py-2"><?php echo e(number_format($entry->balance, 2)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/student/subledger.blade.php ENDPATH**/ ?>