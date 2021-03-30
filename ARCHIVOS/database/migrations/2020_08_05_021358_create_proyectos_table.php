<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->bigIncrements('idproyecto');
            $table->bigInteger('idcliente')->unsigned()->nullable();
            $table->bigInteger('idtipo')->unsigned()->nullable();
            $table->foreign('idcliente')->references('idcliente')->on('clientes');
            $table->foreign('idtipo')->references('id')->on('tipo_proyectos');
            $table->string('nombre')->nullable();
            $table->string('propietario')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('departamento')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('area')->nullable();
            $table->integer('cantidad_pisos')->nullable();
            $table->text('informacion_adicional')->nullable();
            $table->text('image')->nullable();
            $table->string('ubicacion_latitud')->nullable();
            $table->string('ubicacion_longitud')->nullable();
            $table->integer('ie_tipo_proyecto')->nullable();
            $table->bigInteger('ie_grupouso')->unsigned()->nullable();
            $table->bigInteger('ie_subuso')->unsigned()->nullable();
            $table->bigInteger('ie_grupousolistado')->unsigned()->nullable();
            $table->foreign('ie_grupouso')->references('id')->on('grupo_uso');
            $table->foreign('ie_subuso')->references('id')->on('sub_uso_ocupacion');
            $table->integer('ie_proyecto_bic')->nullable();
            $table->string('ie_disponibilidad_licenciacons')->nullable();
            $table->string('ie_proyecto_colinda_bic_100')->nullable();
            $table->string('ie_predio_demolicion')->nullable();
            $table->string('ie_tiempo_ejecucion')->nullable();
            $table->string('ie_metodo_pago_ejecucion')->nullable();
            $table->string('ie_conocimiento_previo')->nullable();
            $table->string('ad_administracion')->nullable();
            $table->string('ad_yatiene_contratista')->nullable();
            $table->string('ad_condicion_contratista')->nullable();
            $table->string('ad_nombre_contratista')->nullable();
            $table->string('ad_profesion_contratista_free')->nullable();
            $table->string('ad_tarjeta_profesional_free')->nullable();
            $table->string('ad_area_contratista_emp')->nullable();
            $table->string('ad_rutnit_contratista_emp')->nullable();
            $table->string('ad_ciudad_contratista')->nullable();
            $table->string('ad_correo_contratista')->nullable();
            $table->string('ad_telefono_contratista')->nullable();
            $table->integer('proceso')->nullable();
            $table->string('estado',100)->nullable();

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
        Schema::dropIfExists('proyectos');
    }
}
