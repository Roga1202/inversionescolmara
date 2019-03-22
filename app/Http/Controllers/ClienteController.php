<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ClienteImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ClienteController extends Controller
{
    public function post_importar_cliente(){
        $importacion = new ClienteImport;
        Excel::import($importacion, 'resultado.xlsx');
        $numero_errores= $importacion->getNumberError();
        $numero_registros = $importacion->getNumberRegister();
        return redirect('/proceso')->with([
            'numero_errores' => $numero_errores,
            'numero_registros' => $numero_registros,
        ]);
    }

}
