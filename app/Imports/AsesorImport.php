<?php

namespace App\Imports;

use App\Asesor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class AsesorImport implements ToCollection
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
                    Asesor::create([
                        'AS_nombre'=> $row[2],
                        'AS_IMEI'=> $row[0],
                        'AS_grupo'=> $row[1],
                        'AS_telefono'=> $row[3],
                        'AS_fabricante_tlf'=>$row[4],
                        'AS_modelo_tlf'=> $row[5],
                        'AS_OS_tlf'=> $row[6],
                        'AS_alias'=> $row[7],
                        'AS_estado'=> intval($row[8]),
                        'AS_ultima_fecha'=> $row[9],
                        'AS_ultima_hora'=> $row[10],
                        'AS_ultimo_reporte'=> $row[11],
                        'AS_version_app'=> $row[13],
                    ]);
                    $contador_registros++;
                }catch(\Exception $e){
                    if($e->getCode() == '23000'){
                        $this->errores[$contador_errores]= 'El asesor o telefono de la fila '. $contador_filas .' ya se encuentra registrado';
                    }else{
                        $this->errores[$contador_errores]=$e->getMessage() . ' en la fila numero ' . $contador_filas;
                    }
                    report($e);
                    $contador_errores++;
                }
            }
            $contador_filas++;
        }
        if($contador_errores > 0){
            $this->numero_errores = $contador_errores;
        }
        if($contador_filas > 0){
            $this->numero_filas = $contador_filas;
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