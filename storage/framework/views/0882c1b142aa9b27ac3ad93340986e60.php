<?php $__env->startSection('content'); ?>

 <div class="flex items-center justify-center min-h-screen bg-gray-100">
   <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md text-center">

     <img src="<?php echo e(asset('img/logo.jpg')); ?>" alt="Logo" class="mx-auto mb-4 w-24 h-24 rounded-full">

     <h2 class="text-xl font-bold">
        <span class="text-black hover:underline hover:text-green-700">My.SPC</span> <span class="text-black">» Sign In</span>
     </h2>

  <form action="<?php echo e(route('admin.login')); ?>" class="mt-6 text-left" method="POST">
        <?php echo csrf_field(); ?>
       <input type="email" id="email"  name="email" value="<?php echo e(old('email')); ?>" placeholder="Email" class="<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> block w-full px-3 py-2 mb-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
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

        <input type="password" id="password" name="password" placeholder="Password" class="<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> block w-full px-3 py-2  mb-5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
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

      <button type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg mx-auto block">
        Sign In
      </button>
        </form>
   </div>
 </div>

 <footer class="mt-6 text-center text-sm">
    <a href="#" class="text-green-700 hover:underline">My.SPC</a> ·
    <a href="#" class="text-green-700 hover:underline">St. Peter’s College, Inc.</a>
</footer>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/admin/login.blade.php ENDPATH**/ ?>