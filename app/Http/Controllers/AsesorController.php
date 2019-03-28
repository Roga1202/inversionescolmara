<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\AsesorImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class AsesorController extends Controller
{
    
    public function post_importar_asesor(){
        $importacion=new AsesorImport;
        Excel::import($importacion,'asesor.xlsx');
        $numero_errores= $importacion->getNumberError();
        $numero_registros = $importacion->getNumberRegister();
        return redirect('/proceso')->with([
            'numero_errores' => $numero_errores,
            'numero_registros' => $numero_registros,
        ]);
    }
}