<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Mail;
use DB;

class TestingController extends Controller
{
    public function index()
    {

    	

		$client = new Client(['cookies' => true, 'http_errors' => false]);


		$response = $client->post('http://localhost/Temporal/Interline/Cloudiot/public/login', [
						    'form_params' => [
						        'email' => "admin",
						        'password' => "admin",
						    ],
						]
						);







		$SicutIgnis = $client->post(url("SicutIgnisController"), [
		    'form_params' => [
		        'id' => '1',
		        'tabla_asociada' => '',
		        'rol' => '1'
		    ]
		]);

		$Datos["SicutIgnisUltimaFecha"]=DB::connection("telemetria")->select("SELECT * FROM log_aasa ORDER BY mt_time DESC LIMIT 1");

		$VinaLuisFelipe = $client->post(url("VinaLuisFelipeController"), [
		    'form_params' => [
		        'id' => '2',
		        'tabla_asociada' => '',
		        'rol' => '1'
		    ]
		]);

		$Datos["VinaLuisFelipeUltimaFecha"]=DB::connection("telemetria")->select("SELECT * FROM log_biofil02 ORDER BY mt_time DESC LIMIT 1");

		$SanJavier = $client->post(url("SanJavierController"), [
		    'form_params' => [
		        'id' => '7',
		        'tabla_asociada' => '',
		        'rol' => '1'
		    ]
		]);

		$Datos["SanJavierUltimaFecha"]=DB::connection("telemetria")->select("SELECT * FROM log_biofil03 ORDER BY mt_time DESC LIMIT 1");

		$Maitenal = $client->post(url("MaitenalController"), [
		    'form_params' => [
		        'id' => '5',
		        'tabla_asociada' => '',
		        'rol' => '1'
		    ]
		]);

		$Datos["MaitenalUltimaFecha"]=DB::connection("telemetria")->select("SELECT * FROM log_biofil04 ORDER BY mt_time DESC LIMIT 1");



		$PozoNave4 = $client->post(url("FinningPozoNave4"));

		$PlantaAgua = $client->post(url("FinningPlantaAgua"));
		$Datos["PlantaAguaUltimaFecha"]=DB::connection("telemetria")->select("SELECT * FROM log_finning01 WHERE mt_name LIKE 'PlantaAgua%' ORDER BY mt_time DESC LIMIT 1;");

		$Dinamometro = $client->post(url("FinningDinamometro"));
		$Datos["DinamometroUltimaFecha"]=DB::connection("telemetria")->select("SELECT * FROM log_finning01 WHERE mt_name LIKE 'Dinamometro%' ORDER BY mt_time DESC LIMIT 1;");



		$Datos["OBRA_OB-0501-24UltimaFecha"]=DB::connection("telemetria")->select("SELECT * FROM log_minlascenizas WHERE mt_name LIKE 'MineraLasCenizas_A5%' ORDER BY mt_time DESC LIMIT 1;");


		$Datos["OBRA_OB-0501-23UltimaFecha"]=DB::connection("telemetria")->select("SELECT * FROM log_minlascenizas WHERE mt_name LIKE 'MineraLasCenizas_A2%' ORDER BY mt_time DESC LIMIT 1");



		if ($SicutIgnis->getStatusCode()==200) {
			$Datos["SicutIgnis"] = "Sin errores";
		} else{
			$Datos["SicutIgnis"] = "Con error";
		}
		if ($VinaLuisFelipe->getStatusCode()==200) {
			$Datos["VinaLuisFelipe"] = "Sin errores";
		} else{
			$Datos["VinaLuisFelipe"] = "Con error";
		}
		if ($SanJavier->getStatusCode()==200) {
			$Datos["SanJavier"] = "Sin errores";
		} else{
			$Datos["SanJavier"] = "Con error";
		}
		if ($Maitenal->getStatusCode()==200) {
			$Datos["Maitenal"] = "Sin errores";
		} else{
			$Datos["Maitenal"] = "Con error";
		}

		if ($PozoNave4->getStatusCode()==200) {
			$Datos["PozoNave4"] = "Sin errores";
		} else{
			$Datos["PozoNave4"] = "Con error";
		}

		if ($PlantaAgua->getStatusCode()==200) {
			$Datos["PlantaAgua"] = "Sin errores";
		} else{
			$Datos["PlantaAgua"] = "Con error";
		}

		if ($Dinamometro->getStatusCode()==200) {
			$Datos["Dinamometro"] = "Sin errores";
		} else{
			$Datos["Dinamometro"] = "Con error";
		}

		 $data=array("nombre" => "Informe diario de instalaciones");

		Mail::send("emails.testing", ["Datos" => $Datos], function($m) use ($Datos){
			$m->from("automatizacion@proyex.cl", "Automatizacion");
			// $m->to("hernan.canales@proyex.cl")->subject("Viña XML");

			$m->to("hernan.canales@proyex.cl")->subject("Informe diario de instalaciones");
		});
		

		return "Email enviado correctamente";



    }
}
