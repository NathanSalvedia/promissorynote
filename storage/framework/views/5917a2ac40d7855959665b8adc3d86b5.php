<?php $__env->startSection('content'); ?>
<div class="flex min-h-screen bg-white">

  
  <div class="flex-1">

    
    <header class="fixed top-0 left-0 right-0 z-40 shadow bg-white">
      <?php echo $__env->make('includes.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </header>

    
    <main class="p-6 mt-24 w-full">
      
      <h2 class="text-2xl font-bold mb-6 text-gray-800 mt-4">Centralized Record Management</h2>

      
      <div class="flex flex-wrap gap-6 mb-8 items-center">

        
        <div class="flex-1 min-w-[220px] bg-[#660809] rounded-xl shadow p-6 flex items-center gap-4">
          <div class="bg-blue-100 text-blue-600 rounded-full p-3">
            <span class="iconify" data-icon="mdi:database" data-width="28" data-height="28"></span>
          </div>
          <div>
            <div class="text-gray-200 text-sm">Total Records</div>
            <div class="text-white text-2xl font-bold"><?php echo e($totalNotes ?? $promissoryNotes->count()); ?></div>
          </div>
        </div>

        
        <div class="flex-1 min-w-[220px] bg-[#660809] rounded-xl shadow p-6 flex items-center gap-4">
          <div class="bg-green-100 text-green-600 rounded-full p-3">
            <span class="iconify" data-icon="mdi:file-document-box" data-width="28" data-height="28"></span>
          </div>
          <div>
            <div class="text-gray-200 text-sm">Archived</div>
            <div class="text-white text-2xl font-bold"><?php echo e($archivedNotesCount); ?></div>
          </div>
        </div>

        
        <div class="flex-1 min-w-[220px] bg-[#660809] rounded-xl shadow p-6 flex items-center gap-4">
          <div class="bg-yellow-100 text-yellow-600 rounded-full p-3">
            <span class="iconify" data-icon="mdi:refresh" data-width="28" data-height="28"></span>
          </div>
          <div>
            <div class="text-gray-200 text-sm">Resubmissions</div>
            <div class="text-white text-2xl font-bold"><?php echo e($resubmissionCount ?? 0); ?></div>
          </div>
        </div>


        
        <a href="<?php echo e(route('admin.archived-notes')); ?>"
          class="flex items-center justify-center bg-white border border-gray-300 hover:border-[#660809] hover:bg-gray-50 transition-all rounded-xl shadow-md p-4 w-[100px] h-[100px] ml-auto group">
          <div class="text-center">
            <div class="bg-[#660809]/10 text-[#660809] rounded-full p-3 mx-auto group-hover:bg-[#660809] group-hover:text-white transition">
              <span class="iconify" data-icon="mdi:archive" data-width="28" data-height="28"></span>
            </div>
            <div class="text-xs text-gray-700 mt-2 font-semibold">Archived</div>
          </div>
        </a>
      </div>

      
      <div class="bg-white rounded-xl shadow p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-4">
          <h3 class="text-lg font-semibold text-gray-700">All Promissory Note Records</h3>

          
          <form method="GET" action="<?php echo e(route('admin.manage-record')); ?>"
                class="flex flex-col sm:flex-row gap-3 sm:items-center w-full sm:w-auto">

            <!-- Search -->
            <div class="relative flex-1 sm:w-64">
              <input type="text" id="search" name="search" value="<?php echo e(request('search')); ?>"
                class="w-full border-gray-300 rounded-full shadow-lg focus:ring-[#660809] focus:border-[#660809] pl-10 pr-3 py-1.5 text-sm"
                placeholder="Search by Course or Name...">
              <iconify-icon icon="mdi:magnify"
                class="absolute left-3 top-7 transform -translate-y-1/2 text-gray-400 text-lg"></iconify-icon>
            </div>

            <!-- Department Filter -->
            <div>
              <select id="department" name="department"
                class="text-gray-400 w-full border-gray-300 rounded-full shadow-lg focus:ring-[#660809] focus:border-[#660809] py-1.5 px-3 text-sm">
                <option value="">All Departments</option>
                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($dept); ?>" <?php echo e(request('department') == $dept ? 'selected' : ''); ?>>
                    <?php echo e($dept); ?>

                  </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>


              <div>
              <select id="status_sort" name="status_sort"
                class="text-gray-400 w-full border-gray-300 rounded-full shadow-lg focus:ring-[#660809] focus:border-[#660809] py-1.5 px-3 text-sm"
                onchange="this.form.submit()">
                <option value="">Sort by Status</option>
                <option value="approved" <?php echo e(request('status_sort') == 'approved' ? 'selected' : ''); ?>>Approved</option>
                <option value="pending" <?php echo e(request('status_sort') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                <option value="rejected" <?php echo e(request('status_sort') == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
              </select>
            </div>


          </form>
        </div>

        
        <div class="overflow-x-auto">
          <table class="min-w-full text-md border border-gray-200 rounded-lg overflow-hidden">
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
            <tbody id="records-table">
              <?php echo $__env->make('admin.partials.records-table', ['promissoryNotes' => $promissoryNotes], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</div>

<script>
  setInterval(function() {
    fetch("<?php echo e(route('admin.records-table-partial')); ?>")
      .then(response => response.text())
      .then(html => {
        document.getElementById('records-table').innerHTML = html;
      });
  }, 10000);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/admin/manage-record.blade.php ENDPATH**/ ?>