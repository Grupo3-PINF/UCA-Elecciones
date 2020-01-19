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
            $table->string('titulo');
            
            // para la blockchain
            $table->string('wallet')->unique()->nullable();
            /**
             * {
             *  candidatos: ["Palomitas saladas", "Palomitas dulces"]
             * }
             */
            $table->json('candidatos')->nullable();
            $table->json('grupos')->nullable();
            $table->dateTime('fechaInicio');
            $table->dateTime('fechaFin');
            $table->dateTime('fechaComienzoAnticipada')->nullable();
            $table->dateTime('fechaFinAnticipada')->nullable();
             /**
             * {
             *  votos: [1, 2, 54, 3232...]
             * }
             */
            $table->json('recuento')->nullable();
            $table->string('tipoEleccion');
            $table->boolean('multiGrupo')->default(false); 
            $table->boolean('adscripcion')->default(false); 
            $table->string('tipoPon')->nullable();
            $table->integer('ponNum')->nullable();   
            $table->boolean('dobleVoto')->default(false);

            // Opciones
            $table->boolean('esSecreta')->default(false);
            $table->boolean('esTiempoReal')->default(false);
            $table->boolean('esAnticipada')->default(false);

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
