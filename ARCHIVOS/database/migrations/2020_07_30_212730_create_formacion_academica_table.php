<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormacionAcademicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formacion_academica', function (Blueprint $table) {
            $table->bigIncrements('idformacion');
            $table->enum('tipo_relacion',['freelancer','empresa'])->nullable();
            $table->bigInteger('idrelacion')->unsigned()->nullable();
            $table->enum('tipoFormacion',['formal','informal'])->nullable();
            $table->enum('nivelFormacion',['pregrado','posgrado'])->nullable();
            $table->string('titulo',80)->nullable();
            $table->string('universidad',80)->nullable();
            $table->integer('anio_culminacion')->nullable();
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
        Schema::dropIfExists('formacion_academica');
    }
}
