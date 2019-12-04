<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exports\VencidosExport;
use Maatwebsite\Excel\Facades\Excel;
 


class VencidoController extends Controller
{
    public function index(){


        $cargos_vencidos = DB::table('cargos')
        ->where('vencimiento', '<=', date('Y-m-d H:i:s'))
        ->where('lote', '!=', null)
        ->where('stock_actual', '!=', 0)
        ->get();

        return view('vencidos', array(
            'cargos' => $cargos_vencidos
        ));
    }

    public function export() 
    {
        return Excel::download(new VencidosExport, 'vencidos.xlsx');
    }
}
