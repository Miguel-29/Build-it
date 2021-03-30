<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsDocumentosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tags_documentos', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->enum('tipo', [
				'proyecto',
				'proveedor',
				'freelance',
				'empresa',
				'pasante'
			]);
			$table->string('tag');
			$table->boolean('obligatorio');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tags_documentos');
    }
}
