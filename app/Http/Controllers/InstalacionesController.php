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

      if ($usuario->rol==2) {
        if ($usuario->id==2) {
          $instalaciones = DB::table('instalaciones')
                  ->where("id", "2")
                  ->get();
        } else{
          $instalaciones = DB::table('instalaciones')
                  ->where("id", "<>", "1")
                  ->get();
          }
      }

      if ($usuario->rol==3) {
        $instalaciones = DB::table('instalaciones')
                    ->where("id", "<>", "1")
                    ->get();
      }

    	return view("home", ["Instalaciones" => $instalaciones, "Usuario" => $usuario]);			

    }

    public function RegistarInstalacion(Request $Request){
      $nombre_instalacion = $_POST["nombre_instalacion"];
      $modelo_equipo = $_POST["modelo_equipo"];
      $numero_serie = $_POST["numero_serie"];
      $tabla_asociada = $_POST["tabla_asociada"];
      $controlador = $_POST["controlador"];
      $latitud = $_POST["latitud"];
      $longitud = $_POST["longitud"];

      DB::table("instalaciones")
          ->insert([
            "nombre" => $nombre_instalacion,
            "modelo_equipo" => $modelo_equipo,
            "numero_serie" => $numero_serie,
            "tabla_asociada" => $tabla_asociada,
            "controlador" => $controlador,
            "latitud" => $latitud,
            "longitud" => $longitud

            ]);

          return redirect("RegistrarInstalacion?m=1");
    }

    public function EditarInstalacion(){
      $Instalaciones=DB::table("instalaciones")
                          ->get();

      return view("instalaciones.editar", [ "Instalaciones" => $Instalaciones, "Usuario" => Auth::user() ]);

    }

}
