<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MaitenalController extends Controller
{
    public function index(){


    	return view("modals.Maitenal.Maitenal");
    }
}
