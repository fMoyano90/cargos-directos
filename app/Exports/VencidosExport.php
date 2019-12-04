<?php

namespace App\Exports;

use App\Cargo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class VencidosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('cargos')
        ->where('vencimiento', '<=', date('Y-m-d H:i:s'))
        ->where('lote', '!=', null)
        ->where('stock_actual', '!=', 0)
        ->get();
    }
}
