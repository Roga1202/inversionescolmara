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
}
