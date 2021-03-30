<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores_servicios', function (Blueprint $table) {
            $table->bigIncrements('iden');
            $table->bigInteger('idproveedor')->unsigned();
            $table->foreign('idproveedor')->references('idproveedor')->on('proveedores');
            $table->bigInteger('idservicio')->unsigned();
            $table->foreign('idservicio')->references('idservicio')->on('servicios_especialidad');
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
        Schema::dropIfExists('proveedores_servicios');
    }
}
