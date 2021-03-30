<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->bigIncrements('idproveedor');
            $table->string('nombre',80)->nullable();
            $table->string('gerente_nombre',250)->nullable();
            $table->string('gerente_tipodocumento',250)->nullable();
            $table->string('gerente_documento',80)->nullable();
            $table->string('gerente_celular',30)->nullable();
            $table->text('image')->nullable();
            $table->string('pais_residencia',80)->nullable();
            $table->string('ciudad_residencia',80)->nullable();
            $table->string('direccion',80)->nullable();
            $table->string('nit_rut',30)->nullable();
            $table->string('rup',30)->nullable();
            $table->string('anio_fundacion',10)->nullable();
            $table->string('email',80)->nullable();
            $table->string('celular',30)->nullable();
            $table->string('nacionalidad',30)->nullable();
            $table->string('pagina_web',30)->nullable();
            $table->text('redes_sociales')->nullable();
            $table->text('descripcion')->nullable();
            $table->boolean('presta_servicios_otras_ciudades')->nullable();
            $table->integer('estado');
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
        Schema::dropIfExists('proveedores');
    }
}
