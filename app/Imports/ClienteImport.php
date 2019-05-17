<?php

namespace App\Imports;

use App\Cliente;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Controllers\ProcesoController;


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

                $proceso = new ProcesoController;
                
                $id_geo = $proceso->Revisar_String($row[0]);
                $grupo = $proceso->Revisar_String($row[1]);
                $referencia = $proceso->Revisar_String($row[2]);
                $nombre = $proceso->Revisar_String($row[5]);
                $longitud = $proceso->Revisar_String($row[7]);
                $latitud = $proceso->Revisar_String($row[6]);
                $radio = $proceso->Revisar_String(intval($row[8]));
                $direccion = $proceso->Revisar_String($row[9]);
                $direccion_descripcion = $proceso->Revisar_String($row[10]);
                $color = $proceso->Revisar_String($row[11]);
                $telefono = $proceso->Revisar_String($row[12]);
                $correo = $proceso->Revisar_String($row[13]);

                

                try {
                    Cliente::create([
                        'CL_ID_GEO'=> $id_geo,
                        'CL_grupo'=> $grupo,
                        'CL_referencia'=> $referencia,
                        'CL_nombre_completo'=> $nombre,
                        'CL_direccion'=> $direccion,
                        'CL_direccion_descripcion'=> $direccion_descripcion,
                        'CL_telefono'=> $telefono,
                        'CL_correo'=> $correo
                    ]);
                    $contador_registros++;
                }catch(\Exception $e){
                    if($e->getCode() == '23000'){
                        $this->errores[$contador_errores]= 'El cliente de la fila '. $contador_filas .' ya se encuentra registrado';
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