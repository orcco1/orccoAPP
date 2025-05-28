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
Route::post('/empleados/crear', [App\Http\Controllers\empleadosController::class, 'guardarEmpleado'])->name('empleados.guardar');
Route::get('/empleados/lista', [App\Http\Controllers\empleadosController::class, 'listaEmpleados'])->name('lista.empleados');


Route::get('/reportes', [App\Http\Controllers\reportesController::class, 'index'])->name('reportes');


Route::get('/clientes', [App\Http\Controllers\clientesController::class, 'mostrarTabla'])->name('clientes.mostrarTabla');
Route::post('/clientes/guardar', [App\Http\Controllers\clientesController::class, 'guardar'])->name('clientes.guardar');
Route::delete('/clientes/eliminar/{id}', [App\Http\Controllers\clientesController::class, 'eliminar'])->name('clientes.eliminar');


Route::get('/proyectos', [App\Http\Controllers\proyectosController::class, 'mostrarTabla'])->name('proyectos.mostrarTabla');
Route::post('/proyectos/guardar', [App\Http\Controllers\proyectosController::class, 'guardar'])->name('guardar.proyecto');
Route::delete('/proyectos/eliminar/{id_proyecto}', [App\Http\Controllers\proyectosController::class, 'eliminar'])->name('eliminar.proyecto');
Route::get('/proyectos/obtener/{id_proyecto}', [App\Http\Controllers\proyectosController::class, 'obtenerProyecto'])->name('obtener.proyecto');
Route::get('/proyectos/editar/{id_proyecto}', [App\Http\Controllers\proyectosController::class, 'obtenerProyecto'])->name('editar.proyecto');
Route::match(['get', 'post'], '/proyectos/editar/{id_proyecto}', [App\Http\Controllers\proyectosController::class, 'guardarEdicion'])->name('editar.proyecto');
Route::post('/proyectos/editar/{id_proyecto}', [App\Http\Controllers\proyectosController::class, 'guardarEdicion'])->name('guardarEdicion.proyecto');
Route::post('/proyectos/asignar', [App\Http\Controllers\proyectosController::class, 'asignarProyecto'])->name('asignar.proyecto');



Route::post('/guardar-formulario', [App\Http\Controllers\TuController::class, 'guardarFormulario'])->name('guardar.formulario');
