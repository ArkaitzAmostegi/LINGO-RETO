<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/resultado.css']); ?>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: white;
        }
        th, td {
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="ranking">
    <div class="contenedor">
        <img src="imagenes/ranking.webp" alt="ranking" class="imagen-resultado">
        <h1>RANKING GENERAL</h1>

        <table>
            <thead>
                <tr>
                    <th class="col-posicion">Posición</th>
                    <th class="col-nombre">Nombre</th>
                    <th class="col-jugadas">Partidas jugadas</th>
                    <th class="col-ganadas">Partidas ganadas</th>
                    <th class="col-tiempo">Mejor tiempo (s)</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $ranking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $jugador): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="col-posicion"><?php echo e($index + 1); ?></td>
                        <td class="col-nombre"><?php echo e($jugador['nombre']); ?></td>
                        <td class="col-jugadas"><?php echo e($jugador['jugadas']); ?></td>
                        <td class="col-ganadas"><?php echo e($jugador['ganadas']); ?></td>
                        <td class="col-tiempo"><?php echo e($jugador['mejor_tiempo'] !== null ? $jugador['mejor_tiempo'] : '—'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <a href="<?php echo e(route('lingo')); ?>" class="btnJugar">Volver al juego</a>
    </div>
</body>
</html><?php /**PATH /var/www/html/resources/views/lingo/ranking.blade.php ENDPATH**/ ?>