<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proyectosDB extends Model
{
    use HasFactory;

    
    protected $table = 'proyectos';
    
    protected $fillable = ['id_proyecto', 'proyecto', 'cliente','fecha_inicio','activo'];
    
}
