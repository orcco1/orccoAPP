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

        return redirect('/clientes')->with('success', 'Proyecto registrado con éxito');
    }

}
