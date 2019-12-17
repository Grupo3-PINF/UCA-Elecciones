  
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
            $table->bigIncrements('id');
            // para la blockchain
            $table->string('wallet')->unique()->nullable();
            // provisional dependiendo de LDAP
            // $table->foreign('idCreador')->references('id')->on('users');
            $table->bigInteger('idCreador')->nullable();
            $table->string('titulo');
            $table->boolean('esCompleja')->default(false);
            /**
             * {
             *  opciones: ["Palomitas saladas", "Palomitas dulces"]
             * }
             */
            $table->json('opciones')->nullable();
        
            $table->boolean('esVinculante')->default(false);
            $table->boolean('esAnticipada')->default(false);
            $table->boolean('esRestringida')->default(false);
            $table->boolean('esTiempoReal')->default(false);
            $table->boolean('seMuestraAntes')->default(false);
            $table->dateTime('fechaComienzo');
            $table->dateTime('fechaFin');
            $table->dateTime('fechaComienzoAnticipada')->nullable();
            $table->dateTime('fechaFinAnticipada')->nullable();
            /**
             * {
             *  votos: [1, 2, 54, 3232...]
             * }
             */
            $table->json('recuento')->nullable();
            
            /**
             * {
             *  censos: [0, 1, 3 ...]
             * }
             */
            $table->json('censoVotante')->nullable();

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
        Schema::dropIfExists('preguntas');
    }
}