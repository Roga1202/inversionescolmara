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
        
        //EVENTO
        // fecha
        
        // desde
        
        $desde = $request->input('desde');
        //hasta
        $hasta = $request->input('hasta');
        
        if (isset($desde)) {
            $desde = $desde . ' 00:00:00';
        }
        if(isset($hasta)){
            $hasta = $hasta . ' 23:59:59';
        }
        if (empty($desde)) {
            $hasta = null;
        }
        if (empty($hasta)) {
            $hasta = substr(now(),0,10);
        }
        
        
        if(isset($desde) && isset($hasta)){
            if($desde == $hasta){
                $pedido = Evento::whereDate('EV_fecha','=',$desde)->get();
            }else{
                // $pedido = Evento::whereBetween('EV_fecha',array($desde, $hasta))->get();
                $pedido = Evento::whereBetween('EV_fecha',[$desde,$hasta])->get();
            }
        }
        
        //asesores
        if(empty($request->input('asesores'))){
            $asesores = Asesor::orderBy('AS_ID','asc')->pluck('AS_ID');
        }else{
            $asesores = $request->input('asesores');
        }
        //clientes
        if(empty($request->input('clientes'))){
            $clientes = Cliente::orderBy('CL_ID','asc')->pluck('CL_ID');
        }else{
            $clientes = $request->input('clientes');
        }
        //grupos
        if(empty($request->input('grupos'))){
            $grupos = Cliente::orderBy('CL_grupo','asc')->distinct()->pluck('CL_grupo');
        }else{
            $grupos = $request->input('grupos');
        }
        
        if(isset($pedido)){
            if(isset($grupos)){
                $clientes = Cliente::whereIn('CL_grupo',$grupos)->pluck('CL_ID');
                $pedido = $pedido->whereIn('EV_asesor',$asesores)->whereIn('EV_cliente',$clientes);
            }else{
                $pedido = $pedido->whereIn('EV_asesor',$asesores)->whereIn('EV_cliente',$clientes)->get();
            }
        }else{
            if(isset($grupos)){
                $clientes = Cliente::whereIn('CL_grupo',$grupos)->pluck('CL_ID');
                $pedido = Evento::whereIn('EV_asesor',$asesores)->whereIn('EV_cliente',$clientes)->get();
            }
        }
        
        foreach ($pedido as $item) {
            $item['EV_cliente'] = $item->Cliente->CL_nombre_completo;
            $item['EV_asesor'] = $item->Asesor->AS_nombre;
        }

        $data['pedido'] = $pedido;
        //finish EVENTO

        //Cliente
        $pedido_cliente = Cliente::whereIn('CL_ID',$clientes)->orderBy('CL_numero_visitas','desc')->get();
        $data['cliente'] = $pedido_cliente;
        //finish CLIENTE

        //Asesor
        $pedido_asesor = Asesor::whereIn('AS_ID',$asesores)->get();
        $data['asesor'] = $pedido_asesor;
        //finish ASESOR

        // dd($data['pedido']);
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
            $asesor->AS_porcentaje_visitas = ($asesor->AS_visita/$numero_cliente)*100;
        }
        
        return view('reporte.index',[
            'data' => $data,
        ]);
    }
}
