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
}
