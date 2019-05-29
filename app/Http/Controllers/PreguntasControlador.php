<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\preguntas;
use App\usuario_pregunta_like;
use App\temas;
use App\User;
use App\respuestas;


class PreguntasControlador extends Controller
{

    /* -- Defino el método para devolver el home o el index depenediendo de si hay usuario conectado -- */

    public function index() 
    {       
        if ( Auth::check() )
        {
            return redirect()->action('PreguntasControlador@principal');
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
        $preguntas = preguntas::orderBy('created_at', 'desc')->get();

        // Recojo todos los usuarios para coger su información de perfil
        $usuarios = User::all();

        if (Auth::check())
        {
            $preguntas_like = usuario_pregunta_like::where("id_usuario", Auth::user()->id)->get();
            // Devuelvo la vista del home con todos los datos adjuntados
            return view("home", ["temas" => $temas, "preguntas" => $preguntas, "usuarios" => $usuarios, "preguntas_like" => $preguntas_like]);
        }
        else
        {
            return view("home", ["temas" => $temas, "usuarios" => $usuarios,  "preguntas" => $preguntas]);
        }
        
        
    }

    /* -- Defino el metodo para ordenar las preguntas en el home por likes -- */

    public function ordenarLikesHome() {

        // Recojo todos los temas que hay
        $temas = temas::all();

        // Recojo las preguntas ordenadas por likes, las que más tienen primero
        $preguntas = preguntas::orderBy('likes', 'desc')->get();

        // Recojo todos los usuarios para coger su información de perfil
        $usuarios = User::all();

        if (Auth::check())
        {
            $preguntas_like = usuario_pregunta_like::where("id_usuario", Auth::user()->id)->get();
            // Devuelvo la vista del home con todos los datos adjuntados
            return view("home", ["temas" => $temas, "preguntas" => $preguntas, "usuarios" => $usuarios, "preguntas_like" => $preguntas_like])->with('orden', 'Preguntas con más likes');
        }
        else
        {
            return view("home", ["temas" => $temas, "preguntas" => $preguntas, "usuarios" => $usuarios])->with('orden', 'Preguntas con más likes');
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
                // Introduzco el id del usuario al que se le envia la pregunta
                $pregunta->id_usuario = $usuario->id;
                // Introduzco la pregunta
                $pregunta->pregunta = $request->pregunta;
                // Introduzco el tema
                $pregunta->tema = $request->tema;
                // Aumento el numero de preguntas de ese tema
                $tema = temas::where('tema', $pregunta->tema)->first();
                $tema->increment('nPreguntas', 1);
                $tema->save();
                  
                // Compruebo si hay un usuario activo
                if (Auth::check())
                {
                    // Introduzco el usuario que ha realizado la pregunta
                    $pregunta->by_usuario = Auth::user()->id;
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

    /* -- Defino el método para enviar una pregunta a un usuario ya definido -- */

    public function sendPreguntaUser($user) {
        return redirect('home');
    }

    /* -- Defino el método para eliminar pregunta -- */

    public function eliminarPregunta($id_pregunta) { // Recojo el id de la pregunta que se envia desde la vista

        // Compruebo si existe esa pregunta
        if (preguntas::where('id', $id_pregunta)->first()) {
            // Recojo la pregunta de la base de datos que coincide con el id
            $pregunta = preguntas::where('id', $id_pregunta)->first();
        } else {
            // Sino devuelvo al home con un error
            return redirect()->action('PreguntasControlador@principal')->with('error-busqueda', 'Lo sentimos, no encontramos ninguna pregunta con ese id.');
        }

        // Decremento el numero de preguntas sobre el tema en cuestión
        $tema = temas::where('tema', $pregunta->tema)->first();
        $tema->decrement('nPreguntas', 1);
        $tema->save();

        // Elimino la relacion de likes con la pregunta eliminada para liberacion de datos innecesarios del servidor
        $ids_collection = usuario_pregunta_like::where('id_pregunta', $id_pregunta)->get()->toArray();
        foreach ($ids_collection as $id) {
            usuario_pregunta_like::where('id', $id)->delete();
        }

        // Elimino de la base de datos la pregunta
        $pregunta->delete();

        // Redirijo al perfil con el mensaje de que se ha eliminado la pregunta
        return back()->with('eliminada', '¡Has eliminado la pregunta!');

    }

    /* -- Defino el método para enviar la respuesta -- */

    public function sendRespuesta(Request $request) { // Recojo el id de la pregunta que se envia desde la vista
        
        // Valido la respuesta recibida del formulario
        $request->validate([
            'respuesta' => 'required|max:140'
        ]);
        
        // Asigno el id de la pregunta a una variable
        $id_pregunta = $request->id_pregunta;

        // Asigno el id del usuario que la responde
        $id_user = Auth::user()->id;

        // Aumento el contador de respuestas del usuario
        $usuario = User::where('id', $id_user)->first();
        $usuario->increment('respuestas', 1);
        $usuario->save();

        // Creo el vínculo entre la pregunta y la respuesta en la tabla 'respuestas'
        $respuesta = new respuestas;
        $respuesta->id_pregunta = $id_pregunta;
        $respuesta->id_user = $id_user;
        $respuesta->respuesta = $request->respuesta;
        $respuesta->save();
        
        // Cambio el campo booleano de respuesta de las preguntas a true
        $pregunta = preguntas::where('id', $id_pregunta)->first();
        $pregunta->respuesta = true;
        $pregunta->save();
        
        // Vuelvo a la anterior página con el mensaje de que es ha enviado la respuesta
        return back()->with('respondida', '¡Se ha enviado la respuesta con éxito!');
    }

    /* -- Defino el método para ver la respuesta -- */

    public function verRespuesta($id_pregunta, Request $request) {
    // Recojo el id de la pregunta de la cual se visualizara la respuesta

        // Compruebo que sea una peticion ajax
        if ($request->ajax()) 
        {
            // Compruebo si existe esa pregunta
            if (preguntas::where('id', $id_pregunta)->first()) {
                // Recojo la pregunta de la base de datos que coincide con el id
                $pregunta = preguntas::where('id', $id_pregunta)->first();
            } else {
                // Sino devuelvo al home con un error
                return redirect()->action('PreguntasControlador@principal')->with('error-busqueda', 'Lo sentimos, no encontramos ninguna respuesta/pregunta asociada a esa pregunta.');
            }

            // Recojo el nombre del usuario al que se le hizo la pregunta
            $nombre = User::where('id', $pregunta->id_usuario)->first()->name;

            // Recojo el id del usuario al que se le hizo la pregunta
            $id = User::where('id', $pregunta->id_usuario)->first()->id;

            // Recojo los datos de la respuesta ha esa pregunta
            $respuesta = respuestas::where('id_pregunta', $id_pregunta)->first();

            // Recojo la imagen del usuario al que se le hizo la pregunta
            $imagen = User::where('id', $pregunta->id_usuario)->pluck('avatar');

            // Recojo cuando se creo la pregunta y lo formateo para visualización del usuario
            $tiempo = $pregunta->created_at->diffForHumans();
            
            // Creo csrf token para formulario de likes
            $token = csrf_token();

            // Dependiendo de si esta registrado o no envio un tipo de like o otro
            if (Auth::check()) {

                // Recojo las preguntas donde el usuario a dado like
                $preguntas_like = usuario_pregunta_like::where("id_usuario", Auth::user()->id)->get();
               
                // Compruebo si ha dado like a la pregunta 
                if ($preguntas_like->contains('id_pregunta', $pregunta->id)) {
                    // Si es asi devuelve el css del corazon en modo like
                    $clase_like = "color-like fas fa-heart fa-lg";
                } else {
                    // Sino devuelve el corazon en modo normal
                    $clase_like = "far fa-heart fa-lg";
                }

            } else {
                // Si no cumple devuelve el corazon en modo normal
                $clase_like = "far fa-heart fa-lg";
            }
            
            // Envio los datos en formato json
            return response()->json(['imagen' => $imagen, 'nombre' => $nombre, 'id' => $id, 'pregunta' => $pregunta, 'respuesta' => $respuesta, 'tiempo' => $tiempo, 'token' => $token, 'clase_like' => $clase_like]);
            
        }
    
    }

    /* -- Defino el método para los likes/dislikes -- */

    public function accionLike($id_pregunta, Request $request) { 
    // Recojo el id de la pregunta a la que se efectaura el like/dislike
        
        // Compruebo que sea una peticion ajax
        if ($request->ajax())
        {
            // Compruebo si existe esa pregunta
            if (!preguntas::where('id', $id_pregunta)->first()) {
                // Sino devuelvo al home con un error
                return redirect()->action('PreguntasControlador@principal')->with('error-busqueda', 'Lo sentimos, no encontramos ninguna pregunta con ese id.');
            }

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

    /* -- Defino la función para ver todos los temas -- */

    public function temasTodos() {

        // Recojo todos los temas
        $temas = temas::all();
        
        // Y los envio a la vista para mostrarlos
        return view('usuarios.busqueda-temas', ['temas' => $temas]);

    }

    /* -- Defino la función para mostrar las preguntas sobre un tema -- */

    public function preguntasTema($tema) {

        // Compruebo si existe ese tema
        if (!temas::where('tema', $tema)->first()) {
            // Sino devuelvo al home con un error
            return redirect()->action('PreguntasControlador@principal')->with('error-busqueda', 'Lo sentimos, no existe un tema con ese nombre.');
        }

        // Recojo de la base de datos las preguntas relacionadas con ese tema
        $preguntas = preguntas::orderBy('created_at', 'desc')->where('tema', $tema)->get();
        
        // Recojo todos los usuarios para coger su información de perfil
        $usuarios = User::all();

        // Si hay un usuario activo envio las preguntas a las que le dió like
        if (Auth::check())
        {
            $preguntas_like = usuario_pregunta_like::where("id_usuario", Auth::user()->id)->get();
            // Devuelvo la vista de preguntas tema con todos los datos adjuntados
            return view('preguntas-tema', ['tema' => $tema, 'preguntas' => $preguntas, 'usuarios' => $usuarios, 'preguntas_like' => $preguntas_like]);
        }
        // .. y si no hay usuario activo
        else
        {
            // Envio a la vista simplemente el tema y las preguntas asociadas a ese tema
            return view('preguntas-tema', ['tema' => $tema, 'preguntas' => $preguntas, 'usuarios' => $usuarios]);
        }
        
    }

}
