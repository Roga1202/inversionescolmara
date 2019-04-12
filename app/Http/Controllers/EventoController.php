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
        $eventos = Evento::orderBy('EV_ID','ASC')->paginate(15);
        return view('evento.index',[
            'eventos' => $eventos,
        ]);
    }
}
