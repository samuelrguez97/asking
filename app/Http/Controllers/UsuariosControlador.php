<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    /* COMENTAR TODO EL EDITAR PERFIL - FALTAN VALIDACIONES DE LOS DATOS */
    
    public function makeEdit(Request $request) {

        $user = Auth::user();
        
        if (Hash::check($request->input('antigua-clave'), $user->password))
        {
            
            $request->validate([
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'usuario' => 'required',
                'email' => 'required',
                'nueva-clave' => 'required',
            ]);
            
            $nuevoUsuario = $request->input('usuario');
            $nuevoEmail = $request->input('email');
            $nuevaClave = Hash::make($request->input('nueva-clave'));

            if ($request->avatar != NULL)
            {
                $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
                $request->avatar->storeAs('imagenes/usuarios', $avatarName);
                $user->avatar = $avatarName;
            }

            $user->name = $nuevoUsuario;
            $user->email = $nuevoEmail;
            $user->password = $nuevaClave;

            $user->save();

            return redirect('perfil')->with('success','Has actualizado tu perfil.');
            
        }
        else
        {
            return back()->with('error','La contraseña actual no coincide.');
        }

    }

}
