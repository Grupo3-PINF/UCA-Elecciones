<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {

            $table->bigInteger('id')->autoincrement();

            // provisional dependiendo de LDAP
            // $table->foreign('idCreador')->references('id')->on('users');
            $table->bigInteger('idCreador');

            $table->string('titulo');


            $table->boolean('esCompleja');
            $table->mediumText('opciones');

        
            $table->boolean('esVinculante');
            $table->boolean('esAnticipada');
            $table->boolean('esRestringida');

            $table->boolean('esTiempoReal');
            $table->boolean('seMuestraAntes');


            $table->dateTime('fechaComienzo');
            $table->dateTime('fechaFin');
            $table->dateTime('fechaComienzoAnticipada')->nullable();
            $table->dateTime('fechaFinAnticipada')->nullable();

            $table->timestamps();

            // provisional
            //$table->string('ambito');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preguntas');
    }
}
