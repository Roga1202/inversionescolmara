<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Imports\AsesorImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\EventoImport;
use App\Evento;

class EventoController extends Controller
{
    public function post_importar_evento(Request $request){

        $archivo = $request->file('evento');
        $importacion=new EventoImport;

        try {
            Excel::import($importacion,$archivo);
            $numero_errores= $importacion->getNumberError();
            $numero_registros = $importacion->getNumberRegister();
            $nombre = $archivo->getClientOriginalName();
            $now = new \DateTime();
            $now = $now->format('d_m_Y_H_i_s');
            $nombre = $now . '_' . $nombre;
            $archivo->storeAs( 
                "eventos", $nombre
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

    
    public function get_eventos(){
        $eventos = Evento::orderBy('EV_ID','ASC')->paginate(15);
        return view('evento.index',[
            'eventos' => $eventos,
        ]);
    }
}
