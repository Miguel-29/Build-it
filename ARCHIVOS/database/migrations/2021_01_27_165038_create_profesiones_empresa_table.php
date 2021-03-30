<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesionesEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesiones_empresa', function (Blueprint $table) {
            $table->bigIncrements('iden');
            $table->bigInteger('idrelacion')->unsigned()->nullable();
            $table->bigInteger('iddisciplina')->unsigned()->nullable();
            $table->foreign('iddisciplina')->references('iddisciplina')->on('disciplinas');
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
        Schema::dropIfExists('profesiones_empresa');
    }
}
