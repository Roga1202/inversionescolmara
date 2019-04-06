<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ClienteImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Cliente;

class ClienteController extends Controller
{
    public function post_importar_cliente(Request $request){

        $archivo = $request->file('cliente');
        $importacion=new ClienteImport;
        try {
            $validar= Excel::import($importacion,$archivo);
            $numero_errores= $importacion->getNumberError();
            $numero_registros = $importacion->getNumberRegister();
            $nombre = $archivo->getClientOriginalName();

            $now = new \DateTime();
            $now = $now->format('d_m_Y_H_i_s');
            $nombre = $now . '_' . $nombre;
            $archivo->storeAs( 
                "clientes", $nombre
            );
            return redirect('/proceso')->with([
                'numero_errores' => $numero_errores,
                'numero_registros' => $numero_registros,
            ]);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            report($e);
            return redirect('/proceso')->with([
                'error' => $error,
            ]);
        }
    }
    
    public function get_clientes(){
        $clientes = Cliente::orderBy('CL_ID','ASC')->paginate(15);
        return view('cliente.index',[
            'clientes' => $clientes,
        ]);

    }

}
