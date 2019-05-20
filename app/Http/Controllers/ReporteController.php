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

        // fecha

        // desde
        $desde = $request->input('desde');
        //hasta
        $hasta = $request->input('hasta');
        
        if(isset($desde) && isset($hasta)){
            if($desde == $hasta){
                $pedido = Evento::whereDate('EV_fecha','=',$desde)->get();
            }else{
                $pedido = Evento::whereBetween('EV_fecha', array($desde, $hasta))->get();
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
        
        if (empty($desde)) {
            $hasta = null;
        }
        if (empty($hasta)) {
            $hasta = substr(now(),0,10);
        }
        
        if(isset($pedido)){
            if(isset($grupos)){
                $clientes = Cliente::whereIn('CL_grupo',$grupos)->pluck('CL_ID');
                $pedido = $pedido->whereIn('EV_asesor',$asesores)->whereIn('EV_cliente',$clientes)->get();
            }else{
                $pedido = $pedido->whereIn('EV_asesor',$asesores)->whereIn('EV_cliente',$clientes)->get();
            }
        }else{
            if(isset($grupos)){
                $clientes = Cliente::whereIn('CL_grupo',$grupos)->pluck('CL_ID');
                $pedido = Evento::whereIn('EV_asesor',$asesores)->whereIn('EV_cliente',$clientes)->get();
            }
        }
        
        // foreach ($pedido as $evento) {
            
        // }
        return view('reporte.index',[
            'pedido' => $pedido,
        ]);
    }
}
