<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosEspecialidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios_especialidad', function (Blueprint $table) {
            $table->bigIncrements('idservicio');
            $table->string('nombre',80);
            $table->bigInteger('idespecialidad')->unsigned();
            $table->foreign('idespecialidad')->references('idespecialidad')->on('especialidades_proveedores');
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
        Schema::dropIfExists('servicios_especialidad');
    }
}
