<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelacionBimTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelacion_bim', function (Blueprint $table) {
            $table->bigIncrements('idmodelacion');
            $table->enum('tipo_relacion',['freelancer','empresa'])->nullable();
            $table->bigInteger('idrelacion')->unsigned()->nullable();
            $table->bigInteger('iddisciplina')->unsigned()->nullable();

            $table->boolean('ha_trabajado_bim')->nullable();
            $table->string('anios_experiencia',30)->nullable();
            $table->string('m2_disenados_bim',30)->nullable();
            $table->text('tipo_estructuras_disenadas')->nullable();
            $table->text('uso_software_bim')->nullable();
            $table->boolean('tiene_certificados_bim')->nullable();
            $table->boolean('desea_aprender_bim')->nullable();

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
        Schema::dropIfExists('modelacion_bim');
    }
}
