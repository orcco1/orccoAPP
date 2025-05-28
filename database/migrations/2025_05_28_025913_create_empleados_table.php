<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_completo');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('telefono')->nullable();
            $table->string('telefono_emergencia')->nullable();
            $table->decimal('salario', 10, 2)->default(0);
            $table->dateTime('fecha_registro')->useCurrent();
            $table->boolean('activo')->default(true);
            $table->string('email')->unique();
            // sin timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('empleados');
    }
};
