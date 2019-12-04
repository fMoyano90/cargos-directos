<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;

class UsuarioController extends Controller
{

    public function index(){

        $usuarios = DB::table('users')->get();

        return view('usuarios', array(
            'usuarios' => $usuarios
        ));
    }

    public function delete($id){
        
        $usuario = User::find($id);
          
          //Eliminar registro 
          $usuario->delete();

          return redirect()->action('HomeController@index')->with(array(

          'message' => 'El usuario se elimino correctamente'

          ));
          
    }

    public function update($id, Request $request){
        $user = \Auth::user();
        $user = User::findOrFail($id);

        $user->role = $request->input('role');

        $user->update();

        return redirect()->action('HomeController@index')->with(array(

            'message' => 'El usuario se actualizo correctamente'
  
            ));
            
    }
}
