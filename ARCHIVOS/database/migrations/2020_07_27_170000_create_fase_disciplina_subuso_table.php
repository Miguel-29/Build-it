<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaseDisciplinaSubusoTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('fase_disciplina_subuso', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tipo_proyecto_id');
			$table->unsignedBigInteger('sub_uso_ocupacion_id')->nullable(true);
			$table->unsignedBigInteger('disciplina_id')->nullable(true);
			$table->unsignedBigInteger('fase_id');
			$table->boolean('es_obligatorio');
			$table->timestamps();
			
			$table->foreign('tipo_proyecto_id')
				  ->references('id')
				  ->on('tipo_proyectos')
				  ->onDelete('cascade');

			$table->foreign('sub_uso_ocupacion_id')
				  ->references('id')
				  ->on('sub_uso_ocupacion')
				  ->onDelete('cascade');

			$table->foreign('disciplina_id')
				  ->references('iddisciplina')
				  ->on('disciplinas')
				  ->onDelete('cascade');

			$table->foreign('fase_id')
				  ->references('idfase')
				  ->on('fases')
				  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('fase_disciplina_subuso');
    }
}
