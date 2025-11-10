<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/css/tituloRegistro.css', 'resources/js/app.js']); ?>

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-b from-blue-400 to-blue-800">
            <div class="decoration flex flex-col items-center justify-center space-y-2">
                <div class="logo">
                    <img src="<?php echo e(asset('imagenes/Logo/logo5.png')); ?>" alt="logo" class="mx-auto w-48 h-auto">
                </div>
                <div class="titulo-paranoic flex justify-center space-x-1">
                    <a href="/" class="flex">
                        <img src="<?php echo e(asset('imagenes/verdes/09.png')); ?>" alt="P" class="w-8 h-8 sm:w-10 sm:h-10">
                        <img src="<?php echo e(asset('imagenes/verdes/10.png')); ?>" alt="A" class="w-8 h-8 sm:w-10 sm:h-10">
                        <img src="<?php echo e(asset('imagenes/verdes/03.png')); ?>" alt="R" class="w-8 h-8 sm:w-10 sm:h-10">
                        <img src="<?php echo e(asset('imagenes/verdes/10.png')); ?>" alt="A" class="w-8 h-8 sm:w-10 sm:h-10">
                        <img src="<?php echo e(asset('imagenes/verdes/26.png')); ?>" alt="N" class="w-8 h-8 sm:w-10 sm:h-10">
                        <img src="<?php echo e(asset('imagenes/verdes/08.png')); ?>" alt="O" class="w-8 h-8 sm:w-10 sm:h-10">
                        <img src="<?php echo e(asset('imagenes/verdes/07.png')); ?>" alt="I" class="w-8 h-8 sm:w-10 sm:h-10">
                        <img src="<?php echo e(asset('imagenes/verdes/23.png')); ?>" alt="C" class="w-8 h-8 sm:w-10 sm:h-10">
                    </a>
                </div>
                <div class="titulo-paranoic flex justify-center space-x-1 mt-6">
                    <a href="/" class="flex">
                        <img src="<?php echo e(asset('imagenes/verdes/14.png')); ?>" alt="G" class="w-8 h-8 sm:w-10 sm:h-10">
                        <img src="<?php echo e(asset('imagenes/verdes/10.png')); ?>" alt="A" class="w-8 h-8 sm:w-10 sm:h-10">
                        <img src="<?php echo e(asset('imagenes/verdes/27.png')); ?>" alt="M" class="w-8 h-8 sm:w-10 sm:h-10">
                        <img src="<?php echo e(asset('imagenes/verdes/02.png')); ?>" alt="E" class="w-8 h-8 sm:w-10 sm:h-10">
                        <img src="<?php echo e(asset('imagenes/verdes/11.png')); ?>" alt="S" class="w-8 h-8 sm:w-10 sm:h-10">
                    </a>
                </div>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <?php echo e($slot); ?>

            </div>
        </div>
    </body>
</html>
<?php /**PATH /var/www/html/resources/views/layouts/guest.blade.php ENDPATH**/ ?>