<?php

namespace App\Http\Controllers;
use App\User;
use App\Administrador;
use App\Pais;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RootController extends Controller
{
    // Retorna la lista de usuarios administradores
    public function administradores()
    {
        $admins = Administrador::paginate(8);
        return view('superuser.admin_list')->with('administradores', $admins);
    }

    // Retorna vista con formulario para crear administradores
    public function crearadmin() 
    {
        $paises = Pais::orderBy('nombre')->get();
        return view('superuser.admin_create')->with('paises', $paises);
    }

    // Retorna vista con datos de admin para editar
    public function editadmin($id)
    {
        $admin = Administrador::find($id);
        $paises = Pais::orderBy('nombre')->get();
        return view('superuser.admin_edit')->with('paises', $paises)->with('admin', $admin);
    }

    // login
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        $credentials['estado'] = 'A';
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            $message = "Usuario y/o contrasenia invalidos";
            return redirect()->route('login')->with('info', $message);
        }
        
    }
}
