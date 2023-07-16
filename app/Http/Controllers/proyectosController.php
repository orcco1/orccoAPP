<?php

namespace App\Http\Controllers;

use App\Models\empleadosDB; 
use App\Models\proyectosDB;
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
            'encargado' => 'required',
            'fecha_inicio' => 'required|date',
            'activo' => 'required|boolean',
            'ubicacion' => 'required',
        ]);

        // Verificar si ya existe un proyecto con el mismo id_proyecto
        $proyectoExistente = proyectosDB::where('id_proyecto', $request->id_proyecto)->first();
        if ($proyectoExistente) {
            return redirect('/proyectos')->withErrors('Ya existe un proyecto con ese ID.');
        }

        // Crear un nuevo proyecto en la base de datos
        proyectosDB::create([
            'id_proyecto' => $request->id_proyecto,
            'proyecto' => $request->proyecto,
            'cliente' => $request->cliente,
            'encargado' => $request ->encargado,
            'fecha_inicio' => $request->fecha_inicio,
            'activo' => $request->activo,
            'ubicacion' => $request->ubicacion,
        ]);

        // Redireccionar a la página de proyectos después de guardar
        return redirect('/proyectos')->with('success', 'Proyecto registrado con éxito');
    }

    public function obtenerProyecto($id_proyecto)
    {
        try {
            // Obtener el proyecto de la base de datos
            $proyecto = proyectosDB::find($id_proyecto);

            // Verificar si se encontró el proyecto
            if ($proyecto) {
                // Devolver una respuesta con los datos del proyecto
                return response()->json(['success' => true, 'proyecto' => $proyecto]);
            } else {
                // Devolver una respuesta de error si no se encontró el proyecto
                return response()->json(['success' => false, 'message' => 'El proyecto no existe']);
            }
        } catch (\Exception $e) {
            // Devolver una respuesta de error con el mensaje completo del error
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function guardarEdicion(Request $request, $id_proyecto)
    {
        // Validar los datos del formulario de edición
        $request->validate([
            'proyecto_editar' => 'required',
            'cliente_editar' => 'required',
            'encargado_editar' => 'required',
            'fecha_inicio_editar' => 'required|date',
            'ubicacion_editar' => 'required',
            'activo_editar' => 'required|boolean',
        ]);
    
        try {
            // Obtener el proyecto de la base de datos
            $proyecto = proyectosDB::find($id_proyecto);
    
            // Verificar si se encontró el proyecto
            if ($proyecto) {
                // Actualizar los datos del proyecto
                $proyecto->proyecto = $request->proyecto_editar;
                $proyecto->cliente = $request->cliente_editar;
                $proyecto->encargado = $request->encargado_editar;
                $proyecto->fecha_inicio = $request->fecha_inicio_editar;
                $proyecto->ubicacion = $request->ubicacion_editar;
                $proyecto->activo = $request->activo_editar;
                $proyecto->save();
    
                // Redireccionar a la página de proyectos después de guardar los cambios
                return redirect('/proyectos')->with('success', 'Cambios guardados con éxito');
            } else {
                // Devolver una respuesta de error si no se encontró el proyecto
                return redirect('/proyectos')->withErrors('El proyecto no existe');
            }
        } catch (\Exception $e) {
            // Devolver una respuesta de error con el mensaje completo del error
            return redirect('/proyectos')->withErrors($e->getMessage());
        }
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





    public function asignarProyecto(Request $request)
    {
        $proyectoId = $request->input('id_proyecto');
        $empleadosSeleccionados = $request->input('empleadosSeleccionados'); // Cambio aquí
    
        $proyecto = proyectosDB::find($proyectoId);
        if ($proyecto) {
            foreach ($empleadosSeleccionados as $correo) { // Cambio aquí
                // Aquí deberías obtener al empleado por el correo y asignarle el proyecto
                // Por ejemplo, si tienes una relación en el modelo Empleado llamada "proyectos", puedes hacer algo como:
                $empleado = empleadosDB::where('email', $email)->first(); // Cambio aquí
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
