<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    //

    

    protected $guarded = [];
    protected $primaryKey = 'AS_ID';
    const CREATED_AT = 'AS_inicio';
    const UPDATED_AT = 'AS_actualizacion';

    protected $table = 'Asesor';
    protected $fillable = ['AS_nombre','AS_cedula','AS_direccion','AS_telefono','AS_telefono_emergencia','AS_tipo','AS_correo','AS_ventas_total','AS_ventas_total_mes','AS_porcentaje_ventas','AS_visita','AS_IMEI','AS_grupo','AS_numero_telefono','AS_fabricante_tlf','AS_modelo_tlf','AS_OS_tlf','AS_alias','AS_estado','AS_ultima_fecha','AS_ultima_hora','AS_ultimo_reporte','AS_version_app'];
}
