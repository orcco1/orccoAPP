<?php

namespace App\Http\Controllers;

use App\Models\clientesDB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class clientesController extends Controller
{
    public function mostrarTabla()
    {
        $datos = clientesDB::all();
        
        return view('clientes', compact('datos'));
    }


    public function guardar(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_empresa' => 'required',
            'telefono' => 'required',
            'correo_electronico' => 'required',
        ]);

        clientesDB::create([
            'nombre_empresa' => $request->nombre_empresa,
            'telefono' => $request->telefono,
            'correo_electronico' => $request->correo_electronico,
        ]);

        return redirect('/clientes')->with('success', 'Cliente registrado con éxito');
    }

    public function eliminar($id)
    {
        try {
            // Eliminar el proyecto de la base de datos
            $cliente = clientesDB::find($id);
            $cliente->delete();
    
            // Devolver una respuesta de éxito en formato JSON
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Devolver una respuesta de error con el mensaje completo del error en formato JSON
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
        return redirect('/clientes')->with('success', 'Cliente eliminado con éxito');

    }
    
}
