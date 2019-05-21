<?php
namespace App\Imports;

use App\Evento;
use App\Asesor;
use App\Cliente;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Symfony\Component\Console\Input\StringInput;
use App\Http\Controllers\ProcesoController;

class EventoImport implements ToCollection
{
    private $errores = [];
    private $numero_registros = 0;
    private $numero_filas = 0;
    private $numero_errores = 0;

    public function collection(Collection $rows)
    {
        $errores= [];
        $contador_filas = 0;
        $contador_errores = 0;
        $contador_registros = 0;if ($rows[0][0] != "ID") {
            $error = "El archivo no pertenece a los formularios";
            return back()->with([
                'error_critico' => $error,
                ]);
            } else {
                foreach ($rows as $row)
                {
                    $alt = $contador_filas+1;
                    if ($contador_filas != 0 and strlen($row[0]) == 24) {
                        $proceso = new ProcesoController;
                        
                        //fecha
                        $fecha_evento = $proceso->get_Fecha($row[1]);
                        
                        //asesor
                        $asesor = utf8_decode($proceso->Revisar_String($row));
                        $asesor= Asesor::where('AS_nombre',$row[2])->first();
                        
                        //cliente
                        $cliente = ($proceso->Revisar_String($row[3]));
                        $cliente= Cliente::where('CL_nombre_completo',$cliente)->first();
                        
                        if($asesor == null || $cliente == null){
                            if($asesor == null){
                                $message = 'El asesor no existe. ' . $row[2];
                            }elseif($cliente == null){
                                $message = 'El cliente no existe. ' . $row[3];
                            }else{
                                $message = 'El cliente y asesor no existen. Asesor ' . $row[2] . ' Cliente ' . $row[3];
                            }
                            \Log::error($message);
                        }
                        

                        //hora visita
                        $hora_visita = value($row[7]);
                        if($hora_visita[2] != ':'){
                            $hora_visita = '0'.$hora_visita;
                        }
                        
                        // cambio hora AM/PM a militar
                        $hora_visita = $proceso->Cambio_Militar(value($hora_visita));
                        
                        //consolidacion de compra
                        $consolidacion = utf8_decode($row[10]);
                        $consolidacion = $proceso->Comprobar_Boolean($consolidacion);
                        
                        //cartera vencida
                        $cartera_vencida = utf8_decode($row[11]);
                        $cartera_vencida = $proceso->Comprobar_Boolean($cartera_vencida);
                        
                        //abono
                        $boolean_abono = utf8_decode($row[13]);
                        $boolean_abono = $proceso->Comprobar_Boolean($boolean_abono);
                        
                        //tipo de pago
                        $tipo_pago = $proceso->get_Tipo_Pago($row[14],$row[15],$row[16]);

                        //proxima cita
                        $fecha_proxima_cita = $proceso->get_Fecha_Proxima_Cita($row[18],$row[19]);
                        $id_geo = $row[0];
                        $tipo = $row[4];
                        $direccion = $row[6];
                        $motivo = $row[9];
                        $comentario_no_consolidacion = $row[11];
                        $proximo_paso = $row[17];
                        try {
                            $evento= Evento::create([
                                'EV_ID_GEO'=> $id_geo,
                                'EV_fecha'=> $fecha_evento,
                                'EV_asesor'=> $asesor->AS_ID,
                                'EV_cliente'=> $cliente->CL_ID,
                                'EV_tipo'=> $tipo,
                                'EV_direccion'=> $direccion,
                                'EV_hora'=> $hora_visita,
                                'EV_motivo'=> $motivo,
                                'EV_consolidacion'=> $consolidacion,
                                'EV_comentario_no_consolidacion' => $comentario_no_consolidacion,
                                'EV_cartera_vencida' => $cartera_vencida,
                                'EV_abono'=> $boolean_abono,
                                'EV_dinero_abono'=> $tipo_pago["dinero"],
                                'EV_tipo_pago'=> $tipo_pago["tipo_pago"],
                                'EV_proximo_paso'=> $proximo_paso,
                                'EV_fecha_proxima_cita'=> $fecha_proxima_cita,
                                ]);
                                
                            $cliente->CL_ultima_visita= $fecha_evento;

                            $numero_visitas = Evento::where('EV_cliente', '=', $cliente->CL_ID)->count();
                            $cliente->CL_numero_visitas= $numero_visitas;

                            $visitas_asesor = Evento::where('EV_asesor', '=', $asesor->AS_ID)->count();

                            $asesor->AS_visita = $visitas_asesor;
                            
                            if($consolidacion == true){

                                $cliente->CL_ultima_compra= $fecha_evento;
                                
                                $numero_compras = Evento::where('EV_cliente', '=', $cliente->CL_ID)->where('EV_consolidacion', '=','1')->count();
                                
                                $cliente->CL_numero_compras = $numero_compras;
                                
                                $numero_ventas = Evento::where([
                                    ['EV_asesor', '=', $asesor->AS_ID],
                                    ['EV_consolidacion', '=', '1'],
                                    ])->count();
                                                    
                                $compra_cliente = Evento::where([
                                    ['EV_cliente', '=', $cliente->CL_ID],
                                    ['EV_consolidacion', '=', '1'],
                                    ])->pluck('EV_dinero_abono');

                                    $total = 0;

                                    $asesor->AS_ventas_total = $numero_ventas;

                                    if($cliente->CL_numero_compras != 0 && $cliente->CL_numero_visitas != 0){
                                        $calculo = ($cliente->CL_numero_compras / $cliente->CL_numero_visitas)*100;
                                        $calculo = number_format($calculo, 2, ",", ".");  
                                        $cliente->CL_porcentaje_ventas = $calculo;
                                        
                                    }
                                    if($asesor->AS_ventas_total != 0 && $asesor->AS_visita != 0){
                                        $calculo = ($asesor->AS_ventas_total / $asesor->AS_visita)*100;
                                        $calculo = number_format($calculo, 2, ",", ".");  
                                        $asesor->AS_porcentaje_ventas = $calculo;
                                    }
                                }

                            $asesor->save();
                            $cliente->save();
                            
                            $contador_registros++;
                            }catch(\Exception $e){
                                if($e->getCode() == '23000'){
                                    $this->errores[$contador_errores]= 'El evento de la fila '. $alt .' ya se encuentra registrado';
                                }
                                elseif(substr($e->getMessage(),0,22) == "Trying to get property"){
                                    $this->errores[$contador_errores] = 'El asesor o cliente no existen en la fila ' . $alt;
                                }else{
                                    $this->errores[$contador_errores]=$e->getMessage() . ' en la fila numero ' . $alt;
                                }
                            report($e);
                            $contador_errores++;
                        }
                    }
                    $contador_filas++;
                }
                if($contador_errores > 0){
                    $this->numero_errores = $contador_errores;
                }
                if($contador_filas > 0){
                    $this->numero_filas = $contador_filas;
                }
                if($contador_registros > 0){
                    $this->numero_registros = $contador_registros-1;
                }
            }
    }
    
    public function getErrores(){
        return $this->errores;
    }
    
    public function getNumberRegister(){
        return $this->numero_registros;
    }

    public function getNumberFilas(){
        return $this->numero_filas;
    }

    public function getNumberError(){
        return $this->numero_errores;
    }

}


