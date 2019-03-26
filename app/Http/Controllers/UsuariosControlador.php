<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use App\preguntas;
use App\usuario_pregunta_like;
use App\contacto;
use App\temas;
use Auth;
use Hash;

class UsuariosControlador extends Controller
{

    /* -- Defino el método para la vista del contacto -- */
    public function getContacto()
    {
        return view('contacto');
    }

    /* -- Defino el método para el envio del contacto -- */

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

    /* -- Defino el metodo para la funcionalidad de buscar -- */

    public function buscar(Request $request) {

        // La busqueda contempla que pueda ser de usuarios o temas
        // por tanto primero hay que saber donde hay que buscar

        // Recojo el termino que el usuario introdujo
        $termino = $request->buscador;
        
        $usuarios = User::where('name', 'LIKE', '%'.$termino.'%')->get();

        $temas = temas::where('tema', 'LIKE', '%'.$termino.'%')->get();

        if ($usuarios->isNotEmpty())
        {
            return view('usuarios.busqueda-usuarios', ['usuarios' => $usuarios]);
        }
        elseif ($temas->isNotEmpty())
        {
            return view('usuarios.busqueda-temas', ['temas' => $temas]);
        }
        else
        {
            return back()->with('error-busqueda', 'Lo sentimos, no encontramos ningun resultado con su búsqueda');
        }

    }

    /* -- Defino el metodo para mostrar el perfil público -- */
    
    public function getPerfilPublico($nombre) {

        // Selecciono las preguntas que se han enviado al usuario con estos criterios ...
        $preguntas = preguntas::orderBy('created_at', 'desc') // de forma descendente, las mas nuevas primero
        ->where('usuario', $nombre) // solo las que son para ese usuario
        ->get(); // recojo los datos

        // Selecciono los datos del usuario
        $usuario = User::where('name', $nombre)->first();

        // Las preguntas que ha dado like el usuario solo se envia si hay usuario activo
        if (Auth::check())
        {
            // Preguntas que ha dado like el usuario
            $preguntas_like = usuario_pregunta_like::where("id_usuario", Auth::user()->id)->get();

            return view("usuarios.perfil-publico", ["usuario" => $usuario, "preguntas" => $preguntas, "preguntas_like" => $preguntas_like]);
        }
        else
        {
            return view("usuarios.perfil-publico", ["usuario" => $usuario, "preguntas" => $preguntas]);
        }
        
    }

    /* -- Defino el método para mostrar preguntas sobre un tema -- */



    /* -- Defino el metodo para mostrar el perfil -- */

    public function getPerfil() 
    {
        // Selecciono las preguntas que se han enviado al usuario con estos criterios ...
        $preguntas_a_ti = preguntas::orderBy('created_at', 'desc') // de forma descendente, las mas nuevas primero
            ->where('usuario', Auth::user()->name) // solo las que son para ese usuario
            ->where('respuesta', 0) // que no hayan sido respondidas
            ->take(2) // solo las 2 primeras
            ->get(); // recojo los datos

        // Selecciono las preguntas que ha enviado el usuario con estos criterios ...
        $preguntas_por_ti = preguntas::orderBy('created_at', 'desc') // de forma descendente, las mas nuevas primero
            ->where('by_usuario', Auth::user()->name) // solo las que son enviadas por ese usuario
            ->take(2) // solo las 2 primeras
            ->get(); // recojo los datos

        // Preguntas que ha dado like el usuario
        $preguntas_like = usuario_pregunta_like::where("id_usuario", Auth::user()->id)->get();

        // y los envio a la vista del perfil con un objeto llamado preguntas_a_ti y preguntas_por_ti
        return view("usuarios.perfil",  ["preguntas_a_ti" => $preguntas_a_ti, "preguntas_por_ti" => $preguntas_por_ti, "preguntas_like" => $preguntas_like]);
    }

    public function editPerfil() {
        return view('usuarios.editar-perfil');
    }
    
    /* -- Defino el método para editar el perfil -- */

    public function makeEdit(Request $request) { // Recojo los datos del formulario mediante Request

        // Dictamino todas las validaciones de los campos del formulario
        $request->validate([
            /*  
                El avatar tiene que ser una imagen, 
                con cualquier sufijo de los puestos y de máximo 2048 kb de tamaño,
                no es requerido.
            */
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // El usuario no es requerido, tiene que tener como máximo 255 carácteres.
            'usuario' => 'nullable|max:255', 
            // El mail no es requerido, tiene que ser de tipo mail y como máximo tiene que tener 255 carácteres.
            'email' => 'nullable|email|max:255',
            /*  
                La antigua clava es requerida, como minimo tiene que tener 6 carácteres 
                y como máximo tiene que ser de 255 carácteres.
            */
            'clave_actual' => 'required|min:6|max:255',
            /*
                La nueva clave no es requerida, como minimo tiene que tener 6 carácteres 
                y como máximo tiene que ser de 255 carácteres.
            */
            'nueva_clave' => 'nullable|min:6|max:255'
        ]);

        // Asigno el usuario actual a la variable $user
        $user = Auth::user();

        // Compruebo que haya introducido la clave actual y si es la misma que la del usuario, si no es así no se podrá actualizar el perfil
        if (Hash::check($request->input('clave_actual'), $user->password))
        {
            
            /* 
                Declaro la variable para saber si se ha actualizado algo, dependiendo del valor 
                se muestra un mensaje u otro.
            */
            $cambio = false;

            // Compruebo si el avatar no es nulo 
            if ($request->avatar != NULL)
            {
                // Creo el nombre del avatar que se alamacenara en la base de datos y en el servidor usando el id del usuario
                $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
                // Almaceno la imagen dela vatar del usuario en el servidor
                $request->avatar->storeAs('imagenes/usuarios', $avatarName);
                // Y inserto el nombre del archivo para luego acceder a el en la base de datos
                $user->avatar = $avatarName;
                // Cambio la variable de cambio a true
                $cambio = true;
            }

            // Compruebo si el usuario no es nulo 
            if ($request->usuario != NULL)
            {
                // Recojo el valor del nuevo usuario.
                $nuevoUsuario = $request->usuario;
                // Y lo inserto al usuario actual
                $user->name = $nuevoUsuario;
                // Cambio la variable de cambio a true
                $cambio = true;
            }

            // Compruebo si el email no es nulo 
            if ($request->email != NULL)
            {
                // Recojo el valor del nuevo email.
                $nuevoEmail = $request->email;
                // Y lo inserto al usuario actual
                $user->email = $nuevoEmail;
                // Cambio la variable de cambio a true
                $cambio = true;
            }

            // Compruebo si la nueva contraseña no es nula
            if ($request->nueva_clave != NULL)
            {
                // Recojo el dato de la nueva contraseña
                $nuevaClave = Hash::make($request->nueva_clave);
                // Y lo inserto al usuario actual
                $user->password = $nuevaClave;
                // Cambio la variable de cambio a true
                $cambio = true;
            }

            // Compruebo si se ha efectuado algun cambio
            if ($cambio)
            {
                // Guardo los datos y se insertan en la fila del usuario.
                $user->save();
                // Redirijo a la página del perfil con un mensaje de que se ha actualizado el perfil.
                return redirect('perfil')->with('success', 'Has actualizado tu perfil.');
            }
            else 
            {
                // Redirijo a la página del perfil con un mensaje de que no se ha actualizado nada en el perfil.
                return redirect('perfil')->with('warning', 'No se ha actualizado nada del perfil.');
            }
            
        }
        else
        {
            // Redirijo a la página del perfil con un mensaje de que las contraseñas no coinciden.
            return back()->with('error','La contraseña actual no coincide.');
        }

    }

    /* -- Defino el método para ver todas las preguntas del usuario -- */

    public function tusPreguntas() {

        // Selecciono las preguntas que se han enviado al usuario con estos criterios ...
        $preguntas_a_ti = preguntas::orderBy('created_at', 'desc') // de forma descendente, las mas nuevas primero
            ->where('usuario', Auth::user()->name) // solo las que son para ese usuario
            ->where('respuesta', 0) // que no hayan sido respondidas
            ->get(); // recojo los datos

        // envio los datos a la vista de tus-preguntas del usuario
        return view("usuarios.tus-preguntas",  ["preguntas_a_ti" => $preguntas_a_ti]);
    }

    /* -- Defino el método para ver todas las preguntas realizadas por el usuario -- */

    public function preguntasRealizadas() {
        
        // Selecciono las preguntas que ha enviado el usuario con estos criterios ...
        $preguntas_por_ti = preguntas::orderBy('created_at', 'desc') // de forma descendente, las mas nuevas primero
            ->where('by_usuario', Auth::user()->name) // solo las que son por ese usuario
            ->get(); // recojo los datos

        // Preguntas que ha dado like el usuario
        $preguntas_like = usuario_pregunta_like::where("id_usuario", Auth::user()->id)->get();

        // envio los datos a la vista de tus-preguntas-realizadas del usuario
        return view("usuarios.tus-preguntas-realizadas",  ["preguntas_por_ti" => $preguntas_por_ti, "preguntas_like" => $preguntas_like]);
    }



}
