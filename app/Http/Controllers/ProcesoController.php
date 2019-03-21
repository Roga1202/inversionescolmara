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
        dd($importacion);
        $numero_errores= count($importacion->getErrores());
        return view('Proceso.index');
    }
}
