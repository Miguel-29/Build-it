<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienciaLaboralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencia_laboral', function (Blueprint $table) {
            $table->bigIncrements('idexperiencia');
            $table->enum('tipo_relacion',['freelancer','empresa'])->nullable();
            $table->bigInteger('idrelacion')->unsigned()->nullable();
            $table->bigInteger('iddisciplina')->unsigned()->nullable();
            $table->string('anios_experiencia',30)->nullable();
            $table->string('m2_disenados',30)->nullable();
            $table->text('tipo_estructuras_disenadas')->nullable();
            $table->text('actividades_desempena')->nullable();
            $table->text('uso_software')->nullable();
            $table->string('disponibilidad_personal',30)->nullable();
            $table->string('certificados_cursos_seminarios',30)->nullable();
            $table->enum('disponibilidad_viajar',['si','si_condiciones','no'])->nullable();
            $table->string('tipo_contratacion',30)->nullable();
            $table->double('costo_por_unidad_contratacion')->nullable();

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
        Schema::dropIfExists('experiencia_laboral');
    }
}
