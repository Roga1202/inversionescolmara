<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cliente', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish2_ci';
            $table->increments('CL_ID');
            $table->string('CL_ID_GEO',20)->nullable();
            $table->string('CL_referencia',250)->nullable();
            $table->string('CL_nombre_completo',250);
            $table->integer('CL_numero_compras')->nullable()->default(0);
            $table->dateTime('CL_ultima_compra')->nullable();
            $table->integer('CL_numero_visitas')->nullable()->default(0);
            $table->dateTime('CL_ultima_visita')->nullable();
            $table->string('CL_correo',50)->nullable()->unique();
            $table->string('CL_credencial',50)->unique()->nullable();
            $table->string('CL_NIT',50)->unique();
            $table->string('CL_direccion');
            $table->string('CL_direccion_descripcion');
            $table->string('CL_latitud')->nullable();
            $table->string('CL_longitud')->nullable();
            $table->integer('CL_radio')->unsigned()->nullable();
            $table->string('CL_color',50)->nullable();
            $table->integer('CL_dinero_mes')->unsigned()->nullable()->default(0);
            $table->integer('CL_dinero_total')->unsigned()->nullable()->default(0);
            $table->integer('CL_dinero_deuda')->unsigned()->nullable()->default(0);
            $table->float('CL_porcentaje_ventas',20)->unsigned()->default(0);
            $table->boolean('CL_perfil')->default(false);


            $table->timestamp('CL_inicio')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('CL_actualizacion')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cliente');
    }
}
