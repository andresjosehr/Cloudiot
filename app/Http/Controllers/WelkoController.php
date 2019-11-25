<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelkoController extends Controller
{
    public function index()
    {
    	$Datos=1;
    	return view("modals.welko.welko", ["Datos" => $Datos]);
    }
}
