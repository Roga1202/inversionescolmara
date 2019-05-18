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
            $errores = $importacion->getErrores();
            $nombre = $archivo->getClientOriginalName();
            $now = new \DateTime();
            $now = $now->format('d_m_Y_H_i_s');
            $nombre = $now . '_' . $nombre;
            if($numero_errores == 0){
                $notificacion = True;
            }else{
                $notificacion = False;
            }
            return back()->with([
                'errores' => $errores,
                'numero_errores' => $numero_errores,
                'numero_registros' => $numero_registros,
                'notificacion' => $notificacion,
                ]);
            } catch (\Exception $e) {
            $error = $e->getMessage();
            dd($e);
            report($e);
            return back()->with([
                'error' => $error,
            ]);
        }
    }
}
