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

                
                <div class="overflow-x-auto" id="pending-requests-table">
                    <?php echo $__env->make('admin.partials.pending-requests-table', ['notes' => $notes], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php if($notes->where('is_new', true)->count()): ?>
    <script src="<?php echo e(asset('js/reuse.js')); ?>"></script>
<?php endif; ?>

<?php $__env->startPush('scripts'); ?>
<script>
    setInterval(function() {
        fetch("<?php echo e(route('admin.dashboard.table')); ?>?<?php echo e(http_build_query(request()->all())); ?>")
            .then(response => response.text())
            .then(html => {
                document.getElementById('pending-requests-table').innerHTML = html;
            });
    }, 10000); // every 10 seconds
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/admin/admindashboard.blade.php ENDPATH**/ ?>