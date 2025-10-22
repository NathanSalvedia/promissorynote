<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-100 flex flex-col">

    <!-- Fixed Header -->
    <header class="fixed top-0 left-0 w-full z-50 shadow">
        <?php echo $__env->make('includes.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </header>

    <!-- Main content -->
    <main class="p-2 sm:p-6 max-w-5xl mx-auto w-full mt-28 px-2">
    <div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
        <a href="<?php echo e(route('student.dashboard')); ?>"
           class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow transition w-full sm:w-auto justify-center">
            <iconify-icon icon="mdi:arrow-left"></iconify-icon>
            Back to Dashboard
        </a>
    </div>
    <!-- Card -->
    <div class="bg-white p-4 sm:p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-6">Submit New Promissory Note</h2>
        <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-900 px-4 sm:px-6 py-3 mb-8 rounded-lg font-semibold">
            NOTE: Please ensure that the form is filled out completely.
        </div>
        <form id="promissoryForm"
              action="<?php echo e(route('promissorynotes.store')); ?>"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6"
              data-check-status-url="<?php echo e(route('promissorynote.checkStatus')); ?>">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">


             <div>
                <label for="course" class="<?php $__errorArgs = ['course'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> text-red-600 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> block text-sm font-medium mb-1">Course</label>
                <select id="course"
                        name="course"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm <?php $__errorArgs = ['course'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option value="" disabled <?php echo e(old('course') ? '' : 'selected'); ?>>Select your course</option>
                    <option value="BS Computer Science" <?php echo e(old('course') == 'BS Computer Science' ? 'selected' : ''); ?>>BS Computer Science</option>
                    <option value="BS Information Technology" <?php echo e(old('course') == 'BS Information Technology' ? 'selected' : ''); ?>>BS Information Technology</option>
                    <option value="BS Civil Engineering" <?php echo e(old('course') == 'BS Civil Engineering' ? 'selected' : ''); ?>>BS Civil Engineering</option>
                    <option value="BS Electrical Engineering" <?php echo e(old('course') == 'BS Electrical Engineering' ? 'selected' : ''); ?>>BS Electrical Engineering</option>
                    <option value="BS Mechanical Engineering" <?php echo e(old('course') == 'BS Mechanical Engineering' ? 'selected' : ''); ?>>BS Mechanical Engineering</option>
                    <option value="BS Electronics Engineering" <?php echo e(old('course') == 'BS Electronics Engineering' ? 'selected' : ''); ?>>BS Electronics Engineering</option>
                    <option value="BS Computer Engineering" <?php echo e(old('course') == 'BS Computer Engineering' ? 'selected' : ''); ?>>BS Computer Engineering</option>
                    <option value="BS Business Administration - Major in Marketing Management" <?php echo e(old('course') == 'BS Business Administration - Major in Marketing Management' ? 'selected' : ''); ?>>BS Business Administration - Major in Marketing Management</option>
                    <option value="BS Business Administration - Major in Operation Management" <?php echo e(old('course') == 'BS Business Administration - Major in Operation Management' ? 'selected' : ''); ?>>BS Business Administration - Major in Operation Management</option>
                    <option value="BS Business Administration - Major in Financial Management" <?php echo e(old('course') == 'BS Business Administration - Major in Financial Management' ? 'selected' : ''); ?>>BS Business Administration - Major in Financial Management</option>
                    <option value="BS Business Administration - Major in Human Resource Management" <?php echo e(old('course') == 'BS Business Administration - Major in Human Resource Management' ? 'selected' : ''); ?>>BS Business Administration - Major in Human Resource Management</option>
                    <option value="BS Elementary Education" <?php echo e(old('course') == 'BS Elementary Education' ? 'selected' : ''); ?>>BS Elementary Education</option>
                     <option value="BS Secondary Education - Major in English" <?php echo e(old('course') == 'BS Secondary Education - Major in English' ? 'selected' : ''); ?>>BS Secondary Education - Major in English</option>
                     <option value="BS Secondary Education - Major in Filipino" <?php echo e(old('course') == 'BS Secondary Education - Major in Filipino' ? 'selected' : ''); ?>>BS Secondary Education - Major in Filipino</option>
                      <option value="BS Secondary Education - Major in Math" <?php echo e(old('course') == 'BS Secondary Education - Major in Math' ? 'selected' : ''); ?>>BS Secondary Education - Major in Math</option>
                    <option value="BA of Arts in English Language" <?php echo e(old('course') == 'BA of Arts in English Language' ? 'selected' : ''); ?>>BA of Arts in English Language</option>
                    <option value="BA  Political Science" <?php echo e(old('course') == 'BA  Political Science' ? 'selected' : ''); ?>>BA  Political Science</option>
                    <option value="BA  Filipino" <?php echo e(old('course') == 'BA  Filipino' ? 'selected' : ''); ?>>BA  Filipino</option>
                </select>
                <?php $__errorArgs = ['course'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-600 text-xs"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
             </div>


              <div>
               <label class="block text-sm font-medium mb-1">Department</label>
                <select name="department" class=" block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm <?php $__errorArgs = ['department'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                 <option value="" disabled <?php echo e(old('department') ? '' : 'selected'); ?>>Select your college</option>
                 <option value="College of Arts and Sciences" <?php echo e(old('department') == 'College of Arts and Sciences' ? 'selected' : ''); ?>>College of Arts and Sciences</option>
                 <option value="College of Engineering" <?php echo e(old('department') == 'College of Engineering' ? 'selected' : ''); ?>>College of Engineering</option>
                 <option value="College of Business Administration" <?php echo e(old('department') == 'College of Business Administration' ? 'selected' : ''); ?>>College of Business Administration</option>
                 <option value="College of Education" <?php echo e(old('department') == 'College of Education' ? 'selected' : ''); ?>>College of Education</option>
                 <option value="College of Computer Studies" <?php echo e(old('department') == 'College of Computer Studies' ? 'selected' : ''); ?>>College of Computer Studies</option>
                 <option value="College of Criminology" <?php echo e(old('department') == 'College of Criminology' ? 'selected' : ''); ?>>College of Criminology</option>
               </select>
               <?php $__errorArgs = ['department'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                 <span class="text-red-600 text-xs"><?php echo e($message); ?></span>
               <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
             </div>


             <div>
              <label class="block text-sm font-medium mb-1">Gender</label>
              <select name="gender"  class="<?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
              <option value="">Select Gender</option>
              <option value="Male" <?php echo e(old('gender') == 'Male' ? 'selected' : ''); ?>>Male</option>
              <option value="Female" <?php echo e(old('gender') == 'Female' ? 'selected' : ''); ?>>Female</option>
              </select>
               <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-600 text-xs"><?php echo e($message); ?></span>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
             </div>

              <div>
              <label class="block text-sm font-medium mb-1">Phone Number</label>
              <input type="text" name="phone" value="<?php echo e(old('phone')); ?>" placeholder="+63 912 345 6789"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
              <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-600 text-xs"><?php echo e($message); ?></span>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

               <div>
               <label class="block text-sm font-medium mb-1">Year Level</label>
               <select name="year_level" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm <?php $__errorArgs = ['year_level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <option value="">Select Year</option>
                <option value="1st Year" <?php echo e(old('year_level') == '1st Year' ? 'selected' : ''); ?>>1st Year</option>
                <option value="2nd Year" <?php echo e(old('year_level') == '2nd Year' ? 'selected' : ''); ?>>2nd Year</option>
                <option value="3rd Year" <?php echo e(old('year_level') == '3rd Year' ? 'selected' : ''); ?>>3rd Year</option>
                <option value="4th Year" <?php echo e(old('year_level') == '4th Year' ? 'selected' : ''); ?>>4th Year</option>
                </select>
                <?php $__errorArgs = ['year_level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <span class="text-red-600 text-xs"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>


              <div>
               <label class="block text-sm font-medium mb-1">Amount (₱)</label>
               <input type="number" name="amount" value="<?php echo e(old('amount')); ?>"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
               <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                 <span class="text-red-600 text-xs"><?php echo e($message); ?></span>
               <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

               <div>
              <label class="block text-sm font-medium mb-1">Reason</label>
              <select name="reason" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm <?php $__errorArgs = ['reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" onchange="toggleOtherReasonBox(this)">
               <option value="">Select Reason</option>
               <option value="Financial Problem" <?php echo e(old('reason') == 'Financial Problem' ? 'selected' : ''); ?>>Financial Problem</option>
               <option value="Delayed release of salary or allowance" <?php echo e(old('reason') == 'Delayed release of salary or allowance' ? 'selected' : ''); ?>>Delayed release of salary or allowance</option>
               <option value="Other" <?php echo e(old('reason') == 'Other' ? 'selected' : ''); ?>>Other</option>
               </select>
                <div id="otherReasonBox" style="display:<?php echo e(old('reason') == 'Other' ? 'block' : 'none'); ?>;" class="mt-2">
                 <label class="block text-sm font-medium mb-1">Please specify other reason</label>
                 <textarea name="other_reason" rows="2" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm <?php $__errorArgs = ['other_reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('other_reason')); ?></textarea>
                 <?php $__errorArgs = ['other_reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                   <span class="text-red-600 text-xs"><?php echo e($message); ?></span>
                 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <?php $__errorArgs = ['reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <span class="text-red-600 text-xs"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

             <div>
              <label class="block text-sm font-medium mb-1">Semester</label>
              <select name="semester" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm <?php $__errorArgs = ['semester'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                  <option value="">Select Semester</option>
                  <option value="1st Semester" <?php echo e(old('semester') == '1st Semester' ? 'selected' : ''); ?>>1st Semester</option>
                  <option value="2nd Semester" <?php echo e(old('semester') == '2nd Semester' ? 'selected' : ''); ?>>2nd Semester</option>
                  <option value="Summer" <?php echo e(old('semester') == 'Summer' ? 'selected' : ''); ?>>Summer</option>
              </select>
              <?php $__errorArgs = ['semester'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <span class="text-red-600 text-xs"><?php echo e($message); ?></span>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
             </div>


             <div>
              <label class="block text-sm font-medium mb-1">Term</label>
              <select name="term" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm <?php $__errorArgs = ['term'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                  <option value="">Select Term</option>
                  <option value="Prelim" <?php echo e(old('term') == 'Prelim' ? 'selected' : ''); ?>>Prelim</option>
                  <option value="Midterm" <?php echo e(old('term') == 'Midterm' ? 'selected' : ''); ?>>Midterm</option>
                   <option value="Pre-Finals" <?php echo e(old('term') == 'Pre-Finals' ? 'selected' : ''); ?>>Pre-Finals</option>
                  <option value="Finals" <?php echo e(old('term') == 'Finals' ? 'selected' : ''); ?>>Finals</option>
              </select>
              <?php $__errorArgs = ['term'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <span class="text-red-600 text-xs"><?php echo e($message); ?></span>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
             </div>

             <div>
              <label class="block text-sm font-medium mb-1">Academic Year</label>
              <input type="text" name="academic_year" value="<?php echo e(old('academic_year')); ?>"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm <?php $__errorArgs = ['academic_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
              <?php $__errorArgs = ['academic_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-600 text-xs"><?php echo e($message); ?></span>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
             </div>



               <div>
              <label class="block text-sm font-medium mb-1">Down Payment (₱)</label>
              <input type="number" name="down_payment" value="<?php echo e(old('down_payment')); ?>"
               min="0" step="any"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm <?php $__errorArgs = ['down_payment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                oninput="this.value = this.value < 0 ? 0 : this.value;">
              <?php $__errorArgs = ['down_payment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-600 text-xs"><?php echo e($message); ?></span>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
             </div>

               <div>
              <label class="block text-sm font-medium mb-1">Payment Due Date</label>
              <input type="date" id="due_date" name="due_date" value="<?php echo e(old('due_date')); ?>"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm <?php $__errorArgs = ['due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
              <?php $__errorArgs = ['due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-600 text-xs"><?php echo e($message); ?></span>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
             </div>
             </div>

             <!-- Place supporting documents and signature side by side -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mt-6">
            <div>
                 <label class="block text-sm font-medium mb-1">Upload Supporting Documents</label>
                 <input type="file" name="attachments[]" multiple accept="image/*"
                 class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm <?php $__errorArgs = ['attachments.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <p class="text-xs text-gray-500 mt-1">Attach ID, proof of hardship, etc.</p>
              <?php $__errorArgs = ['attachments.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-600 text-xs"><?php echo e($message); ?></span>
             <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>


    <div class="bg-gray-50 rounded-xl shadow-inner p-4 sm:p-6 mb-4 overflow-x-auto">
    <label class="block text-base font-semibold text-gray-700 mb-3">Electronic Signature</label>
    <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">

        <div class="flex flex-col items-center w-full md:w-auto">
            <canvas id="signature-pad"
                class="border-2 border-dashed border-gray-300 rounded-lg bg-white shadow-sm transition focus:ring-2 focus:ring-[#660809] w-full max-w-xs md:max-w-full"
                style="width:100%;max-width:400px;height:150px;"
                width="400" height="150"></canvas>
            <input type="hidden" name="signature" id="signature">
            <button type="button" onclick="clearSignature()"
                class="mt-3 px-4 py-1.5 bg-[#660809] hover:bg-black text-white rounded-lg text-sm font-medium shadow transition">
                Clear Signature
            </button>
            <?php $__errorArgs = ['signature_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-600 text-xs"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>


    </div>
    <?php $__errorArgs = ['signature'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-red-600 text-xs mt-2 block"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <p class="text-xs text-gray-400 mt-4">Draw your signature above or upload an image. This will serve as your electronic signature for this application.</p>
 </div>
 </div>
 <div class="pt-4">
        <button type="button" onclick="reviewApplication()"
                class="bg-[#660809] hover:bg-[#000000] text-white px-6 py-2 rounded-lg shadow w-full sm:w-auto">
            Review Application
        </button>
    </div>
</div>
</form>
</div>
</main>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let canvas = document.getElementById('signature-pad');
    let signatureInput = document.getElementById('signature');
    if (!canvas) return;
    let ctx = canvas.getContext('2d');
    let drawing = false;

    function getPosition(e) {
        let rect = canvas.getBoundingClientRect();
        if (e.touches) {
            return {
                x: e.touches[0].clientX - rect.left,
                y: e.touches[0].clientY - rect.top
            };
        } else {
            return {
                x: e.clientX - rect.left,
                y: e.clientY - rect.top
            };
        }
    }

    canvas.addEventListener('mousedown', function(e) {
        drawing = true;
        let pos = getPosition(e);
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
    });

    canvas.addEventListener('mouseup', function(e) {
        drawing = false;
        signatureInput.value = canvas.toDataURL();
    });

    canvas.addEventListener('mousemove', function(e) {
        if (!drawing) return;
        let pos = getPosition(e);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
    });

    canvas.addEventListener('mouseout', function(e) {
        drawing = false;
    });


    canvas.addEventListener('touchstart', function(e) {
        drawing = true;
        let pos = getPosition(e);
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
    });

    canvas.addEventListener('touchend', function(e) {
        drawing = false;
        signatureInput.value = canvas.toDataURL();
    });

    canvas.addEventListener('touchmove', function(e) {
        if (!drawing) return;
        let pos = getPosition(e);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
        e.preventDefault();
    });

    canvas.addEventListener('touchcancel', function(e) {
        drawing = false;
    });

    window.clearSignature = function() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        signatureInput.value = '';
    }

    document.getElementById('promissoryForm').addEventListener('submit', function() {
        signatureInput.value = canvas.toDataURL();
    });
});
</script>
<?php $__env->stopSection(); ?>

<style>
@media (max-width: 640px) {
    #signature-pad {
        width: 100% !important;
        max-width: 100% !important;
        height: 120px !important;
    }
}
</style>






<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/student/promissorynote.blade.php ENDPATH**/ ?>