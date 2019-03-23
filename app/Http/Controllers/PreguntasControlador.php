<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\contacto;

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

    // Defino el método para el contacto
    public function sendContacto(Request $request) {
        
        // Creo una nueva instancia del modelo contacto conectado a la base de datos
        $contacto = new contacto;

        // Valido los datos del formulario de contacto
        $request->validate([
            // El mail es requerido, tiene que ser de tipo mail y como máximo tiene que ser de 255 carácteres.
            'email' => 'required|email|max:255',
            // El texto del contacto es requerido, tiene que tener como minimo 15 carácteres y como máximo tiene que ser de 255 carácteres.
            'texto_contacto' => 'required|min:15|max:255'
        ]);
        
        // Asocio cada campo del formulario con el campo de la base de datos
        $contacto->email = $request->email;
        $contacto->texto_contacto = $request->texto_contacto;
        
        // Guardo los datos y se insertan en la fila del usuario.
        $contacto->save();

        // Redirijo a la página del contacto con un mensaje de que se ha enviado el formulario de contacto.
        return redirect('contacto')->with('success','Gracias! Has enviado tu consulta, pronto nos pondremos en contacto contigo via email.');

    }


}
