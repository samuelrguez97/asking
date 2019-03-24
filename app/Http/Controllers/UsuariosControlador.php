<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use Auth;
use Hash;

class UsuariosControlador extends Controller
{
    public function getPerfil() 
    {
        return view('usuarios.perfil');
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

}
