<?php
    use Carbon\Carbon;
?>



<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-100 flex flex-col items-center">
    <div class="w-full flex justify-center pb-12">
        <article
            class="bg-white rounded-2xl shadow-xl print:shadow-none border border-gray-200"
            style="width: 210mm; min-height: 297mm; max-width: 100%; margin: 0; padding: 0;">
            <div class="text-gray-900 text-base leading-normal p-6 sm:p-10">

                
                <header class="text-center mb-10">
                    <div class="flex items-center justify-center gap-6 mb-2">
                        <img src="<?php echo e(asset('img/logo.jpg')); ?>"
                             alt="School Logo"
                             class="w-20 h-20 object-contain rounded-full border border-gray-200">
                        <div class="text-left">
                            <p style="font-family: 'Times New Roman', Times, serif; font-weight: bold; font-size: 2rem; color: #660809; margin-bottom: 0;">
                                St. Peter's College
                            </p>
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 1rem;">
                                042 Sabayle St, Iligan City, 9200 Philippines<br>
                                Contact No.: (063)221-6246 or 222-0460<br>
                                Email Address: <span style="color: #2563eb;">OPsecretary@spc.edu.ph</span>
                            </p>
                        </div>
                    </div>
                    <h1 style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 1.7rem; margin-top: 2rem; letter-spacing: 1px;">
                        PROMISSORY FORM<br>
                        <span style="font-size: 1.5rem;">DETAILS</span>
                    </h1>
                </header>

                
                <section class="card-section mb-8">
                    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                            <div>
                                <span class="font-semibold text-gray-700">Date of Application:</span>
                                <span class="ml-2 text-gray-900"><?php echo e(Carbon::parse($note->created_at)->format('F d, Y')); ?></span>
                            </div>
                            <div>
                                <span class="font-semibold text-gray-700">School ID No.:</span>
                                <span class="ml-2 text-gray-900"><?php echo e($note->user->student_id ?? $note->student_id ?? 'N/A'); ?></span>
                            </div>
                            <div>
                                <span class="font-semibold text-gray-700">Name of Student:</span>
                                <span class="ml-2 text-gray-900"><?php echo e($note->user->fullname ?? $note->fullname ?? 'N/A'); ?></span>
                            </div>
                            <div>
                                <span class="font-semibold text-gray-700 ">Program & Year:</span>
                                <span class="ml-2 text-gray-900"><?php echo e($note->course ?? '-'); ?><?php echo e($note->year_level ? ' - ' . $note->year_level : ''); ?></span>
                            </div>
                            <div>
                                <span class="font-semibold text-gray-700">Contact No.:</span>
                                <span class="ml-2 text-gray-900"><?php echo e($note->phone ?? '-'); ?></span>
                            </div>
                            <div>
                                <span class="font-semibold text-gray-700">Gender:</span>
                                <span class="ml-2 text-gray-900"><?php echo e($note->gender ?? '-'); ?></span>
                            </div>
                        </div>
                    </div>
                </section>

                
                <section class="card-section mb-8">
                    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                        <h3 class="section-title text-center font-bold mb-4 text-lg">Tuition Fee Status</h3>
                        <div class="tuition-list">
                            <div class="tuition-row flex justify-between py-2 border-b">
                                <span class="tuition-label font-semibold text-gray-700">Balance (Assessment):</span>
                                <span class="tuition-value font-bold text-red-700">₱<?php echo e(number_format($assessmentBalance ?? 0, 2)); ?></span>
                            </div>
                            <div class="tuition-row flex justify-between py-2 border-b">
                                <span class="tuition-label font-semibold text-gray-700">Partial Payment:</span>
                                <span class="tuition-value font-bold text-gray-900">₱<?php echo e(number_format($partialPayment ?? 0, 2)); ?></span>
                            </div>
                            <div class="tuition-row flex justify-between py-2 border-b">
                                <span class="tuition-label font-semibold text-gray-700">Downpayment:</span>
                                <span class="tuition-value font-bold text-gray-900">
                                    ₱<?php echo e(number_format($note->downpayment ?? $note->down_payment ?? $note->down_payment_amount ?? 0, 2)); ?>

                                </span>
                            </div>
                            <div class="tuition-row flex justify-between py-2 border-b">
                                <span class="tuition-label font-semibold text-gray-700">Remaining Balance:</span>
                                <span class="tuition-value font-bold text-red-700">₱<?php echo e(number_format($remainingBalance ?? 0, 2)); ?></span>
                            </div>
                            <div class="tuition-row flex justify-between py-2 border-b">
                                <span class="tuition-label font-semibold text-gray-700">Due Date:</span>
                                <span class="tuition-value text-gray-900"><?php echo e($note->due_date ?? '-'); ?></span>
                            </div>
                            <div class="tuition-row flex justify-between py-2">
                                <span class="tuition-label font-semibold text-gray-700">Reason:</span>
                                <span class="tuition-value text-gray-900">
                                    <?php echo e($note->reason); ?>

                                    <?php if(strtolower($note->reason ?? '') === 'other' && !empty($note->other_reason)): ?>
                                        - <?php echo e($note->other_reason); ?>

                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </section>

                
                <section class="card-section mb-8">
                    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                        <span class="font-semibold text-lg mb-4 block text-gray-700">Attachments:</span>
                        <?php
                            $imageExts = ['jpg','jpeg','png','gif','bmp','webp'];
                            $images = [];
                            if($note->supportingDocuments) {
                                foreach($note->supportingDocuments as $doc) {
                                    $ext = strtolower(pathinfo($doc->file_name, PATHINFO_EXTENSION));
                                    if(in_array($ext, $imageExts)) { $images[] = $doc; }
                                }
                            }
                        ?>
                        <?php if(count($images) > 0): ?>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="w-full h-56 overflow-hidden rounded-lg border border-gray-300 shadow-sm bg-gray-100 flex items-center justify-center">
                                        <img src="<?php echo e(asset('storage/' . $img->file_path)); ?>" alt="Attachment"
                                             class="max-w-full max-h-full object-contain" />
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <div class="mt-2 text-base text-gray-500">No attachments</div>
                        <?php endif; ?>
                    </div>
                </section>

                
                <?php if(!empty($note->signature_path)): ?>
                <section class="card-section mb-8">
                    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                        <span class="font-semibold text-lg mb-4 block text-gray-700">Signature:</span>
                        <div class="w-64 h-40 flex items-center justify-center border border-gray-300 rounded bg-gray-50 mx-auto">
                            <img
                                src="<?php echo e(asset('storage/' . ltrim($note->signature_path, '/'))); ?>"
                                alt="Signature"
                                class="max-w-full max-h-full object-contain"
                                style="background: #fff;"
                                onerror="this.onerror=null;this.src='<?php echo e(asset('img/no-signature.png')); ?>';"
                            />
                        </div>
                    </div>
                </section>
                <?php endif; ?>

            </div>
        </article>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/admin/pdf/archived-note.blade.php ENDPATH**/ ?>