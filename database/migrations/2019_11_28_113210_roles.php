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
            $table->string('idUser');
            $table->boolval('esAdministrador')->default(false);
            $table->boolval('esSecretario')->default(false);
            $table->boolval('esEstudiante')->default(true);
            $table->boolval('esDesarrolladorBajo')->default(false);
            $table->boolval('esDesarrolladorAlto')->default(false);
            $table->rememberToken();
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
