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

    /* -- Defino el método para enviar una pregunta -- */

    public function sendPregunta(Request $request) {
        
        // Dictamino todas las validaciones de los campos del formulario
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

        // Compruebo si se ha seleccionado el tema
        if ($request->tema != 'selecciona')
        {
            // Selecciono al usuario que concuerda con el usuario introducido
            $usuario = User::where('name', $request->usuario)->first();
            
            // Compruebo si existe el usuario
            if ($usuario != NULL)
            {
                // Genero una nueva instancia del modelo preguntas
                $pregunta = new preguntas;
                
                /* Introduzco todos los datos de la pregunta en la instancia */
                // Introduzco el usuario al que se le envia la pregunta
                $pregunta->usuario = $request->usuario;
                // Introduzco la pregunta
                $pregunta->pregunta = $request->pregunta;
                // Introduzco el tema
                $pregunta->tema = $request->tema;
                  
                // Compruebo si hay un usuario activo
                if (Auth::check())
                {
                    // Introduzco el usuario que ha realizado la pregunta
                    $pregunta->by_usuario = Auth::user()->name;
                }
        
                // Guardo los datos y se insertan la tabla de preguntas.
                $pregunta->save();
        
                // Redirijo al home con el mensaje de que se ha enviado la pregunta
                return redirect('home')->with('success', '¡Has enviado tu pregunta!');
            }
            else
            {
                // Redirijo al home con el mensaje de que no existe ese usuario
                return redirect('home')->with('error', 'No existe ese usuario');
            }
        }
        else
        {
            // Redirijo al home con el mensaje de que se debe elegir un tema
            return redirect('home')->with('error', '¡Debes elegir un tema!');
        }
        

    }

    /* Defino el método para eliminar pregunta */

    public function eliminarPregunta($id_pregunta) { // Recojo el id de la pregunta que se envia desde la vista

        // Elimino de la base de datos la pregunta que coincide con el id
        preguntas::find($id_pregunta)->delete();

        // Redirijo al perfil con el mensaje de que se ha eliminado la pregunta
        return redirect('perfil')->with('eliminada', '¡Has eliminado la pregunta!');

    }

    /* Defino el método para dar me gusta/no me gusta a la pregunta */

    public function actuarPregunta(Request $request, $id)
    {
        $action = $request->get('action');
        switch ($action) {
            case 'Like':
                preguntas::where('id', $id)->increment('likes');
                break;
            case 'Unlike':
                preguntas::where('id', $id)->decrement('likes');
                break;
        }
        return '';
    }

    /* Defino el método para el contacto */

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
        return redirect('contacto')->with('success', 'Gracias! Has enviado tu consulta, pronto nos pondremos en contacto contigo via email.');

    }


}
