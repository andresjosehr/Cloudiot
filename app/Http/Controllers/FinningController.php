<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinningController extends Controller
{
    public function index()
    {
    	return view("modals.Finning.Finning");
    }
}
