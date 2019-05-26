<?php

namespace App\Http\Controllers;
use App\User;
use App\Administrador;
use App\Pais;
use App\Http\Requests\AdminRequest;

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
}
