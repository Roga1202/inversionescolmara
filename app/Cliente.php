<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //

    

    protected $guarded = [];
    protected $primaryKey = 'CL_ID';
    const CREATED_AT = 'CL_inicio';
    const UPDATED_AT = 'CL_actualizacion';

    protected $table = 'Cliente';
    protected $fillable = ['CL_ID','CL_ID_GEO','CL_referencia','CL_nombre_completo','CL_numero_compras','CL_ultima_compra','CL_numero_visitas','CL_ultima_visita','CL_correo','CL_credencial','CL_NIT','CL_direccion','CL_direccion_descripcion','CL_latitud','CL_longitud','CL_radio','CL_color','CL_dinero_nes','CL_dinero_total','CL_dinero_deuna','CL_procentaje_ventas','CL_perfil'];

    //
}
