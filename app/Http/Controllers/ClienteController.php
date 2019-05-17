<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ClienteImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Cliente;
use App\Http\Requests\updated_cliente_request;

class ClienteController extends Controller
{
    public function get_clientes(){
        
        $clientes = Cliente::orderBy('CL_porcentaje_ventas','desc')->get();

        return view('cliente.index',[
            'clientes' => $clientes,
        ]);
    }

    
    public function getcliente(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $info = Cliente::find($id);
            return response()->json($info);
        }
    }

    public function calculated_cliente(){
        
    }
}
