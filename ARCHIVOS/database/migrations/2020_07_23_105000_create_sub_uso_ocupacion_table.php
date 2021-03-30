<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubUsoOcupacionTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sub_uso_ocupacion', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->mediumText('nombre');
			$table->unsignedBigInteger('grupo_uso_id');
			$table->timestamps();
			
			$table->foreign('grupo_uso_id')
				  ->references('id')
				  ->on('grupo_uso')
				  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sub_uso_ocupacion');
    }
}
