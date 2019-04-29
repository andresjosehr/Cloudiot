<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SanJavierController extends Controller
{
    public function index()
    {
        return view("modals.SanJavier.SanJavier");
    }
}
