<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Imports\AsesorImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\EventoImport;

class EventoController extends Controller
{
    public function post_importar_evento(){
        $importacion = new EventoImport;
        Excel::import($importacion, 'formulario_historico.xlsx');
        dd($importacion);
        $numero_errores= $importacion->getNumberError();
        $numero_registros = $importacion->getNumberRegister();
        return redirect('/proceso')->with([
            'numero_errores' => $numero_errores,
            'numero_registros' => $numero_registros,
        ]);
    }
}
