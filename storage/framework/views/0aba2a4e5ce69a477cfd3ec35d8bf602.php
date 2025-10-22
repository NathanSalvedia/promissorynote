<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-100 flex">

    
    <div class="flex-1">

       
        <header class="fixed top-0 left-0 right-0 z-50 shadow bg-white">
            <?php echo $__env->make('includes.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </header>

      
<main class="p-6 w-full mt-24">
    <h2 class="text-2xl font-bold mb-6">Admin Dashboard</h2>

    
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">
        <!-- Total Notes -->
        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100">
                <iconify-icon icon="mdi:file-document-outline" class="text-blue-600 text-2xl"></iconify-icon>
            </div>
            <div>
                <p class="text-sm opacity-80">Total Notes</p>
                <p class="text-3xl font-bold"><?php echo e($totalNotes); ?></p>
            </div>
        </div>

        <!-- Pending Review -->
        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-yellow-100">
                <iconify-icon icon="mdi:clock-time-four-outline" class="text-yellow-600 text-2xl"></iconify-icon>
            </div>
            <div>
                <p class="text-sm opacity-80">Pending Review</p>
                <p class="text-3xl font-bold"><?php echo e($pendingNotes); ?></p>
            </div>
        </div>

        <!-- Approved -->
        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-100">
                <iconify-icon icon="mdi:check-circle-outline" class="text-green-600 text-2xl"></iconify-icon>
            </div>
            <div>
                <p class="text-sm opacity-80">Approved</p>
                <p class="text-3xl font-bold"><?php echo e($approvedNotes); ?></p>
            </div>
        </div>

        <!-- Rejected -->
        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100">
                <iconify-icon icon="mdi:close-circle-outline" class="text-red-600 text-2xl"></iconify-icon>
            </div>
            <div>
                <p class="text-sm opacity-80">Rejected</p>
                <p class="text-3xl font-bold"><?php echo e($rejectedNotes); ?></p>
            </div>
        </div>
    </div>

    
    <div class="bg-white rounded-2xl shadow border overflow-hidden">
    <div class="px-6 py-4 bg-[#660809] border-b flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <h3 class="text-xl font-bold text-[#ffffff]">Pending Requests</h3>

                                         <form method="GET" action="<?php echo e(route('admin.dashboard')); ?>"
                        class="flex flex-col sm:flex-row sm:items-center gap-4  px-4 py-3 rounded-xl">

                        <!-- Search -->
                        <div class="relative flex-1 bg-white rounded-lg">
                            <input type="text" id="search" name="search" value="<?php echo e(request('search')); ?>"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#660809] focus:border-[#660809] pl-10 pr-4 py-2 text-sm"
                                placeholder="Search by Course">
                            <iconify-icon icon="mdi:magnify"
                                class="absolute left-3 top-7 transform -translate-y-1/2 text-gray-400 text-lg"></iconify-icon>
                        </div>

                        <!-- Department Filter -->
                        <div class="bg-white rounded-lg">
                            <select id="department" name="department"
                                class="text-gray-400 w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#660809] focus:border-[#660809] py-2 px-3 text-sm">
                                <option value="">All Departments</option>
                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($dept); ?>" <?php echo e(request('department') == $dept ? 'selected' : ''); ?>><?php echo e($dept); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>


                    </form>

                </div>

                
                <div class="overflow-x-auto">
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
                </div>
            </div>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php if($notes->where('is_new', true)->count()): ?>
    <script src="<?php echo e(asset('js/reuse.js')); ?>"></script>
<?php endif; ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/admin/admindashboard.blade.php ENDPATH**/ ?>