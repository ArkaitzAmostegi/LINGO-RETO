<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
}
