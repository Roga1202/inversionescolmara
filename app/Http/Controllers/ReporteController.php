<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Asesor;
use App\Cliente;

class ReporteController extends Controller
{

    public function post_data(){

        $data['asesor'] = Asesor::all();
        $data['cliente'] = Cliente::all();

        $data['grupo'] = Cliente::distinct()->pluck('CL_grupo');
        
        return response()->json($data);
    }
    
    public function get_data(Request $request){
        $asesor_input = $request->input('asesores');
        $cliente_input = $request->input('clientes');
        $grupo_input = $request->input('grupos');
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        
        if (isset($desde)) {
            $desde = $desde . ' 00:00:00';
        }
        if(isset($hasta)){
            $hasta = $hasta . ' 23:59:59';
        }

        if (empty($desde)) {
            $desde = '00-00-00 00:00:00';
        }

        if (isset($desde) && empty($hasta)) {
            $hasta = substr(now(),0,10);
        }
        
        if(isset($desde) && isset($hasta)){
            if($desde == $hasta){
                $pedido = Evento::whereDate('EV_fecha','=',$desde)->get();
            }else{
                $pedido = Evento::whereBetween('EV_fecha',[$desde,$hasta])->get();
            }
        }

        $asesor_input = $request->input('asesores');
        $cliente_input = $request->input('clientes');
        $grupo_input = $request->input('grupos');
        
        //asesores
        if(empty($asesor_input)){
            $asesores_id = Asesor::orderBy('AS_ID','asc')->pluck('AS_ID');
        }
        //clientes
        if(empty($cliente_input)){
            $clientes_id = Cliente::orderBy('CL_ID','asc')->pluck('CL_ID');
        }
        //grupos
        if(empty($grupo_input)){
            $grupos = Cliente::distinct()->pluck('CL_grupo');
        }
        //busqueda de cliente con grupo
        if (isset($grupo_input)) {
            $cliente_grupo = Cliente::whereIn('CL_grupo',$grupo_input)->pluck('CL_ID');
        }

        if(isset($asesor_input) && empty($cliente_input) && isset($grupo_input)){
            $eventos = $pedido->whereIn('EV_cliente',$cliente_grupo)->whereIn('EV_asesor',$asesor_input);
        }
        if(isset($asesor_input) && isset($cliente_input) && empty($grupo_input)){
            $eventos = $pedido->whereIn('EV_asesor',$asesor_input)->whereIn('EV_cliente',$cliente_input);
        }
        if(empty($asesor_input) && empty($cliente_input) && empty($grupo_input)){
            $eventos = $pedido->whereIn('EV_asesor',$asesores_id)->whereIn('EV_cliente',$clientes_id);
        }
        if(empty($asesor_input) && isset($cliente_input) && empty($grupo_input)){
            $eventos = $pedido->whereIn('EV_asesor',$asesores_id)->whereIn('EV_cliente',$cliente_input);
        }
        if(isset($asesor_input) && empty($cliente_input) && empty($grupo_input)){
            $eventos = $pedido->whereIn('EV_asesor',$asesor_input)->whereIn('EV_cliente',$clientes_id);
        }
        if(empty($asesor_input) && empty($cliente_input) && isset($grupo_input)){
            $eventos = $pedido->whereIn('EV_asesor',$asesores_id)->whereIn('EV_cliente',$cliente_grupo);
        }

        if (isset($clientes_id)) {
            $cliente_input = $clientes_id;
        }

        if (isset($asesores_id)) {
            $asesor_input = $asesores_id;
        }        
        

        foreach ($eventos as $item) {
            $item['EV_cliente'] = $item->Cliente->CL_nombre_completo;
            $item['EV_asesor'] = $item->Asesor->AS_nombre;
        }

        $data['pedido'] = $pedido;
        
        //cliente
        $clientes = Cliente::whereIn('CL_ID',$cliente_input)->get();
        $data['cliente'] = $clientes;
        $numero_clientes = count($clientes);
        $data['numero_clientes'] = $numero_clientes;
        //finish CLIENTE

        
        //Asesor
        $asesores = Asesor::whereIn('AS_ID',$asesor_input)->get();
        $data['asesor'] = $asesores;
        $numero_asesores = count($asesores);
        $data['numero_asesores'] = $numero_asesores;
        //finish ASESOR
        
        //procesamiento datos
        foreach ($data['asesor'] as $asesor) {
            
            $visitas = 0;
            $ventas = 0;
            
            foreach ($data['pedido'] as $evento) {
                if ($asesor->AS_nombre == $evento->EV_asesor) {
                    $visitas =$visitas+1;
                    if ($evento->EV_consolidacion == '1') {
                        $ventas =$ventas+1;
                    }
                }
            }
            if($visitas > 0 && $ventas > 0){
                $asesor->AS_porcentaje_ventas = ($ventas/$visitas)*100;
            }else{
                $asesor->AS_porcentaje_ventas = 0;
            }
            $asesor->AS_visita = $visitas;
            $asesor->AS_ventas_total = $ventas;
        }

        foreach ($data['cliente'] as $cliente) {
            $visitas = 0;
            $ventas = 0;
            foreach ($data['pedido'] as $evento) {
                if ($cliente->CL_nombre_completo == $evento->EV_cliente) {
                    $visitas =$visitas+1;
                    if ($evento->EV_consolidacion == '1') {
                        $ventas =$ventas+1;
                    }
                }
            }
            if($visitas > 0 && $ventas > 0){
                $cliente->CL_porcentaje_ventas = ($ventas/$visitas)*100;
                $cliente->CL_porcentaje_ventas = number_format($cliente->CL_porcentaje_ventas,2,".",","); 
            }else{
                $cliente->CL_porcentaje_ventas = 0;
            }
            $cliente->CL_numero_visitas = $visitas;
            $cliente->CL_numero_compras = $ventas;
        }

        foreach ($data['pedido'] as $evento) {
            $id = Cliente::where('CL_nombre_completo',$evento->EV_cliente)->pluck('CL_grupo');
            $evento->EV_cliente_grupo = $id;
        }
        

        $numero_cliente = count($data['cliente']);
        foreach ($data['asesor'] as $asesor) {
            // dd($evento->AS_visita);
            if(($asesor->AS_visita > 0)){
                $asesor->AS_porcentaje_visitas = ($asesor->AS_visita/$numero_cliente)*100;
                $asesor->AS_porcentaje_visitas = number_format($asesor->AS_porcentaje_visitas,2,".",","); 
            }
        }
        
        
        return view('reporte.index',[
            'data' => $data,
        ]);
    }
}
