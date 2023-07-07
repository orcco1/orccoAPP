<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/empleados', [App\Http\Controllers\empleadosController::class, 'mostrarTabla'])->name('empleados.mostrarTabla');

Route::get('/clientes', [App\Http\Controllers\clientesController::class, 'mostrarTabla'])->name('clientes.mostrarTabla');

Route::get('/proyectos', [App\Http\Controllers\proyectosController::class, 'mostrarTabla'])->name('proyectos.mostrarTabla');

