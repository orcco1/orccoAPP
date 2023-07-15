<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleadosDB extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    protected $primaryKey = 'id';
    public $timestamps = false; // Desactiva las columnas timestamps
    protected $fillable = ['id', 'nombre_completo', 'fecha_nacimiento', 'telefono', 'telefono_emergencia', 'salario', 'fecha_registro', 'activo', 'email'];
}





