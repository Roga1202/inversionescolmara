<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcesoController extends Controller
{
    public function Revisar_String($string){
        if($string != null){
            $valor = str_replace("/"," ",$string);
            return $valor;
        }else{
            return null;
        }
    }

    public function get_Fecha($fecha_evento){
        
        $fecha_evento = $fecha_evento.':00';

        $año = substr($fecha_evento,6,4);
        $mes = substr($fecha_evento,3,2);
        $dia = substr($fecha_evento,0,2);
        $hora = substr($fecha_evento,11,9);
        
        $fecha_evento = $año . '-' . $mes . '-' . $dia . ' ' . $hora;
        return $fecha_evento;
    }

    public function get_Tipo_Pago($dinero_efectivo,$dinero_cheque,$dinero_transferencia){
        if ($dinero_efectivo > 0) {
            $dinero = $dinero_efectivo;
            $tipo_pago = 'Efectivo';
        } elseif($dinero_cheque > 0) {
            $dinero = $dinero_cheque;
            $tipo_pago = 'Cheque';
        } elseif($dinero_transferencia > 0) {
            $dinero = $dinero_transferencia;
            $tipo_pago = 'Transferencia';
        } else{
            $dinero = '0';
            $tipo_pago = null;
        }

        $data = array(
            'dinero' => $dinero,
            'tipo_pago' => $tipo_pago
        );

        return $data;
    }
    
    public function get_Fecha_Proxima_Cita($fecha,$hora){
        if($fecha != null){
            $fecha_proxima_cita = str_replace('/','-',$get_Fecha);
            
            
            if($fecha_proxima_cita[2] != '-'){
                $fecha_proxima_cita = '0'.$fecha_proxima_cita;
            }
            if($fecha_proxima_cita[5] != '-'){
                $fecha_proxima_cita = substr($fecha_proxima_cita, 0,3) . '0'. substr($fecha_proxima_cita, 3);
            }
            // cambio hora AM/PM a militar
            if(substr(value($hora),0,1) != '0' || substr(value($hora),0,1) != '1'){
                $hora = '0'. $hora;
            }
            $hora_proxima_cita = $this->cambio_militar(value($hora));
            
            
            
            $año = substr($fecha_proxima_cita,6,4);
            $mes = substr($fecha_proxima_cita,3,2);
            $dia = substr($fecha_proxima_cita,0,2);
            $hora = substr($fecha_proxima_cita,11,9);
            
            $fecha_proxima_cita = $año . '-' . $mes . '-' . $dia . ' ' . $hora;
            
            $fecha_proxima_cita= $fecha_proxima_cita . ' ' . $hora_proxima_cita;
            
        }else{
            $fecha_proxima_cita = null;
        }
        return $fecha_proxima_cita;
    }
    
    public function Comprobar_Boolean($string){
        $string = strtolower($string);
        if($string == 'no'){
            $string = false;
        }else{
            $string = true;
        }
        return $string;
    }


    public function Cambio_Militar($hora_completa){
        $hora = substr($hora_completa, 0,2);
        $minutos = substr($hora_completa, 3,2);  
        $segundos = substr($hora_completa, 6,2);  
        $indicador = substr($hora_completa,8,10);
        if($indicador == 'PM'){
            $hora = $hora + 12;
            if ($hora == 24) {
                $hora = '00';
            }
        }

        $hora_completa = $hora.':'.$minutos.':'.$segundos;
        return $hora_completa;
    }
}
