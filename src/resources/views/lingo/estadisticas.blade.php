<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas</title>
    @vite(['resources/css/resultado.css'])
</head>

<body class="estadisticas">
    <div class="contenedor">
        <img src="imagenes/estadisticas.webp" alt="estadisticas" class="imagen-resultado">
        <h1>Estadísticas del jugador</h1>

        <p class="estadistica"><strong>Nombre:</strong> {{ $nombre }}</p>
        <p class="estadistica"><strong>Porcentaje de victorias:</strong> {{ $porcentajeVictorias }}%</p>
        <p class="estadistica"><strong>Mejor tiempo:</strong> {{ $mejorTiempo }} segundos</p>

        <a href="{{ route('lingo') }}" class="btnJugar">Volver al juego</a>
    </div>
</body>
</html>
