<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class reportesController extends Controller
{
    public function index()
    {
        // Add any necessary data/logic here if needed for the reportes view
        return view('reportes');
    }
}
