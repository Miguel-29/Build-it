<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreelancersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelancer', function (Blueprint $table) {
            $table->bigIncrements('idfreelancer');
            $table->text('image')->nullable();
            $table->string('nombres',80)->nullable();
            $table->string('apellidos',80)->nullable();
            $table->enum('genero',['M','F'])->nullable();
            $table->string('ciudad_residencia',80)->nullable();
            $table->string('pais',80)->nullable();
            $table->enum('tipo_documento',['cc','ce','ti','nit'])->nullable();
            $table->string('documento',30)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('edad')->nullable();
            $table->string('email',80)->nullable();
            $table->string('celular',30)->nullable();
            $table->string('nacionalidad',50)->nullable();
            $table->text('direccion')->nullable();
            $table->enum('disponibilidad_tiempo',['completo','medio_tiempo','fin_de_semana'])->nullable();
            $table->bigInteger('fp_profesion')->unsigned()->nullable();
            $table->foreign('fp_profesion')->references('id')->on('profesiones');
            $table->bigInteger('fp_linea_enfoque_area')->unsigned()->nullable();
            $table->foreign('fp_linea_enfoque_area')->references('iddisciplina')->on('disciplinas');
            $table->text('fp_competencias')->nullable();
            $table->text('fp_descripcion_profesional')->nullable();
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
        Schema::dropIfExists('freelancer');
    }

}
