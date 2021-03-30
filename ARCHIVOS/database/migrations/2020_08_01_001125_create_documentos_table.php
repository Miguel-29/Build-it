<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->bigIncrements('iddocumento');
            $table->enum('tipoDocumento',['proyecto','freelancer','proveedor','pasante','empresa','cliente'])->nullable();
            $table->bigInteger('idrelacion')->unsigned()->nullable();
            $table->string('tagDocumento',80)->nullable();
            $table->string('nombre',80)->nullable();
            $table->text('urlDoc')->nullable();
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
        Schema::dropIfExists('documentos');
    }
}
