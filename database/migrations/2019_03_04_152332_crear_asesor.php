<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearAsesor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Asesor', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish2_ci';
            $table->increments('AS_ID');
            $table->string('AS_nombre');
            $table->string('AS_cedula')->unique()->nullable();
            $table->string('AS_direccion')->nullable();
            $table->string('AS_telefono');
            $table->string('AS_telefono_emergencia')->nullable();
            $table->string('AS_tipo')->nullable();
            $table->string('AS_correo')->nullable();
            $table->integer('AS_ventas_total')->default(0)->unsigned();
            $table->integer('AS_ventas_total_mes')->default(0)->unsigned();
            $table->float('AS_porcentaje_ventas')->unsigned()->default(0);
            $table->integer('AS_visita')->unsigned()->default(0);

            //Telefono
            $table->string('AS_IMEI')->unique();
            $table->string('AS_grupo',50)->nulleable();
            $table->string('AS_fabricante_tlf');
            $table->string('AS_modelo_tlf',50);
            $table->string('AS_OS_tlf',10);
            $table->string('AS_alias',50)->unique();
            $table->string('AS_estado',50);
            $table->string('AS_ultima_fecha')->default(0);
            $table->time('AS_ultima_hora')->default('00:00:00');
            $table->string('AS_ultimo_reporte')->default(0);
            $table->string('AS_version_app',50)->default(0);



            $table->timestamp('AS_inicio')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('AS_actualizacion')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Asesor');
    }
}
