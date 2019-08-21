<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class verificar_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){


        // return "Pata con huevo";

        $usuario = Auth::user();

        if (!$usuario) {

            return redirect("login");

        }

        return $next($request);
    }
}
