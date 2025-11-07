<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Has Ganado!</title>
    @vite(['resources/css/resultado.css', 'resources/js/script.js'])
</head>
<body class="victoria">
    <div class="contenedor">
        <img src="imagenes/victory.jpg" alt="Victoria" class="imagen-resultado">
        <h1>¡Felicidades!</h1>
        <p>Has acertado la palabra secreta 🎯</p>
        <a href="{{ route('lingo') }}" class="btnJugar">Jugar otra vez</a>
    </div>
</body>
</html>
