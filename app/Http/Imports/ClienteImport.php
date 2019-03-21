<?php

namespace App\Imports;

use App\Cliente;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class ClienteImport implements ToCollection
{
    
    private $errores;
    private $numero_registros;

    public function collection(Collection $rows)
    {
        $errores= [];
        $contador = 0;
        $i = 0;
        foreach ($rows as $row)
        {
            if ($contador != 0) {
                try {
                    Cliente::create([
                        'CL_ID_GEO'=> $row[0],
                        'CL_grupo'=> $row[1],
                        'CL_referencia'=> $row[2],
                        'CL_nombre_completo'=> $row[5],
                        'CL_longitud'=> $row[7],
                        'CL_latitud'=> $row[6],
                        'CL_radio'=> intval($row[8]),
                        'CL_direccion'=> $row[9],
                        'CL_direccion_descripcion'=> $row[10],
                        'CL_color'=> $row[11],
                        'CL_telefono'=> $row[12],
                        'CL_correo'=> $row[13]
                    ]);
                }catch(\Exception $e){
                    $this->errores[$i]=$e->getMessage();
                    report($e);
                    $i++;
                }
            }
            $contador++;
        }
        $this->numero_registros = $contador;
    }

    public function getErrores(){
        return $this->errores;
    }

    public function getNumberError(){
        return $this->numero_registros;
    }
}
