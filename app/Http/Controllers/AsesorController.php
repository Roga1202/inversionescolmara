<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asesor;
use App\Imports\AsesorImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class AsesorController extends Controller
{
    public function get_asesores(){
        $asesores = Asesor::orderBy('AS_ID','DESC')->paginate(15);
        return view('asesor.index',[
            'asesores' => $asesores,
        ]);

    }

}
