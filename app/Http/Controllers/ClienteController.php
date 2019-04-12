<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ClienteImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Cliente;

class ClienteController extends Controller
{
    public function get_clientes(){
        $clientes = Cliente::orderBy('CL_ID','ASC')->paginate(15);
        return view('cliente.index',[
            'clientes' => $clientes,
        ]);

    }

}
