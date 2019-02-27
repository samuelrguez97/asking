<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsuariosControlador extends Controller
{
    public function getPerfil() 
    {
        return view('usuarios.perfil');
    }
}
