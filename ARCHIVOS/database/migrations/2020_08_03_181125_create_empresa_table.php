<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->bigIncrements('idempresa');
            $table->text('image')->nullable();
            $table->string('razon_social',30)->nullable();
            $table->string('ciudad_residencia',30)->nullable();
            $table->string('pais',30)->nullable();
            $table->string('direccion',80)->nullable();
            $table->string('nit',30)->nullable();
            $table->string('rup',30)->nullable();
            $table->integer('anio_fundacion')->nullable();
            $table->string('celular',30)->nullable();
            $table->string('email',80)->nullable();
            $table->string('nacionalidad',30)->nullable();
            $table->string('pagina_web',30)->nullable();
            $table->string('redes_sociales',100)->nullable();
            $table->text('descripcion_empresa')->nullable();
            $table->boolean('presta_servicios_otras_ciudades')->nullable();
            $table->bigInteger('fp_profesion')->unsigned()->nullable();
            $table->bigInteger('fp_linea_enfoque_area')->unsigned()->nullable();
            $table->text('fp_competencias')->nullable();
            $table->text('fp_descripcion_profesional')->nullable();
            $table->string('gerente_nombres',30)->nullable();
            $table->string('gerente_apellidos',30)->nullable();
            $table->string('gerente_celular',30)->nullable();
            $table->bigInteger('gerente_idprofesion')->unsigned()->nullable();
            $table->foreign('gerente_idprofesion')->references('id')->on('profesiones');
            $table->bigInteger('gerente_iddisciplina')->unsigned()->nullable();
            $table->foreign('gerente_iddisciplina')->references('iddisciplina')->on('disciplinas');
            $table->integer('estado');
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
        Schema::dropIfExists('empresa');
    }
}
