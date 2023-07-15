<?php

namespace App\Http\Controllers;

use App\Models\empleadosDB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    public function mostrarTabla()
    {
        $datos = empleadosDB::all();
        
        return view('empleados', compact('datos'));
    }

    public function guardarEmpleado(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_completo' => 'required',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required',
            'telefono_emergencia' => 'required',
            'salario' => 'required|numeric',
            'fecha_registro' => 'required|date',
            'activo' => 'required|boolean',
            'email' => 'required|email|unique:empleados',
        ]);

        // Crear un nuevo empleado en la base de datos
        empleadosDB::create([
            'nombre_completo' => $request->nombre_completo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono' => $request->telefono,
            'telefono_emergencia' => $request->telefono_emergencia,
            'salario' => $request->salario,
            'fecha_registro' => $request->fecha_registro,
            'activo' => $request->activo,
            'email' => $request->email,
        ]);

        // Redireccionar a la página de la tabla de empleados con un mensaje de éxito
        return redirect()->route('empleados.mostrarTabla')->with('success', 'Empleado creado exitosamente.');
    }

  

}
