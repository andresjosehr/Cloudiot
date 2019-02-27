<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class UsuariosController extends Controller
{
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

    public function PreRegistro($Request Request){
        return $Request;
    }
}
