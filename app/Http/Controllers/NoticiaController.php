<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NoticiaRequest;
use App\ImagenNoticia;
use App\ArchivoNoticia;
use App\VideoNoticia;
use App\Noticia;
use App\Interes;

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
        $noticias = Noticia::where('administrador_id', $administrador_id)->paginate(8);
        return view('admin.noticias_list')->with('noticias', $noticias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $intereses = Interes::all();
        return view('admin.noticia_create')->with('intereses', $intereses);
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

        if ($request->has('archivos')) {
            foreach($request->archivos as $archivo) {
                $path = $archivo->move('uploads/', $archivo->hashName());
                ArchivoNoticia::create([
                    'nombre' => $archivo->getClientOriginalName(),
                    'ruta' => $path,
                    'noticia_id' => $noticia->id
                ]);
            }
        }
        
        if ($request->has('imagenes')) {
            foreach($request->imagenes as $imagen) {
                $path = $imagen->move('uploads/', $imagen->hashName());
                ImagenNoticia::create([
                    'nombre' => $imagen->getClientOriginalName(),
                    'ruta' => $path,
                    'noticia_id' => $noticia->id
                ]);
            }
        }

        foreach($request->videos as $video) {
            if ($video != null) {
                $url = explode('=', $video);
                try {
                    VideoNoticia::create([
                        'url' => $url[1],
                        'noticia_id' => $noticia->id
                    ]);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }

        if ($request->has('intereses')) {
            foreach($request->intereses as $interes) {
                $noticia->intereses()->attach($interes);
            }
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
        $noticia = Noticia::find($id);
        $interes = Interes::all();
        return view('admin.noticia_edit')->with('noticia', $noticia)->with('intereses', $interes);
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
        $noticia = Noticia::find($id);
        $noticia->nombre = $request->nombre;
        $noticia->descripcion = $request->descripcion;
        $noticia->save();

        // borra los archivos existentes
        if ($request->has('archivos_borrar')) {
            foreach($request->archivos_borrar as $archivo_id) {
                $archivo = ArchivoNoticia::find($archivo_id);
                File::delete($archivo->ruta);
                $archivo->delete();
            }
        }

        // borra imagenes existentes
        if ($request->has('imagenes_borrar')) {
            foreach($request->imagenes_borrar as $imagen_id) {
                $imagen = ImagenNoticia::find($imagen_id);
                File::delete($imagen->ruta);
                $imagen->delete();
            }
        }

        // borra videos existentes
        if ($request->has('videos_borrar')) {
            foreach($request->videos_borrar as $video_id) {
                $video = VideoNoticia::find($video_id);
                $video->delete();
            }
        }

        // agrega nuevos archivos
        if ($request->has('archivos')) {
            foreach($request->archivos as $archivo) {
                $path = $archivo->move('uploads/', $archivo->hashName());
                ArchivoNoticia::create([
                    'nombre' => $archivo->getClientOriginalName(),
                    'ruta' => $path,
                    'noticia_id' => $noticia->id
                ]);
            }
        }

        // agrega nuevas imagenes
        if ($request->has('imagenes')) {
            foreach($request->imagenes as $imagen) {
                $path = $imagen->move('uploads/', $imagen->hashName());
                ImagenNoticia::create([
                    'nombre' => $imagen->getClientOriginalName(),
                    'ruta' => $path,
                    'noticia_id' => $noticia->id
                ]);
            }
        }

        // agrega nuevos videos
        foreach($request->videos as $video) {
            if ($video != null) {
                $url = explode('=', $video);
                try {
                    VideoNoticia::create([
                        'url' => $url[1],
                        'noticia_id' => $noticia->id
                    ]);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }

        // borra y agrega los nuevos intereses
        if ($request->has('intereses')) {
            $noticia->intereses()->detach();
            foreach($request->intereses as $interes) {
                $noticia->intereses()->attach($interes);
            }
        }

        $mensaje = 'La noticia ' . $noticia->nombre . ' ha sido editada con exito';
        return redirect()->route('admin.noticia.edit', $noticia->id)->with('info', $mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia = Noticia::find($id);
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

        // borra intereses
        $noticia->intereses()->detach();

        $message = "Noticia " . $noticia->nombre . " borrada con exito";
        $noticia->delete();


        return redirect()->route('admin.noticias')->with('info', $message);
        
    }
}
