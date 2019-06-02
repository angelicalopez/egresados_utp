<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rol;
use App\Http\Requests\PasswordRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->rol->id == Rol::where('nombre','Super usuario')->first()->id) {
            $url = 'superuser.admin';
        } else if ($user->rol->id == Rol::where('nombre','Administrador')->first()->id) {
            if ($user->cambiar_contrasena) {
                $url = 'changepasswordview';
            } else {
                $url = 'admin.egresados';
            }
        } else if ($user->rol->id == Rol::where('nombre','Egresado')->first()->id) {
            if ($user->cambiar_contrasena) {
                $url = 'changepasswordview';
            } else {
                $url = 'egresados.index';
            }
        }
        return redirect()->route($url);
    }

    public function changePasswordView()
    {
        return view('primer_login');
    }

    public function changePassword(PasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->cambiar_contrasena = false;
        $user->save();
        return redirect()->route('home');
    }
}
