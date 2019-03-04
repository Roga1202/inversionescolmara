<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    //

    

    protected $guarded = [];
    protected $primaryKey = 'EV_ID';
    const CREATED_AT = 'EV_inicio';
    const UPDATED_AT = 'EV_actualizacion';

    protected $table = 'Evento';
    protected $fillable = ['EV_ID_GEO','EV_tiempo','EV_cliente','EV_tipo','EV_consolidacion','EV_comentario','EV_cliente','EV_tipo_cliente','EV_asesor','EV_precio_compra','EV_fecha_proxima_cita'];
    //
}
