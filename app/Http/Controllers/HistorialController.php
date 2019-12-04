<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Cargo;


class HistorialController extends Controller
{
    //

    public function index()
    {
        $cargos = DB::table('cargos')->where('nro_contable', '!=', null)->orderby('created_at', 'desc')->paginate(10);



        return view('historial', array(
            'cargos' => $cargos
        ));
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
