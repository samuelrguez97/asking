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
    
    // Defino el método para editar el perfil
    public function makeEdit(Request $request) { // Recojo los datos del formulario mediante Request


        // Asigno el usuario actual a la variable $user
        $user = Auth::user();
        
        // Compruebo que haya introducido la clave actual y si es la misma que la del usuario, si no es así no se podrá actualizar el perfil
        if (Hash::check($request->input('antigua-clave'), $user->password))
        {
            // Dictamino todas las validaciones de los campos del formulario
            $request->validate([
                /*  
                    El avatar tiene que ser una imagen, 
                    con cualquier sufijo de los puestos y de máximo 2048 kb de tamaño,
                    no es requerido.
                */
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                // El usuario es requerido y como máximo tiene que ser 255 carácteres.
                'usuario' => 'required|max:255', 
                // El mail es requerido, tiene que ser de tipo mail y como máximo tiene que ser 255 carácteres.
                'email' => 'required|email|max:255',
                /*  
                    La antigua clava es requerida, como minimo tiene que tener 6 carácteres 
                    y como máximo tiene que ser 255 carácteres.
                */
                'antigua-clave' => 'required|min:6|max:255',
                /*
                    La nueva clave no es requerida, como minimo tiene que tener 6 carácteres 
                    y como máximo tiene que ser 255 carácteres.
                */
                'nueva-clave' => 'nullable|min:6|max:255', 
            ]);
            
            // Compruebo si el avatar no es nulo 
            if ($request->avatar != NULL)
            {
                // Creo el nombre del avatar que se alamacenara en la base de datos y en el servidor usando el id del usuario
                $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
                // Almaceno la imagen dela vatar del usuario en el servidor
                $request->avatar->storeAs('imagenes/usuarios', $avatarName);
                // Y inserto el nombre del archivo para luego acceder a el en la base de datos
                $user->avatar = $avatarName;
            }

            // Recojo el valor del nuevo usuario.
            $nuevoUsuario = $request->input('usuario');
            // Y lo inserto al usuario actual
            $user->name = $nuevoUsuario;

            // Recojo el valor del nuevo email.
            $nuevoEmail = $request->input('email');
            // Y lo inserto al usuario actual
            $user->email = $nuevoEmail;

            // Compruebo si la nueva contraseña no es nula
            if ($request->input('nueva-clave') != NULL)
            {
                // Recojo el dato de la nueva contraseña
                $nuevaClave = Hash::make($request->input('nueva-clave'));
                // Y lo inserto al usuario actual
                $user->password = $nuevaClave;
            }

            // Guardo los datos y se insertan en la fila del usuario.
            $user->save();

            // Redirijo a la página del perfil con un mensaje de que se ha actualizado el perfil
            return redirect('perfil')->with('success','Has actualizado tu perfil.');
            
        }
        else
        {
            return back()->with('error','La contraseña actual no coincide.');
        }

    }

}
