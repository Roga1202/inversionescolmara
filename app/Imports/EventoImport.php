<?php
//error de largo de row[0]
//dar a saber que no se encuentra registrado el cliente
namespace App\Imports;

use App\Evento;
use App\Asesor;
use App\Cliente;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Symfony\Component\Console\Input\StringInput;

class EventoImport implements ToCollection
{
    private $errores = [];
    private $numero_registros = 0;
    private $numero_errores = 0;

    public function collection(Collection $rows)
    {
        $errores= [];
        $contador_registros = 0;
        $contador_errores = 0;
        foreach ($rows as $row)
        {
            if ($contador_registros != 0 and $row[0] != null) {

                //fecha
                $fecha_evento = $row[1].':00';

                $año = substr($fecha_evento,6,4);
                $mes = substr($fecha_evento,3,2);
                $dia = substr($fecha_evento,0,2);
                $hora = substr($fecha_evento,11,9);
                
                $fecha_evento = $año . '-' . $mes . '-' . $dia . ' ' . $hora;

                
                //asesor
                $asesor= Asesor::where('AS_nombre',$row[2])->first();
                
                //cliente
                $cliente= Cliente::where('CL_nombre_completo',$row[3])->first();
                
                //hora visita
                // 1:55:00 AM
                $hora_visita = value($row[7]);
                if($hora_visita[2] != ':'){
                    $hora_visita = '0'.$hora_visita;
                }
                
                // cambio hora AM/PM a militar
                $hora_visita = $this->cambio_militar(value($hora_visita));
                
                //consolidacion de compra
                $consolidacion = utf8_decode($row[10]);
                $consolidacion = $this->comprobar_boolean($consolidacion);
                
                //cartera vencida
                $cartera_vencida = utf8_decode($row[11]);
                $cartera_vencida = $this->comprobar_boolean($cartera_vencida);
                
                //abono
                $boolean_abono = utf8_decode($row[13]);
                $boolean_abono = $this->comprobar_boolean($boolean_abono);
                
                //tipo de pago
                
                if ($row[14] > 0) {
                    $dinero = $row[14];
                    $tipo_pago = 'Efectivo';
                } elseif($row[15] > 0) {
                    $dinero = $row[15];
                    $tipo_pago = 'Cheque';
                } elseif($row[16] > 0) {
                    $dinero = $row[16];
                    $tipo_pago = 'Transferencia';
                } else{
                    $dinero = '0';
                    $tipo_pago = null;
                }
                
                //proxima cita
                if($row[18]){
                    $fecha_proxima_cita = str_replace('/','-',$row[18]);
                    
                    
                    if($fecha_proxima_cita[2] != '-'){
                        $fecha_proxima_cita = '0'.$fecha_proxima_cita;
                    }
                    if($fecha_proxima_cita[5] != '-'){
                        $fecha_proxima_cita = substr($fecha_proxima_cita, 0,3) . '0'. substr($fecha_proxima_cita, 3);
                    }
                    // cambio hora AM/PM a militar
                    if(substr(value($row[19]),0,1) != '0' || substr(value($row[19]),0,1) != '1'){
                        $row[19] = '0'. $row[19];
                    }
                    $hora_proxima_cita = $this->cambio_militar(value($row[19]));
                    
                    
                    
                    $año = substr($fecha_proxima_cita,6,4);
                    $mes = substr($fecha_proxima_cita,3,2);
                    $dia = substr($fecha_proxima_cita,0,2);
                    $hora = substr($fecha_proxima_cita,11,9);
                    
                    $fecha_proxima_cita = $año . '-' . $mes . '-' . $dia . ' ' . $hora;
                    
                    $fecha_proxima_cita= $fecha_proxima_cita . ' ' . $hora_proxima_cita;
                    
                }else{
                    $fecha_proxima_cita = null;
                }
                try {
                    Evento::create([
                        'EV_ID_GEO'=> $row[0],
                        'EV_fecha'=> $fecha_evento,
                        'EV_asesor'=> $asesor->AS_ID,
                        'EV_cliente'=> $cliente->CL_ID,
                        'EV_tipo'=> $row[4],
                        'EV_direccion'=> $row[6],
                        'EV_hora'=> $hora_visita,
                        'EV_motivo'=> $row[9],
                        'EV_consolidacion'=> $consolidacion,
                        'EV_comentario_no_consolidacion' => $row[11],
                        'EV_cartera_vencida' => $cartera_vencida,
                        'EV_abono'=> $boolean_abono,
                        'EV_dinero_abono'=> $dinero,
                        'EV_tipo_pago'=> $tipo_pago,
                        'EV_proximo_paso'=> $row[17],
                        'EV_fecha_proxima_cita'=> $fecha_proxima_cita,
                    ]);
                    
                    }catch(\Exception $e){
                    $this->errores[$contador_errores]=$e->getMessage() . 'en la fila numero ' . $contador_registros;
                    report($e);
                    $contador_errores++;
                }
            }
            $contador_registros++;
        }
        $this->numero_errores = $contador_errores-1;
        $this->numero_registros = $contador_registros-1;
    }
    
    public function getErrores(){
        return $this->errores;
    }

    public function getNumberRegister(){
        return $this->numero_registros;
    }

    public function getNumberError(){
        return $this->numero_errores;
    }

    public function comprobar_boolean($string){
        $string = strtolower($string);
        if($string == 'no'){
            $string = false;
        }else{
            $string = true;
        }
        return $string;
    }

    public function cambio_militar($hora_completa){
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
