<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeria', function (Blueprint $table) {
            $table->bigIncrements('idgaleria');
            $table->bigInteger('idproyecto')->unsigned()->onDelete('cascade')->nullable();
            $table->foreign('idproyecto')->references('idproyecto')->on('proyectos');
            $table->string('tipo_relacion',255)->nullable();
            $table->bigInteger('idrelacion')->unsigned()->nullable();
            $table->string('nombre',255)->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('estado')->nullable();
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
        Schema::dropIfExists('galeria');
    }
}
