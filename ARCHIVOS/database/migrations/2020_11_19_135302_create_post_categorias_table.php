<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_categorias', function (Blueprint $table) {
            $table->bigIncrements('iden');
            $table->bigInteger('idpost')->unsigned()->nullable();
            $table->foreign('idpost')->references('idpost')->on('post')->onDelete('cascade');;
            $table->bigInteger('idcategoria')->unsigned()->nullable();
            $table->foreign('idcategoria')->references('idcategoria')->on('categorias')->onDelete('cascade');;

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
        Schema::dropIfExists('post_categorias');
    }
}
