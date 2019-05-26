<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rol;

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
            $url = 'admin.egresados';
        } else if ($user->rol->id == Rol::where('nombre','Egresado')->first()->id) {
            $url = 'egresados.index';
        }
        return redirect()->route($url);
    }
}
