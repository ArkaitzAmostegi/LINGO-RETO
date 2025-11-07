<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PartidaController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Si no hay usuario autenticado, devolvemos 401 (por si la sesión no viaja en el fetch)
            if (!Auth::check()) {
                return response()->json(['ok' => false, 'msg' => 'Unauthenticated'], 401);
            }

            $validated = $request->validate([
                'tiempo'   => 'nullable|integer|min:0',
            ]);

            $acertada = filter_var($request->input('acertada'), FILTER_VALIDATE_BOOLEAN);

            Partida::create([
                'nombre'   => Auth::user()->name,
                'acertada' => $acertada,
                'tiempo'   => $validated['tiempo'] ?? 0,
            ]);

            return response()->json(['ok' => true], 201);
        } catch (\Throwable $e) {
            Log::error('Error guardando partida: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['ok' => false, 'msg' => 'Server error'], 500);
        }
    }

     //Función para las estadísticas
    public function estadisticas()
    {
        if (!Auth::check()) {
            return view('lingo.estadisticas', [
                'nombre' => 'Invitado',
                'porcentajeVictorias' => 0,
                'mejorTiempo' => 0
            ]);
        }

        $nombre = Auth::user()->name;

        //Calcular todo directamente desde SQL (evita problemas con tipos)
        $total = DB::table('partidas')
            ->where('nombre', $nombre)
            ->count();

        $ganadas = DB::table('partidas')
            ->where('nombre', $nombre)
            ->where('acertada', 1)
            ->count();

        $porcentajeVictorias = $total > 0 ? round(($ganadas / $total) * 100, 2) : 0;

        // Calcular el menor tiempo con SQL nativo
        $mejorTiempo = DB::table('partidas')
        ->where('nombre', $nombre)
        ->where('acertada', 1)
        ->where('tiempo', '>', 0) // ignoramos tiempos 0
        ->min('tiempo') ?? 0;


        // Evitar null
        $mejorTiempo = $mejorTiempo ?? 0;

        Log::info("ESTADISTICAS -> usuario: $nombre, ganadas: $ganadas, total: $total, mejorTiempo: $mejorTiempo");

        return view('lingo.estadisticas', compact('nombre', 'porcentajeVictorias', 'mejorTiempo'));
    }


    //Función para el Ranking
    public function ranking()
    {
        // Obtener todos los jugadores únicos
        $jugadores = DB::table('partidas')
            ->select('nombre')
            ->distinct()
            ->pluck('nombre');

        $ranking = [];

        foreach ($jugadores as $nombre) {
            // Todas las partidas de ese jugador
            $partidas = DB::table('partidas')->where('nombre', $nombre)->get();

            $total = $partidas->count();
            $ganadas = $partidas->where('acertada', 1)->count();

            // Mejor tiempo real (sin ceros)
            $mejorTiempo = DB::table('partidas')
                ->where('nombre', $nombre)
                ->where('acertada', 1)
                ->where('tiempo', '>', 0) // ignoramos tiempos nulos o falsos
                ->min('tiempo');

            $ranking[] = [
                'nombre' => $nombre,
                'jugadas' => $total,
                'ganadas' => $ganadas,
                'mejor_tiempo' => $mejorTiempo ?? null,
            ];
        }

        // Ordenar: primero los que tengan victorias, luego por menor tiempo
        usort($ranking, function ($a, $b) {
            if (is_null($a['mejor_tiempo']) && is_null($b['mejor_tiempo'])) return 0;
            if (is_null($a['mejor_tiempo'])) return 1; // sin victorias, va detrás
            if (is_null($b['mejor_tiempo'])) return -1;
            return $a['mejor_tiempo'] <=> $b['mejor_tiempo']; // menor = mejor
        });

        return view('lingo.ranking', compact('ranking'));
    }
}

