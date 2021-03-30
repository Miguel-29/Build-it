<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesionesFreelancerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesiones_freelancer', function (Blueprint $table) {
            $table->bigIncrements('iden');
            $table->bigInteger('idrelacion')->unsigned()->nullable();
            $table->bigInteger('idprofesion')->unsigned()->nullable();
            $table->foreign('idprofesion')->references('id')->on('profesiones');
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
        Schema::dropIfExists('profesiones_freelancer');
    }
}
