<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Promissory Note Management System">

    <link rel="icon" href="<?php echo e(asset('img/logo1.png')); ?>" >
    <link rel="manifest" href="<?php echo e(asset('manifest.webmanifest')); ?>">

    <title><?php echo $__env->yieldContent('title', 'Promissory Note Management System'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/reuse.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="bg-gray-100 font-sans">
    <?php echo $__env->yieldContent('content'); ?>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('js/reuse.js')); ?>"></script>
    
    <script src="<?php echo e(asset('js/apexcharts.js')); ?>"></script>
    <script src="<?php echo e(asset('js/analytics.js')); ?>"></script>
    <?php echo $__env->yieldContent('scripts'); ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>

    <?php if(auth()->check()): ?>
    <script>
        setInterval(function() {
            fetch("<?php echo e(auth()->user()->is_admin ? route('admin.notifications.bell') : route('student.notifications.bell')); ?>")
                .then(response => response.text())
                .then(html => {
                    const bell = document.getElementById('notification-bell');
                    if(bell) bell.innerHTML = html;
                });
        }, 10000); // every 10 seconds
    </script>
    <?php endif; ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\promissorynote-app\resources\views/layouts/layout.blade.php ENDPATH**/ ?>