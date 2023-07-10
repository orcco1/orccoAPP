<?php

namespace App\Http\Controllers;

use App\Models\proyectosDB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class proyectosController extends Controller
{
    public function mostrarTabla()
    {
        $datos = proyectosDB::all();
        
        return view('proyectos', compact('datos'));
    }


    public function guardar(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'proyecto' => 'required',
        'cliente' => 'required',
        'fecha_inicio' => 'required|date',
        'activo' => 'required|boolean',
    ]);

    // Crear un nuevo proyecto en la base de datos
    proyectosDB::create([
        'proyecto' => $request->proyecto,
        'cliente' => $request->cliente,
        'fecha_inicio' => $request->fecha_inicio,
        'activo' => $request->activo,
    ]);

    // Redireccionar a la página de proyectos después de guardar
    return redirect('/proyectos')->with('success', 'Proyecto creado correctamente.');
}

}
