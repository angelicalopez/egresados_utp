@extends('layouts.app')

@section('title', 'Lista de egresados')

@section('content')  
<div class="wrapper">
    <div class="profile-background-admin"> 
        <div class="filter-black"></div>  
    </div>
    @include('layouts.nav_admin')
    <div class="profile-content section-nude">
        <div class="container">
            <div class="row owner mt-3">
                <div class="text-center mx-auto">
                    <div class="name">
                        <h4>Administrador<br/><small>Panel administrativo</small></h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center mx-auto">
                    <p>Aqui puedes ver la lista de noticias creadas por ti</p>
                    <br/>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-8 col-md-offset-3 text-left mx-auto m-2">
                    @foreach($noticias as $noticia)
                    <div class="card">
                        <div class="card-header text-white bg-orange">
                            <button class="btn align-self-end align-self-center text-white border" type="button" data-toggle="collapse" data-target="#multiCollapse1_{{ $noticia->id }}" aria-expanded="false" aria-controls="multiCollapse1_{{ $noticia->id }}">Archivos</button>
                            <button class="btn align-self-end align-self-center text-white border" type="button" data-toggle="collapse" data-target="#multiCollapse2_{{ $noticia->id }}" aria-expanded="false" aria-controls="multiCollapse2_{{ $noticia->id }}">Imagenes</button>
                            <button class="btn align-self-end align-self-center text-white border" type="button" data-toggle="collapse" data-target="#multiCollapse3_{{ $noticia->id }}" aria-expanded="false" aria-controls="multiCollapse3_{{ $noticia->id }}">Videos</button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $noticia->nombre }}</h5>
                            <p class="card-text">{{ $noticia->descripcion }}</p>
                            <div class="row">
                                <div class="col">
                                    <div class="collapse multi-collapse" id="multiCollapse1_{{ $noticia->id }}">
                                    <div class="card card-body">
                                        <div class="row">
                                            @foreach($noticia->archivos as $archivo)
                                            <div class="col-4 border m-1 justify-content">
                                                <a href="/{{ $archivo->ruta }}">{{ $archivo->nombre }}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="collapse multi-collapse" id="multiCollapse2_{{ $noticia->id }}">
                                    <div class="card card-body text-center">
                                        <div class="row">
                                            @foreach($noticia->imagenes as $imagen)
                                            <div class="col-4 m-1 border text-center">
                                                <img src="/{{ $imagen->ruta }}" alt="" class="rounded h-100 w-100">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="collapse multi-collapse" id="multiCollapse3_{{ $noticia->id }}">
                                    <div class="card card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    @endforeach
                </div>
            </div>

            <div class="row mt-5">
                <div class="text-enter mx-auto">
                    {{ $noticias->links() }}
                </div>

            </div>
        </div>
    </div> 
@endsection