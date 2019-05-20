<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Asesor;
use App\Cliente;

class ReporteController extends Controller
{

    public function get_data(){

        $data['asesor'] = Asesor::all();
        $data['cliente'] = Cliente::all();

        $data['grupo'] = Cliente::distinct()->pluck('CL_grupo');

        return response()->json($data);
    }
}
