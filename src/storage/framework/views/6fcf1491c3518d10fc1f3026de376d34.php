<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Palabras</title>
</head>
<body>
    <h1>Mi Diccionario</h1>


    <ul>
        <?php $__empty_1 = true; $__currentLoopData = $palabras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palabra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li><?php echo e($palabra->palabra); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li>No hay palabras en la base de datos.</li>
        <?php endif; ?>
    </ul>


</body>
</html>

<?php /**PATH /var/www/html/resources/views/palabras/index.blade.php ENDPATH**/ ?>