<?php

namespace App\Http\Controllers;

use App\Models\empleadosDB; 
use App\Models\proyectosDB;
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
        $request->validate([
            'proyecto' => 'required',
            'cliente' => 'required',
            'encargado' => 'required',
            'fecha_inicio' => 'required|date',
            'activo' => 'required|boolean',
            'ubicacion' => 'required',
        ]);

        proyectosDB::create([
            'proyecto' => $request->proyecto,
            'cliente' => $request->cliente,
            'encargado' => $request->encargado,
            'fecha_inicio' => $request->fecha_inicio,
            'activo' => $request->activo,
            'ubicacion' => $request->ubicacion,
        ]);

        return redirect('/proyectos')->with('success', 'Proyecto registrado con éxito');
    }

    public function obtenerProyecto($id_proyecto)
    {
        try {
            $proyecto = proyectosDB::find($id_proyecto);
            if ($proyecto) {
                return response()->json(['success' => true, 'proyecto' => $proyecto]);
            } else {
                return response()->json(['success' => false, 'message' => 'El proyecto no existe']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function guardarEdicion(Request $request, $id_proyecto)
    {
        $request->validate([
            'proyecto_editar' => 'required',
            'cliente_editar' => 'required',
            'encargado_editar' => 'required',
            'fecha_inicio_editar' => 'required|date',
            'ubicacion_editar' => 'required',
            'activo_editar' => 'required|boolean',
        ]);
    
        try {
            $proyecto = proyectosDB::find($id_proyecto);
            if ($proyecto) {
                $proyecto->proyecto = $request->proyecto_editar;
                $proyecto->cliente = $request->cliente_editar;
                $proyecto->encargado = $request->encargado_editar;
                $proyecto->fecha_inicio = $request->fecha_inicio_editar;
                $proyecto->ubicacion = $request->ubicacion_editar;
                $proyecto->activo = $request->activo_editar;
                $proyecto->save();

                return redirect('/proyectos')->with('success', 'Cambios guardados con éxito');
            } else {
                return redirect('/proyectos')->withErrors('El proyecto no existe');
            }
        } catch (\Exception $e) {
            return redirect('/proyectos')->withErrors($e->getMessage());
        }
    }

    public function eliminar($id_proyecto)
    {
        try {
            $proyecto = proyectosDB::find($id_proyecto);
            $proyecto->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function asignarProyecto(Request $request)
    {
        $proyectoId = $request->input('id_proyecto');
        $empleadosSeleccionados = $request->input('empleadosSeleccionados');

        $proyecto = proyectosDB::find($proyectoId);
        if ($proyecto) {
            foreach ($empleadosSeleccionados as $correo) {
                $empleado = empleadosDB::where('email', $correo)->first();
                if ($empleado) {
                    $empleado->proyectos()->attach($proyecto->id);
                }
            }

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Proyecto no encontrado']);
        }
    }
}
