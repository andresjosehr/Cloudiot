<?php

namespace App\Http\Controllers;

use Request;
use DB;

class PruebaController extends Controller{
    public function index(){


    $ruta = Request::segment(1);

    echo $ruta;
               


    }
}
