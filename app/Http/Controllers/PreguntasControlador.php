<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreguntasControlador extends Controller
{
    public function index() 
    {
        return view('index');
    }

    public function principal()
    {
        return view('home');
    }
}
