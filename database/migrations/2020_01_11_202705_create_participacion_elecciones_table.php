<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipacionEleccionesTable  extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $primaryKey = 'id';

    public function up()
    {
        Schema::create('participacionelecciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idpregunta');
            $table->bigInteger('idusuario');
            $table->bigInteger('opcion');
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
        Schema::dropIfExists('participacionelecciones');
    }
}