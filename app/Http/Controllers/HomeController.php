<?php

namespace App\Http\Controllers;

use App\Imports\CargosImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Cargo;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{

    public $cargos;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $cargos_vencidos = DB::table('cargos')
        ->where('vencimiento', '<=', date('Y-m-d H:i:s'))
        ->where('lote', '!=', null)
        ->get();

        return view('/home', array(
            'vencidos' => $cargos_vencidos->count()
        ));
    }
 
    public function import(){            
            Excel::import(new CargosImport,request()->file('file'));
            return back()->with(array(

                'message' => 'La información se ha importado correctamente.'
      
                ));
    }

    public function emails(){   

        //Recibo los cargos que tengan el campo de correo rellenado
        $cargos = DB::table('cargos')->where('correo', '!=', NULL)->get();
        
        // Barro la colección 
        foreach($cargos as $cargo){
            
            // Fecha actual y ultimo correo enviado 
            $ultimo = date('Y-m-d H:i:s');
            // Fecha de proximo correo 
            $proximo = date('Y-m-d H:i:s', strtotime($ultimo."+ 15 days"));
            
            // Filtro que el stok no sea igual a 0, 
            // que la fecha de creación sea igual a la fecha actual 
            // o que la fecha del proximo correo sea menor o igual a la actual
            if($cargo->stock_actual != 0 && $cargo->created_at == $ultimo || $cargo->proximo <= $ultimo ){
                
                // Actualizo los registros por su id 
                 $cargoActualizado = Cargo::findOrFail($cargo->id);
                 $cargoActualizado->ultimo = $ultimo;
                 $cargoActualizado->proximo = $proximo;
                 $cargoActualizado->update();

                // Enviar correo 
                Mail::send('mails.cargo_disponible', ['cargo' => $cargo], function($c) use ($cargo){
                     $c->to($cargo->correo)
                     ->subject('Material disponible en bodega.');
                });

              
            }
            

        }

        return back()->with(array(

            'message' => 'Los correos se enviaron correctamente.'
  
            ));
    }
}