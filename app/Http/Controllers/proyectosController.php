<?php

namespace App\Http\Controllers;

use App\Models\proyectosDB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


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
            'id_proyecto' => 'required',
            'proyecto' => 'required',
            'cliente' => 'required',
            'fecha_inicio' => 'required|date',
            'activo' => 'required|boolean',
            'ubicacion' => 'required',
        ]);
    
        // Crear un nuevo proyecto en la base de datos
        proyectosDB::create([
            'id_proyecto'=> $request->id_proyecto,
            'proyecto' => $request->proyecto,
            'cliente' => $request->cliente,
            'fecha_inicio' => $request->fecha_inicio,
            'activo' => $request->activo,
            'ubicacion' => $request->ubicacion,
        ]);
    
        // Redireccionar a la página de proyectos después de guardar
        return redirect('/proyectos')->with('success', ' ');
    }

   
    public function eliminar($id_proyecto)
    {
        try {
            // Eliminar el proyecto de la base de datos
            $proyecto = proyectosDB::find($id_proyecto);
            $proyecto->delete();
    
            // Devolver una respuesta de éxito
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Devolver una respuesta de error con el mensaje completo del error
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    
    

}