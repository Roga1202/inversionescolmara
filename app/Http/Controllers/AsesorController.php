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
        $asesores = Asesor::orderBy('AS_ventas_total','desc')->get();
        return view('asesor.index',[
            'asesores' => $asesores,
        ]);

    } 

    public function ajax_asesores(){

        $asesores = Asesor::all();

        foreach ($asesores as $asesor) {
        $asesor->AS_porcentaje_ventas = $asesor->AS_porcentaje_ventas . '%';
        }
        
        return response()->json($asesores);
    }

    public function getasesor(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $info = Asesor::find($id);
            return response()->json($info);
        }
    }
}
