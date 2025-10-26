<?php $__env->startSection('content'); ?>
<?php echo $__env->make('includes.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
 <div class="bg-white rounded-xl shadow p-6 mt-6 w-full">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Payment Tracking</h2>
        <div class="flex gap-2">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-100">
                <iconify-icon icon="mdi:cash" class="text-green-600 text-2xl"></iconify-icon>
            </div>
            <div>
                <div class="text-sm text-white">Total Collected</div>
                <div class="text-2xl font-bold text-white">₱<?php echo e(number_format($totalCollected, 2)); ?></div>
            </div>
        </div>

        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100">
                <iconify-icon icon="mdi:percent" class="text-blue-600 text-2xl"></iconify-icon>
            </div>
            <div>
                <div class="text-sm text-white">Avg Down Payment</div>
                <div class="text-2xl font-bold text-white">₱<?php echo e(number_format($avgDownPayment, 2)); ?></div>
            </div>
        </div>

        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-100">
                <iconify-icon icon="mdi:clock-outline" class="text-orange-600 text-2xl"></iconify-icon>
            </div>

            <div>
                <div class="text-sm text-white">Pending Payments</div>
                <div class="text-2xl font-bold text-white"><?php echo e($pendingPayments); ?></div>
            </div>
        </div>
        <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100">
                <iconify-icon icon="mdi:alert" class="text-red-600 text-2xl"></iconify-icon>
            </div>
            <div>
                <div class="text-sm text-white">Overdue</div>
                <div class="text-2xl font-bold text-white"><?php echo e($overdue); ?></div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow border overflow-hidden">
        <div class="px-6 py-4 bg-[#660809] border-b">
         <h3 class="text-xl font-bold text-white">Payment Tracking</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-lg">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 font-semibold text-left">PN ID</th>
                        <th class="px-4 py-2 font-semibold text-left">Full Name</th>
                        <th class="px-4 py-2 font-semibold text-left">Amount</th>
                        <th class="px-4 py-2 font-semibold text-left">Down Payment</th>
                        <th class="px-4 py-2 font-semibold text-left">Due Date</th>
                        <th class="px-4 py-2 font-semibold text-left">Status</th>
                        <th class="px-4 py-2 font-semibold text-left">Actions</th>
                    </tr>
                </thead>
                <tbody id="payment-tracking-table">
                    <?php echo $__env->make('admin.partials.payment-tracking-table', ['notes' => $notes], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
setInterval(function() {
    fetch('/admin/payment-tracking-table')
        .then(res => res.text())
        .then(html => {
            document.getElementById('payment-tracking-table').innerHTML = html;
        });
}, 10000);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/admin/payment-tracking.blade.php ENDPATH**/ ?>