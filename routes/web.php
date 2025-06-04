<?php

use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('cursos.index');
});

Route::resource('cursos', CursoController::class);
Route::resource('docentes', DocenteController::class);