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
            $table->string('EV_ID_GEO')->nullable()->unique();
            $table->datetime('EV_fecha')->nullable();
            $table->integer('EV_asesor')->unsigned();
            $table->foreign('EV_asesor')->references('AS_ID')->on('Asesor')->ondelete('cascade');
            $table->integer('EV_cliente')->unsigned()->nullable();
            $table->foreign('EV_cliente')->references('CL_ID')->on('Cliente')->ondelete('cascade');
            $table->string('EV_tipo',50);
            $table->string('EV_direccion');
            $table->time('EV_hora');
            $table->string('EV_motivo');
            $table->boolean('EV_consolidacion')->default(false);
            $table->string('EV_comentario_no_consolidacion')->nullable();
            $table->boolean('EV_CL_cartera_vencida')->default(false);
            $table->boolean('EV_abono')->default(false);
            $table->string('EV_tipo_pago')->nullable();
            $table->integer('EV_dinero_abono')->unsigned();
            $table->string('EV_proximo_paso');
            $table->datetime('EV_fecha_proxima_cita')->nullable();
            
            $table->timestamp('EV_actualizacion')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('EV_inicio')->default(\DB::raw('CURRENT_TIMESTAMP'));
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
