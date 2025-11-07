
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego</title>
    <link href="https://fonts.cdnfonts.com/css/iris" rel="css/stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <header>
        <div class="logo">
            <img src="imagenes/Logo/Logo3.png" alt="">
        </div>
        <div class="texto">
            <h1>PARANOIC GAMES - MIND BLOWING GAMES</h1>
        </div>
        @auth
            <div class="usuario">
                <h3>Hola, {{ Auth::user()->name }}</h3>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Cerrar sesión</button>
                </form>
            </div>
        @endauth

        @guest
            <div class="usuario">
                <a href="{{ route('login') }}">Iniciar sesión</a>
                <a href="{{ route('register') }}">Registrarse</a>
            </div>
        @endguest
    </header>
    <nav>
        <div class="btn jugar">JUGAR</div>
        <a href="{{ route('estadisticas') }}" class="btn estadisticas">ESTADÍSTICAS</a>
        <a href="{{ route('ranking') }}" class="btn ranking">RANKING</a>
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
    
    @vite(['resources/css/style.css', 'resources/js/script.js'])
</body>
</html>
