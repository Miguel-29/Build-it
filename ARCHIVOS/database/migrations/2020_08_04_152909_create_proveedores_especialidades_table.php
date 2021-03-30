<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresEspecialidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores_especialidades', function (Blueprint $table) {
            $table->bigIncrements('iden');
            $table->bigInteger('idproveedor')->unsigned();
            $table->foreign('idproveedor')->references('idproveedor')->on('proveedores');
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
        Schema::dropIfExists('proveedores_especialidades');
    }
}
