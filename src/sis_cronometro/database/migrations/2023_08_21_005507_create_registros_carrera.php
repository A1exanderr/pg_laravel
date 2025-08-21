<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosCarrera extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros_carrera', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('inicio_primero');
            $table->time('fin_primero')->nullable();
            $table->time('suma_primero')->nullable();
            $table->time('inicio_segundo')->nullable();
            $table->time('fin_segundo')->nullable();
            $table->time('suma_segundo')->nullable();
            $table->time('total')->nullable();
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_carrera');

            $table->foreign('id_persona')
                ->references('id')
                ->on('personas')
                ->onDelete('restrict');
            $table->foreign('id_carrera')
                ->references('id')
                ->on('tipo_carrera')
                ->onDelete('restrict');
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
        Schema::dropIfExists('registros_carrera');
    }
}
