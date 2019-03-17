<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PreguntasControlador extends Controller
{
    public function index() 
    {
        if ( Auth::check() )
        {
            return view('home');
        }
        else
        {
            return view('index');
        }
        
    }

    public function principal()
    {
        return view('home');
    }

    public function getContacto()
    {
        return view('contacto');
    }

}
