<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupervisionTecnicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervision_tecnica', function (Blueprint $table) {
            $table->bigIncrements('idsupervision');
            $table->enum('tipo_relacion',['freelancer','empresa'])->nullable();
            $table->bigInteger('idrelacion')->unsigned()->nullable();
            $table->bigInteger('iddisciplina')->unsigned()->nullable();

            $table->boolean('realiza_supervision_tecnica')->nullable();
            $table->string('anios_experiencia_supervision',30)->nullable();
            $table->string('m2_supervisados',30)->nullable();
            $table->text('tipo_estructura')->nullable();
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
        Schema::dropIfExists('supervision_tecnica');
    }
}
