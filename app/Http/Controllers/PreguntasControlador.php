<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\contacto;
use App\preguntas;
use App\temas;
use App\User;

class PreguntasControlador extends Controller
{
    public function index() 
    {
        if ( Auth::check() )
        {
            principal();
        }
        else
        {
            return view('index');
        }
        
    }

    public function principal()
    {
        $temas = temas::all();
        $preguntas = preguntas::all();
        return view("home", ["temas" => $temas], ["preguntas" => $preguntas]);
    }

    public function getContacto()
    {
        return view('contacto');
    }

    public function sendPregunta(Request $request) {
        

        $request->validate([
            // El usuario es requerido, como máximo tiene que ser de 30 carácteres.
            'usuario' => 'required|max:30',
            // La pregunta es requerida y puede tener como máximo 140 carácteres.
            'pregunta' => 'required|max:140',
            // El tema es requerido y no puede ser igual a selecciona.
            'tema' => 'required',
            // Está requerido marcar las normas como leídas.
            'normas' => 'required'
        ]);

        if ($request->tema != 'selecciona')
        {

            $usuario = User::where('name', $request->usuario)->first();

            if ($usuario != NULL)
            {
                $pregunta = new preguntas;

                $pregunta->usuario = $request->usuario;
                $pregunta->pregunta = $request->pregunta;
                $pregunta->tema = $request->tema;
                $pregunta->respuesta = false;
        
                // Guardo los datos y se insertan la tabla de preguntas.
                $pregunta->save();
        
                return redirect('home')->with('success','¡Has enviado tu pregunta!');
            }
            else
            {
                return redirect('home')->with('error','No existe ese usuario');
            }
        }
        else
        {
            return redirect('home')->with('error','¡Debes elegir un tema!');
        }
        

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
