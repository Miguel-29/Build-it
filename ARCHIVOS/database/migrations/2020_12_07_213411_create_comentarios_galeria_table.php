<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosGaleriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentariosGaleria', function (Blueprint $table) {
            $table->bigIncrements('idcomentario');
            $table->bigInteger('idgaleria')->unsigned()->onDelete('cascade')->nullable();
            $table->foreign('idgaleria')->references('idgaleria')->on('galeria');
            $table->string('tipo_relacion',255)->nullable();
            $table->bigInteger('idrelacion')->unsigned()->nullable();
            $table->text('descripcion')->nullable();

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
        Schema::dropIfExists('comentariosGaleria');
    }
}
