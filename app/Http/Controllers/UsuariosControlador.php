<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use App\preguntas;
use App\usuario_pregunta_like;
use App\contacto;
use App\temas;
use App\respuestas;
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
        
        // Busco cualquier parecido del termino en la base de datos de los usuarios
        $usuarios = User::where('name', 'LIKE', '%'.$termino.'%')->get();

        // Lo mismo en la base de datos de los temas
        $temas = temas::where('tema', 'LIKE', '%'.$termino.'%')->get();

        // Si hay algun dato recogido de los usuarios .. 
        if ($usuarios->isNotEmpty())
        {
            // Devuelvo la vista de la busqueda de los usuarios encontrados
            return view('usuarios.busqueda-usuarios', ['usuarios' => $usuarios]);
        }
        elseif ($temas->isNotEmpty())
        {
            // Si se dio el caso de encontrar temas relacionados envio los temas parecidos al término
            return view('usuarios.busqueda-temas', ['temas' => $temas]);
        }
        else
        {
            // Y si no se da ningún caso devuelvo un error de que no hay datos similares al término en las bases de datos
            return redirect()->action('PreguntasControlador@principal')->with('error-busqueda', 'Lo sentimos, no encontramos ningun resultado con esa búsqueda.');
        }

    }

    /* -- Defino el metodo para la funcionalidad de buscar el usuario a la hora de enviar una pregunta -- */

    public function buscarUsuario(Request $request) {

        // Compruebo si es una llamada ajax
        if ($request->ajax()) {
            // Inicializo la variable respuesta
            $respuesta = "";
            // Recojo los usuarios que coinciden con la busqueda
            $usuarios = User::where('name', 'LIKE', '%'.$request->busqueda.'%')->get();
            // Si encuentra los usuarios entra
            if ($usuarios) {
                // Recorro la lista de usuarios
                foreach ($usuarios as $usuario) {
                    // Asigno la direccion del avatar
                    $avatar = url('storage/imagenes/usuarios').'/'.$usuario->avatar;
                    // Asigno las clases del avatar
                    $clase_imagen = 'mr-3 rounded min-img-perfil float-left';
                    // Junto las partes para crear el elemento de la imagen
                    $imagen = "<img src='".$avatar."' class='".$clase_imagen."'>";
                    // Asigno el nombre al elemento donde se mostrara
                    $nombre = "<h6 class='float-left'>".$usuario->name."</h6>";
                    // Y concateno todo para enviar la respuesta
                    $respuesta .= '<option value="'.$usuario->name.'" data-content="'.$imagen.$nombre.'" alt="avatar">'.$usuario->name.'</option>';
                }
                // Una vez concatenado todos los usuarios en la variable respuesta la devuelvo a la vista
                return Response($respuesta);
            }
        }
    }

    /* -- Defino el metodo para mostrar el perfil público -- */
    
    public function getPerfilPublico($nombre) {

        // Compruebo si el usuario existe
        if (User::where('name', $nombre)->first()) {
            // Si es asi recojo el id del usuario
            $id_usuario = User::where('name', $nombre)->first()->id;
        } else {
            // Sino redirijo al home con un error
            return redirect()->action('PreguntasControlador@principal')->with('error-busqueda', 'Lo sentimos, no encontramos ningun usuario con ese nombre.');
        }

        // Selecciono las preguntas que se han enviado al usuario con estos criterios ...
        $preguntas = preguntas::orderBy('created_at', 'desc') // de forma descendente, las mas nuevas primero
            ->where('id_usuario', $id_usuario) // solo las que son para ese usuario
            ->get(); // recojo los datos

        // Selecciono los datos del usuario
        $usuario = User::where('name', $nombre)->first();

        // Recojo todos los usuarios para coger su información de perfil
        $usuarios = User::all();

        // Las preguntas que ha dado like el usuario solo se envia si hay usuario activo
        if (Auth::check())
        {
            // Preguntas que ha dado like el usuario
            $preguntas_like = usuario_pregunta_like::where("id_usuario", Auth::user()->id)->get();
            
            // Devuelvo la vista con todos los datos recogidos
            return view("usuarios.perfil-publico", ["usuario" => $usuario, "usuarios" => $usuarios, "preguntas" => $preguntas, "preguntas_like" => $preguntas_like]);
        }
        else
        {
            // Si no hay usuario activo envio los datos del usuario y sus preguntas
            return view("usuarios.perfil-publico", ["usuario" => $usuario, "usuarios" => $usuarios, "preguntas" => $preguntas]);
        }
        
    }


    /* -- Defino el metodo para mostrar el perfil -- */

    public function getPerfil() 
    {
        // Selecciono las preguntas que ha enviado el usuario con estos criterios ...
        $preguntas_por_ti = preguntas::orderBy('created_at', 'desc') // de forma descendente, las mas nuevas primero
            ->where('by_usuario', Auth::user()->id) // solo las que son enviadas por ese usuario
            ->get(); // recojo los datos

        // Preguntas que ha dado like el usuario
        $preguntas_like = usuario_pregunta_like::where("id_usuario", Auth::user()->id)->get();

        // Recojo todos los usuarios para coger su información de perfil
        $usuarios = User::all();

        // y los envio a la vista del perfil con un objeto llamado preguntas_a_ti y preguntas_por_ti
        return view("usuarios.perfil",  ["preguntas_por_ti" => $preguntas_por_ti, "preguntas_like" => $preguntas_like, "usuarios" => $usuarios]);
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
                // Almaceno la imagen del avatar del usuario en el servidor
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
                return redirect('perfil')->with('danger', 'No se ha actualizado nada del perfil.');
            }
            
        }
        else
        {
            // Redirijo a la página del perfil con un mensaje de que las contraseñas no coinciden.
            return back()->with('error','La contraseña actual no coincide.');
        }

    }

    /* -- Defino el método para eliminar la cuenta del usuario -- */

    public function eliminarCuenta() {
        
        // Selecciono al usuario de la tabla usuarios
        $usuario = User::where('id', Auth::user()->id)->first();

        // Selecciono las preguntas asociadas a ese usuario
        $preguntas_usuario = preguntas::where('id_usuario', Auth::user()->id)->get()->toArray();

        // Selecciono las respuestas asociadas a ese usuario
        $respuestas_usuario = respuestas::where('id_user', Auth::user()->id)->get()->toArray();

        // Reocojo los likes asociados a ese usuario
        $usuario_pregunta_like = usuario_pregunta_like::where('id_usuario', Auth::user()->id)->get()->toArray();

        // Primero elimino los likes del usuario
        foreach ($usuario_pregunta_like as $id) {
            usuario_pregunta_like::where('id', $id)->delete();
        }

        // Luego elimino las respuestas asociadas al usuario
        foreach ($respuestas_usuario as $id) {
            respuestas::where('id', $id)->delete();
        }

        // Despues elimino las preguntas asociadas a ese usuario
        foreach ($preguntas_usuario as $id) {
            preguntas::where('id', $id)->delete();
        }

        // Deslogueo al usuario
        Auth::logout();

        // Y por último elimino el usuario
        $usuario->delete();

        // Y devuelvo a la vista del home con un mensaje de que la cuenta ha sido eliminada con exito
        return redirect()->action('PreguntasControlador@principal')->with('success-perfil', '¡Has eliminado la cuenta con éxito!');

    }

    /* -- Defino el método para ver todas las preguntas del usuario -- */

    public function tusPreguntas() {

        // Selecciono las preguntas que se han enviado al usuario con estos criterios ...
        $preguntas_a_ti = preguntas::orderBy('created_at', 'desc') // de forma descendente, las mas nuevas primero
            ->where('id_usuario', Auth::user()->id) // solo las que son para ese usuario
            ->where('respuesta', 0) // que no hayan sido respondidas
            ->get(); // recojo los datos

        // Preguntas que ha dado like el usuario
        $preguntas_like = usuario_pregunta_like::where("id_usuario", Auth::user()->id)->get();

        // envio los datos a la vista de tus-preguntas del usuario
        return view("usuarios.tus-preguntas",  ["preguntas_a_ti" => $preguntas_a_ti, "preguntas_like" => $preguntas_like]);
    }

    /* -- Defino el método para ver todas las preguntas del usuario ya respondidas -- */
    
    public function tusPreguntasRespondidas() {
        
        // Selecciono las preguntas que se han enviado al usuario con estos criterios ...
        $preguntas = preguntas::orderBy('created_at', 'desc') // de forma descendente, las mas nuevas primero
            ->where('id_usuario', Auth::user()->id) // solo las que son para ese usuario
            ->where('respuesta', 1) // que hayan sido respondidas
            ->get(); // recojo los datos

        // Preguntas que ha dado like el usuario
        $preguntas_like = usuario_pregunta_like::where("id_usuario", Auth::user()->id)->get();

        // Recojo todos los usuarios para coger su información de perfil
        $usuarios = User::all();

        // envio los datos a la vista de tus-preguntas-respondidas del usuario
        return view("usuarios.tus-preguntas-respondidas",  ["preguntas" => $preguntas, "usuarios" => $usuarios, "preguntas_like" => $preguntas_like]);

    }

    /* -- Defino el método para ver los usuarios con más preguntas respondidas en orden -- */

    public function usuariosMasRespondidas() {

        // Recojo la cantidad de preguntas respondidas de los usuarios ordenados de mayor a menor
        $respuestas = User::where('respuestas', '!=', 0)
            ->orderBy('respuestas', 'DESC')
            ->get();
        // Y lo devuelvo a la vista
        return view("usuarios.ver-mas-respondidas", ["usuarios" => $respuestas]);
      
    }



}
