<?php $__env->startSection('content'); ?>
<div class="flex min-h-screen bg-gray-50">

  
  <div class="flex-1">

    
    <header class="fixed top-0 left-0 right-0 z-40 shadow bg-white">
      <?php echo $__env->make('includes.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </header>

    
    <main class="p-6 mt-24 w-full">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Archived Promissory Note Records</h2>

      
      <div class="flex items-center mb-4">
        <a href="<?php echo e(route('admin.manage-record')); ?>"
           class="bg-[#660809] hover:bg-black text-white font-semibold px-5 py-2 rounded-lg flex items-center gap-2 shadow transition">
          <span class="iconify" data-icon="mdi:arrow-left" data-width="20" data-height="20"></span>
          Back to Records
        </a>

        <div class="flex-1"></div>

        
        <button class="bg-[#660809] hover:bg-black text-white font-semibold px-5 py-2 rounded-lg flex items-center gap-2 shadow transition">
          <span class="iconify" data-icon="mdi:download" data-width="20" data-height="20"></span>
          Export Records
        </button>
      </div>

      
      <div class="bg-white rounded-xl shadow p-6">
        <div class="overflow-x-auto">
          <table class="min-w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
            <thead>
              <tr class="bg-[#660809] text-white">
                <th class="py-3 px-4 text-left font-medium">PN ID</th>
                <th class="py-3 px-4 text-left font-medium">Full Name</th>
                <th class="py-3 px-4 text-left font-medium">Department</th>
                <th class="py-3 px-4 text-left font-medium">Status</th>
                <th class="py-3 px-4 text-left font-medium">Remarks</th>
                <th class="py-3 px-4 text-left font-medium">Due Date</th>
                <th class="py-3 px-4 text-left font-medium">Actions</th>
              </tr>
            </thead>

            <tbody>
              <?php $__currentLoopData = $archivedNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="border-b hover:bg-gray-50 transition">
                <td class="py-3 px-4 font-semibold">PN -<?php echo e($note->pn_id); ?></td>
                <td class="py-3 px-4">
                   <div class="font-semibold text-gray-800"><?php echo e($note->user->fullname ?? $note->fullname); ?></div>
                  <div class="text-gray-500 text-xs"><?php echo e($note->user->student_id ?? $note->student_id); ?></div>
                </td>
                <td class="py-3 px-4 text-[#660809] font-bold"><?php echo e($note->user->department ?? $note->department); ?></td>
                <td class="py-3 px-4">
                  <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-700">
                    Archived
                  </span>
                </td>

                <td class="py-3 px-4">
                  <?php if($note->remarks == 'Not overdue yet'): ?>
                      <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-xs font-semibold"><?php echo e($note->remarks); ?></span>
                  <?php elseif($note->remarks == 'Not settled'): ?>
                      <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold"><?php echo e($note->remarks); ?></span>
                  <?php elseif($note->remarks == 'Overdue'): ?>
                      <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold"><?php echo e($note->remarks); ?></span>
                  <?php elseif($note->remarks == 'No due date'): ?>
                      <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-xs font-semibold"><?php echo e($note->remarks); ?></span>
                  <?php else: ?>
                      <?php echo e($note->remarks); ?>

                  <?php endif; ?>
                </td>
                
                <td class="py-3 px-4">
                  <?php echo e($note->due_date_formatted); ?>

                </td>
                <td class="py-3 px-4 flex gap-2">
                   <form action="<?php echo e(route('admin.promissorynotes-restore', $note->pn_id)); ?>" method="POST" class="archived-restore" style="display:inline;">
                  <?php echo csrf_field(); ?>
                  <button type="button" class="bg-blue-200 hover:bg-blue-300 text-blue-700 p-2 rounded-lg restore-btn flex items-center justify-center" title="Restore">
                    <span class="iconify" data-icon="mdi:backup-restore" data-width="20" data-height="20"></span>
                  </button>
                </form>

                <a href="<?php echo e(route('admin.archived-notes.download', $note->pn_id)); ?>"
                   class="bg-green-600 hover:bg-green-700 text-white p-2 rounded-lg flex items-center justify-center"
                   title="Download PDF">
                  <span class="iconify" data-icon="mdi:file-download-outline" data-width="20" data-height="20"></span>
                </a>

                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/admin/archived-notes.blade.php ENDPATH**/ ?>