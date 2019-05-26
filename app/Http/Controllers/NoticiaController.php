<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NoticiaRequest;
use App\Noticia;
use App\ImagenNoticia;
use App\ArchivoNoticia;
use App\VideoNoticia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administrador_id = Auth::user()->administrador->id; 
        $noticias = Noticia::where('administrador_id', $administrador_id)->get();
        return view('admin.noticia');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.noticia_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticiaRequest $request)
    {
        $noticia = new Noticia;
        $noticia->nombre = $request->nombre;
        $noticia->descripcion = $request->descripcion;
        $administrador_id = Auth::user()->administrador->id;
        $noticia->administrador_id = $administrador_id;
        $noticia->save();

        foreach($request->archivos as $archivo) {
            $path = $archivo->move('uploads/', $archivo->hashName());
            ArchivoNoticia::create([
                'nombre' => $archivo->getClientOriginalName(),
                'ruta' => $path,
                'noticia_id' => $noticia->id
            ]);
        }
        
        foreach($request->imagenes as $imagen) {
            $path = $imagen->move('uploads/', $imagen->hashName());
            ImagenNoticia::create([
                'nombre' => $imagen->getClientOriginalName(),
                'ruta' => $path,
                'noticia_id' => $noticia->id
            ]);
        }

        foreach($request->videos as $video) {
            VideoNoticia::create([
                'url' => $video,
                'noticia_id' => $noticia->id
            ]);
        }

        $mensaje = 'Notica ' . $noticia->nombre . ' creada con exito';
        return redirect()->route('admin.noticia.create')->with('success', $mensaje);
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
    public function update(Request $request, $id)
    {
        //
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
}
