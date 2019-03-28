<?php

namespace App\Imports;

use App\Cliente;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class ClienteImport implements ToCollection
{
    
    private $errores = [];
    private $numero_registros = 0;
    private $numero_filas = 0;
    private $numero_errores = 0;

    public function collection(Collection $rows)
    {
        $errores= [];
        $contador_filas = 0;
        $contador_errores = 0;
        $contador_registros = 0;
        foreach ($rows as $row)
        {
            if ($contador_filas != 0 and $row[0] != null) {
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
                    $this->errores[$contador_errores]=$e->getMessage();
                    report($e);
                    $contador_errores++;
                }
                $contador_registros++;
            }
            $contador_filas++;
        }
        if($contador_errores > 0){
            $this->numero_errores = $contador_errores-1;
        }
        if($contador_filas > 0){
            $this->numero_filas = $contador_filas-1;
        }
        if($contador_registros > 0){
            $this->numero_registros = $contador_registros-1;
        }
    }
    
    public function getErrores(){
        return $this->errores;
    }
    
    public function getNumberRegister(){
        return $this->numero_registros;
    }

    public function getNumberFilas(){
        return $this->numero_filas;
    }

    public function getNumberError(){
        return $this->numero_errores;
    }

}