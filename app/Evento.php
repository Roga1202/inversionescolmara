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
    protected $fillable = ['EV_ID_GEO','EV_fecha','EV_asesor','EV_cliente','EV_tipo','EV_direccion','EV_hora','EV_motivo','EV_consolidacion','EV_comentario_no_consolidacion','EV_CL_cartera_vencida','EV_abono','EV_tipo_pago','EV_dinero_abono','EV_proximo_paso','EV_fecha_proxima_cita'];
    //
}
