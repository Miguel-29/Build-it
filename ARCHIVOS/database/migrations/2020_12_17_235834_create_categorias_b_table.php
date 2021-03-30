<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasBTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias_b', function (Blueprint $table) {
            $table->bigIncrements('iden');
            $table->bigInteger('idbeneficio')->unsigned()->nullable();
            $table->foreign('idbeneficio')->references('idbeneficio')->on('beneficios')->onDelete('cascade');
            $table->bigInteger('idcategoria')->unsigned()->nullable();
            $table->foreign('idcategoria')->references('idcategoria')->on('categorias_beneficios')->onDelete('cascade');

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
        Schema::dropIfExists('categorias_b');
    }
}
