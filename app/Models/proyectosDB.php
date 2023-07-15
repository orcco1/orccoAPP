<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proyectosDB extends Model
{
    use HasFactory;

    
    protected $table = 'proyectos';
    protected $primaryKey = 'id_proyecto';
    protected $fillable = ['id_proyecto', 'encargado', 'proyecto', 'cliente','fecha_inicio','ubicacion','activo'];
    
}
