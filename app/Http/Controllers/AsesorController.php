<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asesor;
use App\Imports\AsesorImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class AsesorController extends Controller
{
    
    public function post_importar_asesor(Request $request){

        $archivo = $request->file('asesor');
        $importacion=new AsesorImport;

        try {
            $validar= Excel::import($importacion,$archivo);
            $numero_errores= $importacion->getNumberError();
            $numero_registros = $importacion->getNumberRegister();
            $nombre = $archivo->getClientOriginalName();
            $now = new \DateTime();
            $now = $now->format('d_m_Y_H_i_s');
            $nombre = $now . '_' . $nombre;
            $archivo->storeAs( 
                "asesores", $nombre
            );
            return redirect('/proceso')->with([
                'numero_errores' => $numero_errores,
                'numero_registros' => $numero_registros,
            ]);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            report($e);
            return redirect('/proceso')->with([
                'error' => $error,
            ]);
        }
    }

    public function get_asesores(){
        $asesores = Asesor::orderBy('AS_ID','DESC')->paginate(15);
        return view('asesor.index',[
            'asesores' => $asesores,
        ]);

    }

}
