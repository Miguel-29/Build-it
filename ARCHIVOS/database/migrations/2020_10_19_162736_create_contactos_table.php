<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->bigIncrements('idcontacto');
            $table->unsignedBigInteger('idproyecto')->nullable(true);
			$table->unsignedBigInteger('idcliente')->nullable(true);
			$table->unsignedBigInteger('iddisciplina')->nullable(true);
			$table->unsignedBigInteger('idfase')->nullable(true);
            $table->string('tipo_contratista')->nullable();
            $table->string('nombres')->nullable();
            $table->string('correo')->nullable();
            $table->string('celular')->nullable();

			
			$table->foreign('idproyecto')
				  ->references('idproyecto')
				  ->on('proyectos')
				  ->onDelete('cascade');

			$table->foreign('idcliente')
				  ->references('idcliente')
				  ->on('clientes')
				  ->onDelete('cascade');

			$table->foreign('iddisciplina')
				  ->references('iddisciplina')
				  ->on('disciplinas')
				  ->onDelete('cascade');

			$table->foreign('idfase')
				  ->references('idfase')
				  ->on('fases')
				  ->onDelete('cascade');

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
        Schema::dropIfExists('contactos');
    }
}
