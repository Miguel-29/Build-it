<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagenGaleriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenGaleria', function (Blueprint $table) {
            $table->bigIncrements('idimagen');
            $table->bigInteger('idgaleria')->unsigned()->onDelete('cascade')->nullable();
            $table->foreign('idgaleria')->references('idgaleria')->on('galeria');
            $table->text('descripcion')->nullable();
            $table->text('image')->nullable();

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
        Schema::dropIfExists('imagenGaleria');
    }
}
