<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdiomasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idiomas', function (Blueprint $table) {
            $table->bigIncrements('iden');
            $table->enum('tipo_relacion',['freelancer','empresa'])->nullable();
            $table->bigInteger('idrelacion')->unsigned()->nullable();
            $table->bigInteger('iddisciplina')->unsigned()->nullable();
            $table->string('nombreIdioma',100)->nullable();
            $table->string('nivelIdioma',20)->nullable();

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
        Schema::dropIfExists('idiomas');
    }
}
