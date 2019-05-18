<?php

namespace App\Imports;

use App\Asesor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Controllers\ProcesoController;


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
        if ($rows[0][0] != "Imei") {
            $error = "El archivo no pertenece a los asesores";
            $notificacion = False;
            return back()->with([
                'error_critico' => $error,
                'notificacion' => $notificacion
                ]);
        } else {
            foreach ($rows as $row)
            {
                $alt = $contador_filas+1;
                if ($contador_filas != 0 and $row[0] != null) {
                    $proceso = new ProcesoController;
                    
                    $nombre = $proceso->Revisar_String($row[2]);
                    if($nombre != null){
                        $imei = $proceso->Revisar_String($row[0]);
                        $grupo = $proceso->Revisar_String($row[1]);
                        $telefono = $proceso->Revisar_String($row[3]);
                        $alias = $proceso->Revisar_String($row[7]);
                        
                        
                        try {
                            Asesor::create([
                                'AS_nombre'=> $nombre,
                                'AS_IMEI'=> $imei,
                                'AS_grupo'=> $grupo,
                                'AS_telefono'=> $telefono,
                                'AS_alias'=> $alias,
                                ]);
                                $contador_registros++;
                            }catch(\Exception $e){
                                if($e->getCode() == '23000'){
                                $this->errores[$contador_errores]= 'El asesor o telefono de la fila '. $alt .' ya se encuentra registrado';
                            }else{
                                $this->errores[$contador_errores]=$e->getMessage() . ' en la fila numero ' . $alt;
                            }
                            report($e);
                            $contador_errores++;
                        }

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
                $this->numero_registros = $contador_registros;
            }
                # code...
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