<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoCarrera extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_carrera', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->date('fecha_realizacion');
            $table->timestamp('creado_el');
            $table->timestamp('editado_el');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_carrera');
    }
}
