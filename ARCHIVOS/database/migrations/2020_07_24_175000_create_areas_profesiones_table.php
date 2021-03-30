<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasProfesionesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('areas_profesiones', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->mediumText('nombre');
			$table->unsignedBigInteger('profesion_id');
			$table->timestamps();
			
			$table->foreign('profesion_id')
				  ->references('id')
				  ->on('profesiones')
				  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('areas_profesiones');
    }
}
