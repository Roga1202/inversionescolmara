<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asesor;
use App\Cliente;
use App\Evento;

class IndexController extends Controller
{
    //
    
    public function get_index(){
        return view('index');
    }
    
    public function get_home(){
        return view('Proceso.index');
    }

}
