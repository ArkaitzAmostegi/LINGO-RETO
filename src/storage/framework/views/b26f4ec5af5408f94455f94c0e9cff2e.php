<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No has acertado</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/resultado.css', 'resources/js/script.js']); ?>
</head>
<body class="derrota">
    <div class="contenedor">
        <img src="imagenes/gameover.jpg" alt="Derrota" class="imagen-resultado">
        <h1>¡Has perdido!</h1>
        <p>La palabra seguirá siendo un misterio... 😈</p>
        <a href="<?php echo e(route('lingo')); ?>" class="btnJugar">Jugar otra vez</a>
    </div>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/lingo/noAcertado.blade.php ENDPATH**/ ?>