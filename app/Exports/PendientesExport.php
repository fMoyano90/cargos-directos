<?php

namespace App\Exports;

use App\Cargo;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class PendientesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('cargos')->where('stock_actual', '!=', 0)->orderby('created_at','desc')->paginate(10);

    }
}
