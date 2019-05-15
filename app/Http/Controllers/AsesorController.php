<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asesor;
use App\Imports\AsesorImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

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

}
