<?php

namespace App\Http\Controllers;

use App\Models\empleadosDB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class empleadosController extends Controller
{
    public function mostrarTabla()
    {
        $datos = empleadosDB::all();
        
        return view('empleados', compact('datos'));
    }
}



