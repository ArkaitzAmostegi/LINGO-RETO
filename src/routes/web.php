<?php

use App\Http\Controllers\PalabraController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('lingo.welcome');
});

//Ruta que devuelve todas las palabras de la tabla 'palabras'
Route::get('/palabras', [PalabraController::class, 'index'])->name('palabras.index');

//Ruta que devuelve todas las palabras de la tabla 'palabras' con estilos css
Route::get('/palabrasStyled', [PalabraController::class, 'indexStyled'])->name('palabras.index');

//Ruta que devuelve todas las palabras de la tabla 'palabras' con estilos css
//Route::get('/palabrasBlade', [PalabraController::class, 'indexBlade'])->name('palabras.index');

//Ruta que devuelve de la tabla 'palabras' una palabra aleatoria
//Route::get('/palabrasRandom/', [PalabraController::class, indexRandom'])->name('palabras.indexRandom');

//Ruta que devuelve de la tabla 'palabras' la cantidad de palabras aleatorias solicitada por URL y sino, devuelve 5 palabras
Route::get('/palabrasRandom/{cantidad?}', [PalabraController::class, 'indexRandom'])->name('palabras.indexRandom');

//Rutas que nos llevas a las páginas de acertado y no acertado
Route::view('/acertado', 'lingo.acertado')->name('acertado');
Route::view('/noAcertado', 'lingo.noAcertado')->name('noAcertado');

Route::get('/dashboard', function () {
    return view('lingo.lingo');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
