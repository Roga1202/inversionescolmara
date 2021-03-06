<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Imports\AsesorImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\EventoImport;
use App\Evento;
use App\Cliente;
use App\Asesor;

class EventoController extends Controller
{
    public function get_eventos(){

        $eventos = Evento::all();

        foreach ($eventos as $evento) {
            $evento['EV_cliente'] = $evento->Cliente->CL_nombre_completo;
            $evento['EV_asesor'] = $evento->Asesor->AS_nombre;
        }

        return view('evento.index',[
            'eventos' => $eventos,
        ]);
    }

    public function ajax_eventos(){

        $eventos = Evento::all();

        foreach ($eventos as $evento) {
            $evento['EV_cliente'] = $evento->Cliente->CL_nombre_completo;
            $evento['EV_asesor'] = $evento->Asesor->AS_nombre;
        }
        
        return response()->json($eventos);
    }

    public function get_evento_asesor($id){
        $eventos = Evento::where([
            ['EV_asesor', '=', $id],
            ])->get();
        
            foreach ($eventos as $evento) {
                $evento['EV_cliente'] = $evento->Cliente->CL_nombre_completo;
                $evento['EV_cliente_grupo'] = $evento->Cliente->CL_grupo;
                $evento['EV_asesor'] = $evento->Asesor->AS_nombre;
            }

        return response()->json($eventos);
    }

    public function get_evento_cliente($id){
        $eventos = Evento::where([
            ['EV_cliente', '=', $id],
            ])->get();
        
            foreach ($eventos as $evento) {
                $evento['EV_cliente'] = $evento->Cliente->CL_nombre_completo;
                $evento['EV_cliente_grupo'] = $evento->Cliente->CL_grupo;
                $evento['EV_asesor'] = $evento->Asesor->AS_nombre;
            }

        return response()->json($eventos);
    }
     
       
    public function getevento(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $info = Evento::find($id);

            $id_cliente = $info->EV_cliente;
            $cliente = Cliente::find($id_cliente);
            $info['EV_cliente'] = $cliente['CL_nombre_completo'];
            
            $id_asesor = $info->EV_asesor;
            $asesor = Asesor::find($id_asesor);
            $info['EV_asesor'] = $asesor['AS_nombre'];

            
            return response()->json($info);
        }
    }

}
