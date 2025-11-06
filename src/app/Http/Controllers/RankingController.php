<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function index()
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
