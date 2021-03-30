<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContenidoPaginasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenido_paginas', function (Blueprint $table) {
            $table->bigIncrements('idcontenido');
            $table->bigInteger('idpagina')->unsigned()->nullable();
            $table->foreign('idpagina')->references('idpagina')->on('paginas')->onDelete('cascade');
            $table->string('nombre',250);
            $table->text('imagen')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('estado');

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
        Schema::dropIfExists('contenido_paginas');
    }
}
