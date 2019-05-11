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
        
        $clientes = Cliente::all();

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

    public function posteliminar(Request $request)
    {
        $id = $request->id;
        \App\Evento::where('EV_cliente', '=', $id)->delete();
        $data = Cliente::find($id);
        $response = $data->delete();
        if($response){
            $message  = "El Cliente ya fue Eliminado.";
        }
        else{
            $message = "Hubo un problema al eliminar el Cliente  ";
        }
        return $message;
    }

    public function postactualizar(updated_cliente_request $request)
    {

        $id = $request->id;
        $cliente = Cliente::findorfail($id);
        $cliente->CL_referencia = $request->input('referencia');
        $cliente->CL_NIT = $request->input('nit');
        $cliente->CL_direccion = $request->input('direccion');
        
        $response = $cliente->save();

        if($response){
            $message  = "El Cliente fue actualizado.";
        }
        else{
            $message = "El cliente no pudo ser actualizado";
        }
        return $message;

    }

}
