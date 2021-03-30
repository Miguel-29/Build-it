<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesionesDisciplinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesiones_disciplinas', function (Blueprint $table) {
            $table->bigIncrements('iden');
            $table->bigInteger('idprofesion')->unsigned();
            $table->bigInteger('iddisciplina')->unsigned();
            $table->foreign('iddisciplina')->references('iddisciplina')->on('disciplinas')->onDelete('cascade');
            $table->foreign('idprofesion')->references('id')->on('profesiones')->onDelete('cascade');

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
        Schema::dropIfExists('profesiones_disciplinas');
    }
}
