<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->integer('placa')->unique();
            $table->string('nombres_piloto', 100);
            $table->string('ap_paterno_piloto', 100);
            $table->string('ap_materno_piloto', 100)->nullable();

            $table->string('nombres_copiloto', 100)->nullable();
            $table->string('ap_paterno_copiloto', 100)->nullable();
            $table->string('ap_materno_copiloto', 100)->nullable();
            $table->string('comunidad', 100);

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
        Schema::dropIfExists('personas');
    }
}
