<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Exports\PendientesExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Cargo;

class PendienteController extends Controller
{
    //

    public function index()
    {
        $cargos = DB::table('cargos')->where('stock_actual', '!=', 0)->orderby('created_at','desc')->paginate(10);

        return [
            'code' => 200,
            'status' => 'success',
            'cargos' => $cargos,
            'pagination' => [
                'total' => $cargos->total(),
                'current_page' => $cargos->currentPage(),
                'per_page' => $cargos->perPage(),
                'last_page' => $cargos->lastPage(),
                'from' => $cargos->firstItem(),
                'to' => $cargos->lastPage(),
            ],
        ];
    }

    public function search($search = null){

        if(is_null($search)){
            $search = \Request::get('search');
        }

        $cargos = Cargo::where('lote', 'LIKE', '%'.$search.'%')->get(); 

        return view('search', array(
            'cargos' => $cargos,
            'search' => $search
        ));
    }

    public function export() 
    {
        return Excel::download(new PendientesExport, 'pendientes.xlsx');
    }
}



