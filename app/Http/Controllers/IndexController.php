<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    
    public function get_index(){
        return view('welcome');
    }
    
    public function get_home(){
        return view('Proceso.index');
    }

}
