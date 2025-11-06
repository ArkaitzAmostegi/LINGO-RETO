<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
    @vite(['resources/css/resultado.css'])
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
                @foreach($ranking as $index => $jugador)
                    <tr>
                        <td class="col-posicion">{{ $index + 1 }}</td>
                        <td class="col-nombre">{{ $jugador['nombre'] }}</td>
                        <td class="col-jugadas">{{ $jugador['jugadas'] }}</td>
                        <td class="col-ganadas">{{ $jugador['ganadas'] }}</td>
                        <td class="col-tiempo">{{ $jugador['mejor_tiempo'] !== null ? $jugador['mejor_tiempo'] : '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('lingo') }}" class="btnJugar">Volver al juego</a>
    </div>
</body>
</html>