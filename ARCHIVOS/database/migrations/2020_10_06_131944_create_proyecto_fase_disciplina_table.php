<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoFaseDisciplinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_fase_disciplina', function (Blueprint $table) {
            $table->bigIncrements('iden');
            $table->bigInteger('idproyecto')->unsigned()->nullable();
            $table->foreign('idproyecto')->references('idproyecto')->on('proyectos');
            $table->bigInteger('idfase')->unsigned()->nullable();
            $table->foreign('idfase')->references('idfase')->on('fases');
            $table->bigInteger('iddisciplina')->unsigned()->nullable();
            $table->foreign('iddisciplina')->references('iddisciplina')->on('disciplinas');
            $table->boolean('cuenta_con_contratista')->nullable();
            $table->boolean('seleccion_del_catalogo')->nullable();
            $table->enum('tipo_contratista',['freelancer','empresa','proveedor','pasante'])->nullable();
            $table->integer('idcontratista')->nullable();
            $table->string('estado_contratista',30)->nullable();
            $table->integer('calificacion_contratista_proyecto')->nullable();
            $table->text('comentarios_al_contratista')->nullable();
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
        Schema::dropIfExists('proyecto_fase_disciplina');
    }
}
