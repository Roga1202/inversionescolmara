<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Evento', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish2_ci';
            $table->increments('EV_ID');
            $table->string('EV_ID_GEO',20)->nullable();
            $table->integer('EV_tiempo',250)->unsigned()->nullable();
            $table->integer('EV_cliente')->unsigned()->nullable();
            $table->string('EV_tipo',50);
            $table->boolean('EV_consolidacion')->default(false);
            $table->string('EV_comentario')->nullable();
            $table->integer('EV_cliente')->unsigned()->nullable();
            $table->foreign('EV_cliente')->references('CL_ID')->on('Cliente')->ondelete('cascade');
            $table->string('EV_tipo_cliente',50)->unsigned()->nullable();
            $table->foreign('EV_tipo_cliente')->references('CL_tipo')->on('Cliente')->ondelete('cascade');
            $table->integer('EV_asesor')->unsigned()->nullable();
            $table->foreign('EV_asesor')->references('AS_ID')->on('Asesor')->ondelete('cascade');
            $table->integer('EV_precio_compra')->nullable()->unsigned();
            $table->dateTime('EV_fecha_proxima_cita')->nullable();
            
            $table->timestamp('EV_inicio')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('EV_actualizacion')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Evento');
    }
}
