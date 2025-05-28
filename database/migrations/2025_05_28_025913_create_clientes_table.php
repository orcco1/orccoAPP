<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_empresa');
            $table->string('telefono')->nullable();
            $table->string('correo_electronico')->nullable();
            // no timestamps según tu modelo
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
