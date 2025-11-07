<?php

namespace App\Http\Controllers;

use App\Models\Palabra;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


class PalabraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $palabras = Palabra::all(); //<-----Usa Eloquent
        return view('palabras.index', ['palabras' => $palabras]);
    }

    public function indexStyled()
    {
        //
        $palabras = Palabra::all(); //<-----Usa Eloquent
        return view('palabras.indexStyled', ['palabras' => $palabras]);
    }
    //Función para traer una cantidad de palabras, en este caso 2
    public function indexRandom($cantidad = 1)
    {
    $palabras = Palabra::inRandomOrder()->take($cantidad)->get();
        
    return view('palabras.index', ['palabras' => $palabras ]);
    }

    // Devuelve una palabra aleatoria como JSON, para utilizarla como ENDPOINT
    public function random(): \Illuminate\Http\JsonResponse
    {
        $palabra = Palabra::inRandomOrder()->first();

        if (!$palabra) {
            return response()->json(['error' => 'No hay palabras en la base de datos'], 404);
        }

        return response()->json([
            'word' => $palabra->palabra
        ]);
    }

    //Comprueba la palabra de línea
    public function check($palabra)
    {
        $palabra = strtolower(trim($palabra));
        $exists = DB::table('palabras')
            ->whereRaw('LOWER(palabra) = ?', [$palabra])
            ->exists();

        return response()->json([
            'word' => $palabra,
            'exists' => $exists
        ]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Palabra $palabra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Palabra $palabra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Palabra $palabra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Palabra $palabra)
    {
        //
    }
}
