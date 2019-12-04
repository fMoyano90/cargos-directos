<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CargosImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Cargo;
use App\Correo;
use App\Mail\CargoDisponible;
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
        $emails_array = DB::table('cargos')->where('correo', '!=', NULL)->pluck('correo');
        
        $this->guardarEmails($emails_array);

        $emails = DB::table('correos')->pluck('correo');
        $correos = DB::table('correos')->get();

        Mail::to($emails)->send(new CargoDisponible());
        
        // foreach($correos as $correo){
        //     $fecha_actual = date('Y-m-d');

        //    if($correo->primero == $fecha_actual || is_null($correo->primero)){
               
        //        Mail::to($correo->correo)->send(new CargoDisponible());
        //        return back()->with(array(

        //            'message' => 'Los correos se enviaron correctamente.'
        
        //            ));
               
        //     }
        //     elseif($correo->segundo == $fecha_actual){
                
        //        Mail::to($correo->correo)->send(new CargoDisponible());
        //        return back()->with(array(

        //            'message' => 'Los correos se enviaron correctamente.'
        
        //            ));
        //     }
        //     elseif($correo->segundo == $fecha_actual){
                
        //         Mail::to($correo->correo)->send(new CargoDisponible());
        //         return back()->with(array(

        //            'message' => 'Los correos se enviaron correctamente.'
        
        //            ));
           
        //     }else{
        //         return back()->with(array(

        //             'message' => 'No existen nuevos destinatarios.'
          
        //             ));
        //     }

        // }

        return back()->with(array(

            'message' => 'Los correos se enviaron correctamente.'
  
            ));
    }

    public function guardarEmails($collection){
        $fecha_ingreso = date('Y-m-d H:i:s');
        $segunda_fecha = date('Y-m-d H:i:s', strtotime($fecha_ingreso."+ 5 days"));
        $tercera_fecha = date('Y-m-d H:i:s', strtotime($fecha_ingreso."+ 10 days"));

        foreach($collection as $data){
            DB::table('correos')->insertOrIgnore([
                'correo' => $data,
                'primero' => $fecha_ingreso,
                'segundo' => $segunda_fecha,
                'tercero' => $tercera_fecha,
            ]);
        }
 
    }
}