<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ClienteImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ProcesoController extends Controller
{
    public function get_index(){
        $importacion = new ClienteImport;
        Excel::import($importacion, 'resultado.xlsx');
        $numero_errores= $importacion->getNumberError();
        $numero_registros = $importacion->getNumberRegister();
        return view('Proceso.index',[
            'numero_errores' => $numero_errores,
            'numero_registros' => $numero_registros
        ]);
    }
}
