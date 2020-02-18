<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Cargo;


class HistorialController extends Controller
{
    //

    public function index(Request $request)
    {
            $cargos = DB::table('cargos')
            ->where('nro_contable', '!=', null)->orderby('created_at', 'desc')->paginate(10);

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
        
    

    public function delete($id){
        
        $cargo = Cargo::find($id);
          
          //Eliminar registro 
          $cargo->delete();

          return redirect()->action('HomeController@index')->with(array(

          'message' => 'El cargo se elimino correctamente'

          ));
          
    }

}
