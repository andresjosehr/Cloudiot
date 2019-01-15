<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class InstalacionesController extends Controller{

    public function index(){

    	$usuario =  Auth::user();
    	

      if ($usuario->rol==1) {
        $instalaciones = DB::table('instalaciones')->get();
      }

    	return view("home", ["Instalaciones" => $instalaciones, "Usuario" => $usuario]);			

    }

}
