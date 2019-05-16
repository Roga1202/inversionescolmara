<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asesor;
use App\Imports\AsesorImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Http\Requests\updated_asesor_request;


class AsesorController extends Controller
{
    public function get_asesores(){
        $asesores = Asesor::all();
        return view('asesor.index',[
            'asesores' => $asesores,
        ]);

    } 

    public function getasesor(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $info = Asesor::find($id);
            return response()->json($info);
        }
    }

    public function postactualizar(updated_asesor_request $request)
    {

        $id = $request->id;
        $asesor = Asesor::findorfail($id);
        $asesor->AS_cedula = $request->input('cedula');
        $asesor->AS_tipo = $request->input('tipo');
        $asesor->AS_direccion = $request->input('direccion');
        $asesor->AS_telefono = $request->input('telefono');
        $asesor->AS_telefono_emergencia = $request->input('telefono_emergencia');
        $asesor->AS_correo = $request->input('correo');
        $asesor->AS_IMEI = $request->input('imei');
        $asesor->AS_alias = $request->input('alias');
        
        $response = $asesor->save();

        if($response){
            $message  = "El Asesor fue actualizado.";
        }
        else{
            $message = "El Asesor no pudo ser actualizado";
        }
        return $message;

    }

    public function posteliminar(Request $request)
    {
        $id = $request->id;
        \App\Evento::where('EV_asesor', '=', $id)->delete();
        $data = Asesor::find($id);
        $response = $data->delete();
        if($response){
            $message  = "El Asesor ya fue Eliminado.";
        }
        else{
            $message = "Hubo un problema al eliminar el Asesor  ";
        }
        return $message;
    }
}
