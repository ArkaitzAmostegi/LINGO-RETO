<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    public function index()
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
}
