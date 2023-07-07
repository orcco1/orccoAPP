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
}
