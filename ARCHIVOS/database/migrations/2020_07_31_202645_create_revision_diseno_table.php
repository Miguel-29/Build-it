<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionDisenoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_diseno', function (Blueprint $table) {
            $table->bigIncrements('idrevision');
            $table->enum('tipo_relacion',['freelancer','empresa'])->nullable();
            $table->bigInteger('idrelacion')->unsigned()->nullable();
            $table->bigInteger('iddisciplina')->unsigned()->nullable();

            $table->boolean('realiza_funcion_revision_diseno')->nullable();
            $table->string('anios_experiencia_revision',30)->nullable();
            $table->string('m2_revisados',30)->nullable();
            $table->text('tipos_estructuras')->nullable();
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
        Schema::dropIfExists('revision_diseno');
    }
}
