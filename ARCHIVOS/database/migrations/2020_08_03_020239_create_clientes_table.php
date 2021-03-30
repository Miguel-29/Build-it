<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('idcliente');
            $table->enum('tipo_persona',['natural','juridica'])->nullable();
            $table->text('image')->nullable();
            $table->string('nombre_razon_social',80)->nullable();
            $table->string('apellidos',80)->nullable();
            $table->string('ciudad',30)->nullable();
            $table->string('pais',30)->nullable();
            $table->string('direccion',80)->nullable();
            $table->string('nit_rut',30)->nullable();
            $table->enum('tipo_documento',['cc','ce','ti','nit'])->nullable();
            $table->string('documento',30)->nullable();
            $table->integer('edad')->nullable();
            $table->date('fecha_nacimiento_creacion')->nullable();
            $table->string('celular',30)->nullable();
            $table->string('email',80)->nullable();
            $table->string('pagina_web',30)->nullable();
            $table->string('redes_sociales',50)->nullable();
            $table->text('descripcion_empresa')->nullable();
            $table->integer('estado')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
