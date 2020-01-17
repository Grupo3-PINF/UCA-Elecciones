<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotanteAnticipadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votantes_anticipados', function (Blueprint $table) {
            $table->bigInteger('id_usuario');
            $table->bigInteger('id_pregunta')->nullable();
            $table->bigInteger('id_eleccion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votante_anticipados');
    }
}
