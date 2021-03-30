<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosproveedoresDisciplinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serviciosproveedores_disciplinas', function (Blueprint $table) {
            $table->bigIncrements('iden');
            $table->bigInteger('idservicio')->unsigned();
            $table->bigInteger('iddisciplina')->unsigned();
            $table->foreign('iddisciplina')->references('iddisciplina')->on('disciplinas')->onDelete('cascade');
            $table->foreign('idservicio')->references('idservicio')->on('servicios_especialidad')->onDelete('cascade');
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
        Schema::dropIfExists('serviciosproveedores_disciplinas');
    }
}
