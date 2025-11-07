
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego</title>
    <link href="https://fonts.cdnfonts.com/css/iris" rel="css/stylesheet">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>

<body>
    <header>
        <div class="logo">
            <img src="imagenes/Logo/Logo3.png" alt="">
        </div>
        <div class="texto">
            <h1>PARANOIC GAMES - MIND BLOWING GAMES</h1>
        </div>
        <?php if(auth()->guard()->check()): ?>
            <div class="usuario">
                <h3>Hola, <?php echo e(Auth::user()->name); ?></h3>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit">Cerrar sesión</button>
                </form>
            </div>
        <?php endif; ?>

        <?php if(auth()->guard()->guest()): ?>
            <div class="usuario">
                <a href="<?php echo e(route('login')); ?>">Iniciar sesión</a>
                <a href="<?php echo e(route('register')); ?>">Registrarse</a>
            </div>
        <?php endif; ?>
    </header>
    <nav>
        <div class="btn jugar">JUGAR</div>
        <a href="<?php echo e(route('estadisticas')); ?>" class="btn estadisticas">ESTADÍSTICAS</a>
        <a href="<?php echo e(route('ranking')); ?>" class="btn ranking">RANKING</a>
        <div class="btn idioma">IDIOMA</div>
    </nav>
    <section>
        <main>
            <div class="container">
                <div id="container-tabla"></div>
                <div id="container-teclado"></div>
            </div>
        </main>

        <aside>
            <div class="estadisticas bloque1">
                <div class="titulo">
                    <H1>TIEMPO POR PARTIDA</H1>
                </div>
                <div class="tiempo">
                    <img id="partida-centenas" src="imagenes/Numeros/1.png" alt="centenas">
                    <img id="partida-decenas" src="imagenes/Numeros/8.png" alt="decenas">
                    <img id="partida-unidades" src="imagenes/Numeros/0.png" alt="unidades">
                </div>
            </div>
            <div class="estadisticas bloque2">
                <div class="titulo">
                    <h1>TIEMPO POR LÍNEA</h1>
                </div>
                <div class="tiempo">
                    <img id="linea-decenas" src="imagenes/Numeros/6.png" alt="decenas">
                    <img id="linea-unidades" src="imagenes/Numeros/0.png" alt="unidades">
                </div>
            </div>
        </aside>
    </section>
    <footer> 
        <div class="texto">
            <p>Dirección: Visionary Street, 321 - Irun</p>
            <p>Móvil: +34 006 123 321</p>
        </div>
        <div class="texto">
            <p>Email: psicotic@paranoicgames.com</p>
            <p>@Copyright Paranoic Games</p>
        </div>
        <div class="imagen">
            <img src="imagenes/Logo/logo5.png" alt="">
        </div>
    </footer>
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/style.css', 'resources/js/script.js']); ?>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/lingo/lingo.blade.php ENDPATH**/ ?>