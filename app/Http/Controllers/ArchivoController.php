<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\AsesorImport;
use App\Imports\ClienteImport;
use App\Imports\EventoImport;
use Maatwebsite\Excel\Facades\Excel;

class ArchivoController extends Controller
{
    public function post_importar(Request $request){
        if($request->file('asesor')){
            $archivo = $request->file('asesor');
            $importacion=new AsesorImport;
        }elseif($request->file('cliente')) {
            $archivo = $request->file('cliente');
            $importacion=new ClienteImport;
        }elseif($request->file('evento')) {            
            $archivo = $request->file('evento');
            $importacion=new EventoImport;
        }
        
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
}
