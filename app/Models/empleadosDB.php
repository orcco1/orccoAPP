<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleadosDB extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    
    protected $fillable = ['id', 'nombre_completo', 'telefono','salario'];
    
}




