<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\EgresadoRequest;
use Illuminate\Http\Request;
use App\Amigo;
use App\Egresado;
use App\Interes;
use App\Noticia;
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
        $add_friend = false;
        if ($user->id == Auth::user()->id) {
            $can_edit = true;
        } else {
            $can_edit = false;
            // check if the egresado is not already a friend
            $guest_user = Auth::user();
            //dd($guest_user->egresado->amigos->pluck('id')->toArray());
            if (!in_array($user->egresado->id, $guest_user->egresado->amigos->pluck('id')->toArray())) {
                $add_friend = true;
            }
        }
        return view('egresados.profile')->with('user', $user)->with('can_edit', $can_edit)
            ->with('intereses', $intereses)->with('intereses_egresado', $intereses_egresado)
            ->with('add_friend', $add_friend);
    }

    /**
     * Show the form for editing the specified resource. Edit for Admin
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

    // Edit for egresado
    public function editEgresado($id)
    {
        $paises = Pais::all();
        $egresado = Egresado::find($id);
        return view('egresados.edit')->with('paises', $paises)->with('user', $egresado->user);
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
        $egresado = Egresado::find($id);

        if ($request->has('borrar_intereses')) {
             foreach($request->borrar_intereses as $interes) {
                $egresado->intereses()->detach($interes);
             }
        }

        if ($request->has('agregar_intereses')) {
            foreach ($request->agregar_intereses as $interes) { 
                 $egresado->intereses()->attach($interes);
            }
        }

        return redirect()->route('egresado.profile', $egresado->user->id);
    }

    public function updateEgresado(EgresadoRequest $request, $id)
    {
        $egresado = Egresado::find($id);
        $user = $egresado->user;
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null)
            $user->password = bcrypt($request->password);
        $user->save();

        $egresado->apellidos = $request->apellidos;
        $egresado->dni = $request->dni;
        $egresado->pais_id = $request->pais_id;
        if ($egresado->edad != null)
            $egresado->edad = $request->edad;
        $egresado->genero = $request->genero;
        $egresado->manejo_datos = $request->manejo_datos;
        $egresado->save();

        $mensaje = "Datos actualizados con exito";
        return redirect()->route('egresado.edit', $egresado->id)->with('info', $mensaje);
    }

    // Retorna la lista de noticias con paginacion
    public function noticias($interes = null)
    {
        $user = Auth::user();
        if ($interes == null) {
            $noticias = Noticia::orderBy('created_at', 'desc')->paginate(3);
        } else {
            $interes = Interes::where('nombre', $interes)->first();
            $noticias = $interes->noticias()->orderBy('created_at', 'desc')->paginate(3);
        }
        return view('egresados.noticias')->with('user', $user)->with('noticias', $noticias);
    }

    // Retorna la lista de amigos del egresado
    public function amigos($nombre = null)
    {
        $user = Auth::user();
        if ($nombre) {
            $amigos = $user->egresado->amigos()->where('nombre', '%like%', $nombre)->paginate(9);
        } else {
            $amigos = $user->egresado->amigos()->paginate(9);
        }
        $amigos_id = $amigos->pluck('id')->toArray();
        array_push($amigos_id, $user->egresado->id);
        
        $otros = Egresado::whereNotIn('id', $amigos_id)->limit(6)->get();
        
        return view('egresados.amigos')->with('user', $user)->with('amigos', $amigos)
            ->with('otros', $otros);
    }

    // add a new friend with inverse relationship
    public function addfriend(Request $request)
    {
        $user = Auth::user();
        $egresado = Egresado::find($request->egresado_id);
        $user->egresado->amigos()->attach($egresado->id);
        $egresado->amigos()->attach($user->egresado->id);
        return redirect()->route('egresado.profile', $egresado->user->id);
    }

    // delete the relationship with one friend
    public function deletefriend(Request $request) {
        $user = Auth::user();
        $egresado = Egresado::find($request->egresado_id);
        $user->egresado->amigos()->detach($egresado->id);
        $egresado->amigos()->detach($user->egresado->id);
        return redirect()->route('egresado.profile', $egresado->user->id);
    }
}
