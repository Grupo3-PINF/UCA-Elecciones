<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('idUser')->unique();
            $table->boolean("esAdmin")->default(false);
            $table->boolean("esSecretario")->default(false);
            $table->boolean("esEstudiante")->default(true);
            $table->boolean("esDesarrolladorBajo")->default(false);
            $table->boolean("esDesarrolladorAlto")->default(false);
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
        Schema::dropIfExists('roles');
    }
}
