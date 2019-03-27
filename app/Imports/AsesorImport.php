<?php

namespace App\Imports;

use App\Asesor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class AsesorImport implements ToCollection
{
    
    private $errores = [];
    private $numero_registros = 0;
    private $numero_errores = 0;

    public function collection(Collection $rows)
    {
        $errores= [];
        $contador_registros = 0;
        $contador_errores = 0;
        foreach ($rows as $row)
        {
            if ($contador_registros != 0) {
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
                }catch(\Exception $e){
                    $this->errores[$contador_errores]=$e->getMessage();
                    report($e);
                    $contador_errores++;
                }
            }
            $contador_registros++;
        }
        
        if($contador_errores > 0){
            $this->numero_errores = $contador_errores;
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

    public function getNumberError(){
        return $this->numero_errores;
    }
}
