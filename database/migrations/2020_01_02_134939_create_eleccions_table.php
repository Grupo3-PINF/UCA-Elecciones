<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateEleccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elecciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idCreador')->nullable();
            
            // para la blockchain
            $table->string('wallet')->unique()->nullable();
            $table->json('candidatos')->nullable();
            $table->json('grupos')->nullable();
            $table->dateTime('fechaInicio');
            $table->dateTime('fechaFin');
            
            $table->string('tipoEleccion');
            // si grupos no ponderamos
                //$table->string('tipo-votacion');
            // si cargos unipersonales
            
            $table->boolean('dobleVoto')->default(false);
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
        Schema::dropIfExists('elecciones');
    }
}