<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\EditAdminRequest;

use App\User;
use App\Administrador;
use App\Rol;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->rol_id = Rol::where('nombre', 'Administrador')->first()->id;
        $user->estado = 'A';
        $user->save();

        $admin = new Administrador;
        $admin->apellidos = $request->apellidos;
        $admin->dni = $request->dni;
        $admin->direccion = $request->direccion;
        $admin->telefono = $request->telefono;
        $admin->user_id = $user->id;
        $admin->pais_id = $request->pais_id;
        $admin->save();

        $mensaje = "Administrador " . $user->name . " " . $admin->apellidos . " creado con éxito";
        return redirect()->route('superuser.admin.crear')->with('success', $mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditAdminRequest $request, $id)
    {
        $admin = Administrador::find($id);
        $user = $admin->user;
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null)
            $user->password = bcrypt($request->password);
        $user->estado = $request->estado;
        $user->save();

        $admin->apellidos = $request->apellidos;
        $admin->dni = $request->dni;
        $admin->direccion = $request->direccion;
        $admin->telefono = $request->telefono;
        $admin->user_id = $user->id;
        $admin->pais_id = $request->pais_id;
        $admin->save();

        $mensaje = "Administrador " . $user->name . " " . $admin->apellidos . " actualizado con exito";
        return redirect()->route('superuser.admin.edit', $admin->id)->with('info', $mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $admin = Administrador::find($request->admin_id);
        $user = $admin->user;
        foreach($admin->noticias as $noticia) {
            // borra intereses
            $noticia->intereses()->detach();

            // borra los archivos existentes
            foreach($noticia->archivos as $archivo) {
                if (File::delete($archivo->ruta)) {
                    $archivo->delete();
                }
            }
            
            // borra imagenes existentes
            foreach($noticia->imagenes as $imagen) {
                if (File::delete($imagen->ruta)) {
                    $imagen->delete();
                }
            }

            // borra videos existentes
            foreach($noticia->videos as $video) {
                $video->delete();
            }

            $noticia->delete();
        }
        $name = $user->name . ' ' . $admin->apellidos;
        $admin->delete();
        $user->delete();
        $message = "El administrador " . $name . ' fue borrado exitosamente';
        return redirect()->route('superuser.admin')->with('success', $message);
    }
}
