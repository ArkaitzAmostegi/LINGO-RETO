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
                'acertada' => 'required|boolean',
                'tiempo'   => 'nullable|integer|min:0',
            ]);

            Partida::create([
                'nombre'   => Auth::user()->name,
                'acertada' => $validated['acertada'],
                'tiempo'   => !empty($validated['acertada']) ? ($validated['tiempo'] ?? 0) : 0,
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
        // Obtener el nombre del usuario autenticado
        $nombre = Auth::user()->name ?? 'Invitado';

        // Si el usuario no está autenticado, devolvemos valores vacíos
        if (!Auth::check()) {
            return view('lingo.estadisticas', [
                'nombre' => 'Invitado',
                'porcentajeVictorias' => 0,
                'mejorTiempo' => 0
            ]);
        }

        // Consultar todas las partidas del usuario autenticado
        $partidas = DB::table('partidas')->where('nombre', $nombre)->get();

        if ($partidas->isEmpty()) {
            $porcentajeVictorias = 0;
            $mejorTiempo = 0;
        } else {
            $total = $partidas->count();
            $ganadas = $partidas->where('acertada', 1)->count();
            $porcentajeVictorias = round(($ganadas / $total) * 100, 2);

            // Obtener el menor tiempo de las partidas ganadas
            $mejorTiempo = $partidas
                ->where('acertada', 1)
                ->min('tiempo') ?? 0;
        }

        // Pasar los datos a la vista
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
            $partidas = DB::table('partidas')->where('nombre', $nombre)->get();

            $total = $partidas->count();
            $ganadas = $partidas->where('acertada', 1)->count();

            // Tiempo más rápido entre las partidas ganadas (récord)
            $mejorTiempo = $ganadas > 0
                ? $partidas->where('acertada', 1)->min('tiempo')
                : null;

            $ranking[] = [
                'nombre' => $nombre,
                'jugadas' => $total,
                'ganadas' => $ganadas,
                'mejor_tiempo' => $mejorTiempo,
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
