<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoProyectosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tipo_proyectos', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->mediumText('nombre');
			$table->longText('descripcion')->nullable(true);
			$table->string('imagen', 500)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tipo_proyectos');
    }
}
