<?php

namespace App\Imports;

use App\Cargo;
// use Maatwebsite\Excel\Row;
// use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithValidation;

// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\SkipsOnFailure;
// use Maatwebsite\Excel\Concerns\SkipsFailures;
// use Maatwebsite\Excel\Concerns\SkipsOnError;
// use Maatwebsite\Excel\Concerns\SkipsErrors;
// use Illuminate\Validation\Rule;
// use Illuminate\Support\Facades\Validator;

class CargosImport implements ToModel
{  
    use Importable;

    // use SkipsErrors;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {


        if (is_null($row[5]))    {
         $stock = null;
        } 
        elseif (isset($row[5]) && is_null($row[7])) {
            $stock = $row[5];
        }else {
         $num1 = (int)$row[5];
         $num2 = (int)$row[7];
         $stock = $num1 + $num2;
        }

        $fecha_ingreso = date('Y-m-d H:i:s');
        $fecha_vencimiento = date('Y-m-d H:i:s', strtotime($fecha_ingreso."+ 15 days"));
        
        $cargos = Cargo::updateOrCreate([
            'lote'            => $row[0],
            'fecha_entrada'   => $row[1],  
            'detalle'         => $row[2],
            'nro_contable'    => $row[3],
            'ubicacion'       => $row[4],
            'cantidad_stock'  => $row[5],
            'salida'          => $row[6],
            'cantidad_salida' => $row[7],
            'fecha_salida'    => $row[8],
            'correo'          => $row[9],
            'observacion'     => $row[10],
            'stock_actual'    => $stock,
            'vencimiento'     => $fecha_vencimiento,
            'created_at'      => $fecha_ingreso
        ]);

        if (!$cargos->wasRecentyCreated){
                $cargos->update([
                    'lote'            => $row[0],
                    'fecha_entrada'   => $row[1],  
                    'detalle'         => $row[2],
                    'nro_contable'    => $row[3],
                    'ubicacion'       => $row[4],
                    'cantidad_stock'  => $row[5],
                    'salida'          => $row[6],
                    'cantidad_salida' => $row[7],
                    'fecha_salida'    => $row[8],
                    'correo'          => $row[9],
                    'observacion'     => $row[10],
                    'stock_actual'    => $stock
    
                ]);
        }
    }

}

