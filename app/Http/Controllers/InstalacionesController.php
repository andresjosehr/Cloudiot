<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
use DB;
use Carbon;

class InstalacionesController extends Controller{

    public function index(){

    	$usuario =  Auth::user();
    	

      $instalaciones= DB::select("SELECT instalaciones.id,
                                         instalaciones.nombre,
                                         instalaciones.tabla_asociada,
                                         instalaciones.controlador,
                                         instalaciones.latitud,
                                         instalaciones.longitud,
                                         instalaciones_asignadas.rol
                                  FROM users 
                                  INNER JOIN instalaciones_asignadas 
                                  ON users.id = instalaciones_asignadas.id_usuario 
                                  INNER JOIN instalaciones 
                                  ON instalaciones_asignadas.id_instalacion = instalaciones.id
                                  WHERE users.id='".Auth::user()->id."' ");



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



    public function PozoSubterraneo()
    {




        $data=array("nombre" => "Viña XML");

        $consulta=DB::connection("telemetria")->select("(SELECT * FROM (SELECT * FROM log_minlascenizas ORDER BY mt_time DESC LIMIT 200) la 
                                                                     WHERE (mt_name='MineraLasCenizas_A5--OB_0501_24.Totalizador'
                                                                         OR mt_name='MineraLasCenizas_A5--OB_0501_24.Caudal'
                                                                         OR mt_name='MineraLasCenizas_A5--OB_0501_24.NivelFreatico') AND mt_time < CURDATE()
                                                                         GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 3) ORDER BY mt_name");


        $data["codigoDeLaObra"]="OB-0501-24";
        $data["caudal"]=$consulta[0]->mt_value;
        $data["nivelFreaticoDelPozo"]=$consulta[1]->mt_value;
        $data["totalizador"]=$consulta[2]->mt_value;
        $data["timeStampOrigen"]=explode(" ", $consulta[0]->mt_time)[0]."T".explode(" ", $consulta[0]->mt_time)[1]."Z";
        $data["fechaMedicion"]=explode(" ", $consulta[0]->mt_time)[0];
        $data["horaMedicion"]=explode(" ", $consulta[0]->mt_time)[1];

         $mytime = Carbon\Carbon::now();
         $mytime = $mytime->format('d_m_Y_h_i_s');
         $handle = fopen(public_path('xml/Vina/'.$mytime.'.xml'), 'w') or die ('Cannot open file:  '.$mytime); //implicitly creates file

        $data["xml_contenido"] = view('emails.ejemplo', ["data" => $data])->render();;
        fwrite($handle, $data["xml_contenido"]);


        $data["nombre_archivo"] = $mytime;





        sleep(2);




        $data2=array("nombre" => "Viña XML");

        $consulta=DB::connection("telemetria")->select("(SELECT * FROM (SELECT * FROM log_minlascenizas ORDER BY mt_time DESC LIMIT 200) la 
                                                                     WHERE (mt_name='MineraLasCenizas_A2--OB_0501_23.Totalizador'
                                                                         OR mt_name='MineraLasCenizas_A2--OB_0501_23.Caudal'
                                                                         OR mt_name='MineraLasCenizas_A2--OB_0501_23.NivelFreatico') AND mt_time < CURDATE()
                                                                         GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 3) ORDER BY mt_name");


        $data2["codigoDeLaObra"]="OB-0501-23";
        $data2["caudal"]=$consulta[0]->mt_value;
        $data2["nivelFreaticoDelPozo"]=$consulta[1]->mt_value;
        $data2["totalizador"]=$consulta[2]->mt_value;
        $data2["timeStampOrigen"]=explode(" ", $consulta[0]->mt_time)[0]."T".explode(" ", $consulta[0]->mt_time)[1]."Z";
        $data2["fechaMedicion"]=explode(" ", $consulta[0]->mt_time)[0];
        $data2["horaMedicion"]=explode(" ", $consulta[0]->mt_time)[1];

         $mytime = Carbon\Carbon::now();
         $mytime = $mytime->format('d_m_Y_h_i_s');
         $handle = fopen(public_path('xml/Vina/'.$mytime.'.xml'), 'w') or die ('Cannot open file:  '.$mytime); //implicitly creates file

        $data2["xml_contenido"] = view('emails.ejemplo', ["data" => $data2])->render();;
        fwrite($handle, $data2["xml_contenido"]);


        $data["nombre_archivo2"] = $mytime;








        Mail::send("emails.ejemplo", ["data" => $data], function($m) use ($data){
          $m->from("Automatizacion@gmail.com", "Automatizacion");
          // $m->to("hernan.canales@proyex.cl")->subject("Viña XML");

          $m->to("joseandreshernandezross@gmail.com")->subject("Viña XML");

           $file = public_path('xml/Vina/'.$data["nombre_archivo"].'.xml');
           $m->attach($file, [ 'as' => 'OB-0501-24"', 'mime' => 'application/xml']);

           $file = public_path('xml/Vina/'.$data["nombre_archivo2"].'.xml');
           $m->attach($file, [ 'as' => 'OB-0501-23', 'mime' => 'application/xml']);
        });

        return "Email enviado exitosamente";
        

    }

}
