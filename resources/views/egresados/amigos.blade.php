@extends('layouts.app')

@section('title', 'Perfil del egresado')

@section('content')  

    @include('layouts.nav_egresado')

    <div class="navbar-egresado"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 border-right">
                <span class="row">
                    <h2 class="col-6">Tus amigos</h2>                    
                </span>
                <hr>
                <div class="row">
                    @foreach($amigos as $egresado)
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="card orange-hover">
                            <a href="{{ route('egresado.profile', $egresado->user->id) }}"><img src="/{{ $egresado->imagen }}" class="card-img-top" alt="profile-picture"></a>
                            <div class="card-body">
                                <h5 class="font-weight-bold">{{ $egresado->user->name }}</h5>
                                <h6>{{ $egresado->apellidos }}</h6>
                                <p class="card-text">{{ $egresado->edad }} anios - {{ $egresado->pais->nombre }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach    
                </div>
                <div class="row mt-5">
                    <div class="text-enter mx-auto">
                        {{ $amigos->links() }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h3>Otros usuarios</h3>   
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        @foreach($otros as $egresado)
                        <figure class="figure">
                            <a href="{{ route('egresado.profile', $egresado->user->id) }}"><img src="/{{ $egresado->imagen }}" class="figure-img img-fluid rounded" alt="foto"></a>
                            <figcaption class="figure-caption">{{ $egresado->user->name }}  {{ $egresado->apellidos }}.</figcaption>
                        </figure>
                        @endforeach                 
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection