@extends('layouts.app')

@section('title', 'Perfil del egresado')

@section('content')  

    @include('layouts.nav_egresado')

    <div class="navbar-egresado"></div>
    <h4 class="text-center">Noticias recientes</h4>

    <div class="container">
    @foreach($noticias as $noticia)
        <hr>
        <div class="row">
            <div class="col-12 text-center">
                <div class="bg-light pt-1 pb-1">
                    <h3 class="orange-color">{{ $noticia->nombre }}</h3>
                    <p class="text-center"> {{ $noticia->descripcion }} </p>
                </div>

                @if($noticia->archivos->count() > 0)
                <hr>
                <!-- Archivos de noticias -->
                <div class="row mt-4 rounded">
                    @foreach($noticia->archivos as $archivo)
                    <div class="col-lg-4 col-md-6 col-sm-8 border rounded-pill text-center p-2 mx-auto">
                        <a href="/{{ $archivo->ruta }}">{{ $archivo->nombre }}</a>
                    </div>
                    @endforeach
                </div>
                @endif

                @if($noticia->imagenes->count() > 0)
                <hr>
                <!-- Imagenes de noticias -->
                <div class="row mt-4 rounded">
                    @foreach($noticia->imagenes as $imagen)
                    <div class="col-lg-6 col-md-8 col-sm-12 mx-auto">
                        <img src="/{{ $imagen->ruta }}" alt="image" class="rounded mh-75 w-75">
                    </div>
                    @endforeach 
                </div>
                @endif

                @if($noticia->videos->count() > 0)
                <hr>
                <!-- Videos de noticias -->
                <div class="row mt-4 rounded">
                    @foreach($noticia->videos as $video)
                    <div class="col-lg-6 col-md-8 col-sm-12 mx-auto">
                        <iframe height="315" class="rounded mh-100 w-100" src="https://www.youtube.com/embed/{{$video->url}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    @endforeach

    <div class="row mt-5">
        <div class="text-center mx-auto">
            {{ $noticias->links() }}
        </div>

    </div>
</div>
    </div>

    

@endsection