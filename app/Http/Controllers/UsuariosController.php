<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Auth;
use DB;
use View;

class UsuariosController extends Controller
{

  public function DisplayInfoAccount($value='')
  {
    return view::make("usuarios.cuenta", ["Usuario" =>  Auth::user()]);
  }

    public function index(){
        $Instalacioness = DB::table("instalaciones")->get();
        $UsuariosTemp = DB::table("users_reg_temp")->get();
        return view("usuarios.registrar", ["Usuario" => Auth::user(), "Instalaciones" => $Instalacioness, "UsuariosTemp" => $UsuariosTemp]);
    }
    
    public function CambiarContrasena(Request $Request){
    	$pass1= bcrypt($_POST["pass1"]);

    	DB::table('users')
            ->where('id', Auth::user()->id)
            	->update(['password' => $pass1]);    
            ?><script>
            	$(".loadingg").css("display", "none");
            	$("#btn_cambiar").css("display", "block");
            	swal("Listo!", "Contraseña cambiada correctamente", "success");
            	document.getElementById('pass1').value="";
				    document.getElementById('pass2').value="";
            </script><?php

            }

    public function PreRegistro(Request $Request){
        
        $Validar=DB::table("users")->where("email", $Request->email)->get();


        if ($Validar!="[]") {
             ?><script>swal("Error", "El email que ingresaste ya esta registrado como un usuario activo", "warning")</script><?php
             die();
         } 

        //Carácteres para la contraseña
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $key = "";
        //Reconstruimos la contraseña segun la longitud que se quiera
        for($i=0;$i<50;$i++) {
           //obtenemos un caracter aleatorio escogido de la cadena de caracteres
           $key .= substr($str,rand(0,62),1);
        }

            DB::table('users_reg_temp')->insert([
                ['email' => $Request->email, 
                 'key' => $key
                ]
            ]);



        if ($Request->instalaciones!=null) {
            for ($i=0; $i <count($Request->instalaciones); $i++) { 
                 DB::table('instalaciones_asignadas_temp')->insert([
                 ['email' => $Request->email, 
                  'id_instalacion' => $Request->instalaciones[$i],
                  'rol' => "1"
                 ]
             ]);
            }
        }



            ?><script>                    
                    swal("Listo", "Hemos enviado un email a la direccion de correo registrada para completar el registro de usuario", "success")
                    $( "#pending_user" ).append("<tr class='<?php echo $key ?>'> <td id='email_temp'><?php echo $Request->email ?></td> <td><button class='btn btn-danger' id='<?php echo $key ?>'>Eliminar</button></td> </tr>");
                    $("#email_user").val("");

                    $('#<?php echo $key ?>').click(function() {
                      $("#reg_usuario").load('<?php echo request()->root() ?>/BorrarPreRegistro', { email: "<?php echo $Request->email ?>", key: "<?php echo $key ?>" });
                    }); 
            </script><?php

    }

    public function BorrarPreRegistro(Request $Request){

      DB::table('users_reg_temp')->where('email', $Request->email)->delete();
      DB::table('instalaciones_asignadas_temp')->where('email', $Request->email)->delete();
      
      ?><script>
        $("#<?php echo $Request->key ?>").empty();
        $("#<?php echo $Request->key ?>").remove();

        swal("Listo", "Usuario eliminado exitosamente", "success")
      </script><?php
    }
}
