<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class PlantaLicanController extends Controller{
    public function index(){

    	$id=$_POST['id'];
        $tabla_asociada=$_POST['tabla_asociada'];
    	$instalaciones = DB::table('instalaciones')
												->where("id", $id)
													->first();

    	return view("modals.PlantaLican", ["Instalacion" => $instalaciones]);
    }
}
