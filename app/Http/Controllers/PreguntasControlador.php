<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\preguntas;
use App\usuario_pregunta_like;
use App\temas;
use App\User;


class PreguntasControlador extends Controller
{

    /* -- Defino el método para devolver el home o el index depenediendo de si hay usuario conectado -- */

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

    /* -- Defino el método para devolver la página principal con los datos de las preguntas -- */

    public function principal()
    {
        // Recojo todos los temas que hay
        $temas = temas::all();
        // Recojo las preguntas ordenadas por fecha, las más recientes primero
        $preguntas_todas = preguntas::orderBy('created_at', 'desc')->get();
        if (Auth::check())
        {
            $preguntas_like = usuario_pregunta_like::where("id_usuario", Auth::user()->id)->get();
            // Devuelvo la vista del home con todos los datos adjuntados
            return view("home", ["temas" => $temas, "preguntas_todas" => $preguntas_todas, "preguntas_like" => $preguntas_like]);
        }
        else
        {
            return view("home", ["temas" => $temas, "preguntas_todas" => $preguntas_todas]);
        }
        
        
    }

    /* -- Defino el metodo para ordenar las preguntas en el home por likes -- */

    public function ordenarLikesHome() {

        // Recojo todos los temas que hay
        $temas = temas::all();
        // Recojo las preguntas ordenadas por likes, las que más tienen primero
        $preguntas_todas = preguntas::orderBy('likes', 'desc')->get();
        if (Auth::check())
        {
            $preguntas_like = usuario_pregunta_like::where("id_usuario", Auth::user()->id)->get();
            // Devuelvo la vista del home con todos los datos adjuntados
            return view("home", ["temas" => $temas, "preguntas_todas" => $preguntas_todas, "preguntas_like" => $preguntas_like])->with('orden', 'Preguntas con más likes');
        }
        else
        {
            return view("home", ["temas" => $temas, "preguntas_todas" => $preguntas_todas])->with('orden', 'Preguntas con más likes');
        }
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

    /* -- Defino el método para eliminar pregunta -- */

    public function eliminarPregunta($id_pregunta) { // Recojo el id de la pregunta que se envia desde la vista

        // Elimino de la base de datos la pregunta que coincide con el id
        preguntas::find($id_pregunta)->delete();

        // Redirijo al perfil con el mensaje de que se ha eliminado la pregunta
        return back()->with('eliminada', '¡Has eliminado la pregunta!');

    }

    /* -- Defino el método para los likes/dislikes -- */

    public function accionLike($id_pregunta, Request $request) { 
    // Recojo el id de la pregunta a la que se efectaura el like/dislike
        
        // Compruebo que sea una peticion ajax
        if ($request->ajax())
        {
            // Compruebo si hay un usuario activo, si no, no se puede dar like/dislike
            if (Auth::check())
            {
                // Recojo el id del usuario en activo
                $id_usuario = Auth::user()->id;

                // Recojo el like que haya dado el usuario a esa pregunta
                $like = usuario_pregunta_like::where('id_usuario', $id_usuario)->where('id_pregunta', $id_pregunta);

                // Compruebo si existe ya el like
                if (!$like->first())
                {
                    // Si no existe creo el vinculo en la tabla usuario_pregunta_like
                    $like_nuevo = new usuario_pregunta_like;
                    $like_nuevo->id_pregunta = $id_pregunta;
                    $like_nuevo->id_usuario = $id_usuario;
                    $like_nuevo->save();

                    // Y incremento en 1 los likes de la pregunta en la tabla de las preguntas
                    preguntas::find($id_pregunta)->increment('likes');

                    // Y devuelvo a la peticion ajax la accion que se ha efectuado
                    return 'like';
                }
                else
                {
                    // Si ya existe el like significa que la accion es un dislike
                    // por tanto elimino el like recojido anteriormente
                    $like->delete();

                    // Y resto 1 a los likes de la pregunta en la tabla preguntas
                    preguntas::find($id_pregunta)->decrement('likes');

                    // Y devuelvo a la peticion ajax la accion que se ha efectuado
                    return 'unlike';
                }
                
            }
        } 

    }

    /* -- Defino la función para mostrar las preguntas sobre un tema -- */

    public function preguntasTema($tema) {

        // Recojo de la base de datos las preguntas relacionadas con ese tema
        $preguntas = preguntas::orderBy('created_at', 'desc')->where('tema', $tema)->get();

        if (Auth::check())
        {
            $preguntas_like = usuario_pregunta_like::where("id_usuario", Auth::user()->id)->get();
            // Devuelvo la vista de preguntas tema con todos los datos adjuntados
            return view('preguntas-tema', ['tema' => $tema, 'preguntas' => $preguntas, 'preguntas_like' => $preguntas_like]);
        }
        else
        {
            // Lo envio a la vista junto a la colección de datos
            return view('preguntas-tema', ['tema' => $tema, 'preguntas' => $preguntas]);
        }
        
       

    }

}
