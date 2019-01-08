<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class InstalacionesController extends Controller{

    public function index(){

    	$usuario =  Auth::user();
    	$instalaciones = DB::table('instalaciones')->get();

    	return view("home", ["Instalaciones" => $instalaciones, "Usuario" => $usuario]);
    }

    public function ConsultaModal(Request $request){
		
			$id=$_POST['id'];

			$instalaciones = DB::table('instalaciones')
												->where("id", $id)
													->first();

			return view("modals.modal", ["Instalacion" => $instalaciones]);

    }

}
