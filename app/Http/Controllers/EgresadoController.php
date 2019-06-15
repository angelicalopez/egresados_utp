<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\EgresadoRequest;
use Illuminate\Http\Request;
use App\Egresado;
use App\Interes;
use App\Pais;
use App\Rol;
use App\User;

class EgresadoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $egresados = Egresado::paginate(8);
        return view('admin.egresado_list')->with('egresados', $egresados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Pais::all();
        return view('admin.egresado_create')->with('paises', $paises);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EgresadoRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->rol_id = Rol::where('nombre', 'Egresado')->first()->id;
        $user->estado = 'A';
        $user->save();

        $egresado = new Egresado;
        $egresado->apellidos = $request->apellidos;
        $egresado->dni = $request->dni;
        $egresado->user_id = $user->id;
        $egresado->pais_id = $request->pais_id;
        $egresado->edad = $request->edad;
        $egresado->manejo_datos = true;
        $egresado->genero = $request->genero;
        $egresado->save();

        $mensaje = "Egresado " . $user->name . " " . $egresado->apellidos . " creado con exito";
        return redirect()->route('admin.egresado.create')->with('success', $mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $intereses_egresado = $user->egresado->intereses;
        $filter = $intereses_egresado->pluck('id')->toArray();
        $intereses = Interes::whereNotIn('id', $filter)->get();
        if ($user->id == Auth::user()->id) {
            $can_edit = true;
        } else {
            $can_edit = false;
        }
        return view('egresados.profile')->with('user', $user)->with('can_edit', $can_edit)
            ->with('intereses', $intereses)->with('intereses_egresado', $intereses_egresado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paises = Pais::all();
        $egresado = Egresado::find($id);
        return view('admin.egresado_edit')->with('paises', $paises)->with('egresado', $egresado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EgresadoRequest $request, $id)
    {
        $egresado = Egresado::find($id);
        $user = $egresado->user;
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null)
            $user->password = bcrypt($request->password);
        $user->estado = $request->estado;
        $user->save();

        $egresado->apellidos = $request->apellidos;
        $egresado->dni = $request->dni;
        $egresado->pais_id = $request->pais_id;
        if ($egresado->edad != null)
            $egresado->edad = $request->edad;
        $egresado->genero = $request->genero;
        $egresado->save();

        $mensaje = "Egresado " . $user->name . " " . $egresado->apellidos . " editado con exito";
        return redirect()->route('admin.egresado.edit', $egresado->id)->with('info', $mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function editpicture(Request $request, $id) {
        $egresado = Egresado::find($id);
        if ($egresado->imagen != null) {
            File::delete($egresado->imagen);
        }
        $imagen = $request->file('imagen');
        $path = $imagen->move('uploads/perfil', $imagen->hashName());
        $egresado->imagen = $path;
        $egresado->save();
        return redirect()->route('egresado.profile', $egresado->user->id);
    }

    public function editIntereses(Request $request, $id) {
        dd($request->all());
    }
}
