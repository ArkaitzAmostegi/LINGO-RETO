<?php

use App\Http\Controllers\PalabraController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartidaController;


Route::get('/', function () {
    return view('lingo.welcome');
});

//Ruta que devuelve todas las palabras de la tabla 'palabras'
//Route::get('/palabras', [PalabraController::class, 'index'])->name('palabras.index');

//Ruta que devuelve todas las palabras de la tabla 'palabras' con estilos css
//Route::get('/palabrasStyled', [PalabraController::class, 'indexStyled'])->name('palabras.index');

//Ruta que devuelve todas las palabras de la tabla 'palabras' con estilos css
//Route::get('/palabrasBlade', [PalabraController::class, 'indexBlade'])->name('palabras.index');

//Ruta que devuelve de la tabla 'palabras' una palabra aleatoria
//Route::get('/palabrasRandom/', [PalabraController::class, indexRandom'])->name('palabras.indexRandom');

//Ruta que devuelve de la tabla 'palabras' la cantidad de palabras aleatorias solicitada por URL y sino, devuelve 5 palabras
Route::get('/palabrasRandom/{cantidad?}', [PalabraController::class, 'indexRandom'])->name('palabras.indexRandom');

//Rutas que nos llevas a las diferentes páginas del juego: lingo, acertado y no acertado, estadisticas y ranking
Route::view('/acertado', 'lingo.acertado')->middleware(['auth', 'verified'])->name('acertado');
Route::view('/noAcertado', 'lingo.noAcertado')->middleware(['auth', 'verified'])->name('noAcertado');
Route::get('/lingo', function(){return view('lingo.lingo');})->middleware(['auth', 'verified'])->name('lingo');
//?? Podría ser en vez del anterior? Route::view('/lingo', 'lingo.lingo')->name('lingo');
Route::view('/estadisticas', 'lingo.estadisticas')->middleware(['auth', 'verified'])->name('estadisticas');
Route::view('/ranking', 'lingo.ranking')->middleware(['auth', 'verified'])->name('ranking');

//Rutas para las estadisticas y ranking al controller de cada una
Route::get('/estadisticas', [PartidaController::class, 'estadisticas'])->middleware(['auth', 'verified'])->name('estadisticas');
Route::get('/ranking', [PartidaController::class, 'ranking'])->middleware(['auth', 'verified'])->name('ranking');



Route::get('/dashboard', function () {
    return view('lingo.lingo');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Ruta para guardar la partida, está en el auth, para aprovechar la autenticación del usuario
    Route::post('/guardarPartida', [PartidaController::class, 'store'])->middleware(['auth', 'verified'])->name('partida.store');
});

require __DIR__.'/auth.php';
