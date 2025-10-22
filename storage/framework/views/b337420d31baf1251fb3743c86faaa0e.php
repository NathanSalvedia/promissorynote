<?php $__env->startSection('content'); ?>

<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-gray-100 p-10 rounded-xl shadow-lg w-full max-w-3xl">
        <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Register</h2>
        <form action="<?php echo e(route('register')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="role" value="student">

            <div class="mb-6">
                <label for="fullname" class="block text-md font-medium text-black mb-1">Full Name</label>
                <input type="text" id="fullname" name="fullname" value="<?php echo e(old('fullname')); ?>" class="<?php $__errorArgs = ['fullname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                <?php $__errorArgs = ['fullname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-md font-medium text-black mb-1">Email</label>
                <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" class="<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label for="course" class="<?php $__errorArgs = ['course'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> text-red-600 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> block text-md font-medium text-black mb-1">Course</label>
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
                        <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="student_id" class="block text-md font-medium text-black mb-1">Student ID</label>
                    <input type="text" id="student_id" name="student_id" value="<?php echo e(old('student_id')); ?>" class="<?php $__errorArgs = ['student_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                    <?php $__errorArgs = ['student_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="year" class="block text-md font-medium text-black mb-1">Year</label>
                    <select id="year" name="year" class="<?php $__errorArgs = ['year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                        <option value="" disabled <?php echo e(old('year') ? '' : 'selected'); ?>>Select your year</option>
                        <option value="1" <?php echo e(old('year') == '1' ? 'selected' : ''); ?>>1st Year</option>
                        <option value="2" <?php echo e(old('year') == '2' ? 'selected' : ''); ?>>2nd Year</option>
                        <option value="3" <?php echo e(old('year') == '3' ? 'selected' : ''); ?>>3rd Year</option>
                        <option value="4" <?php echo e(old('year') == '4' ? 'selected' : ''); ?>>4th Year</option>
                    </select>
                    <?php $__errorArgs = ['year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="college" class="block text-md font-medium text-black mb-1">College</label>
                    <select id="college" name="college" class="<?php $__errorArgs = ['college'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                        <option value="" disabled <?php echo e(old('college') ? '' : 'selected'); ?>>Select your college</option>
                        <option value="college of Arts and Sciences" <?php echo e(old('college') == 'college of Arts and Sciences' ? 'selected' : ''); ?>>College of Arts and Sciences</option>
                        <option value="college of Engineering" <?php echo e(old('college') == 'college of Engineering' ? 'selected' : ''); ?>>College of Engineering</option>
                        <option value="college of Business Administration" <?php echo e(old('college') == 'college of Business Administration' ? 'selected' : ''); ?>>College of Business Administration</option>
                        <option value="college of Education" <?php echo e(old('college') == 'college of Education' ? 'selected' : ''); ?>>College of Education</option>
                        <option value="college of Computer Studies" <?php echo e(old('college') == 'college of Computer Studies' ? 'selected' : ''); ?>>College of Computer Studies</option>
                        <option value="college of Criminology" <?php echo e(old('college') == 'college of Criminology' ? 'selected' : ''); ?>>College of Criminology</option>
                    </select>
                    <?php $__errorArgs = ['college'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="gender" class="block text-md font-medium text-black mb-1">Gender</label>
                    <input type="text" id="gender" name="gender" class="<?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                    <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-md font-medium text-black mb-1">Password</label>
                <input type="password" id="password" name="password" class="<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="block text-md font-medium text-black mb-1">Password Confirmation</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
            </div>
            <button type="submit" class="w-full bg-[#660809] text-white py-2 px-4 rounded-md hover:bg-[#000000] transition">
                Register
            </button>
        </form>
        <p class="mt-6 text-md text-gray-600 text-center">
            Already have an account? <a href="<?php echo e(route('login')); ?>" class="text-[#660809] hover:underline">Login</a>
        </p>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/auth/register.blade.php ENDPATH**/ ?>