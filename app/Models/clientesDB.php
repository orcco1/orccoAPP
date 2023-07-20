<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clientesDB extends Model
{
    use HasFactory;

    
    protected $table = 'clientes';
    
    protected $fillable = ['id', 'nombre_empresa', 'telefono','correo_electronico'];
    
    public $timestamps = false; // Deshabilitar los timestamps

}
