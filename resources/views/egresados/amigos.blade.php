@extends('layouts.app')

@section('title', 'Perfil del egresado')

@section('content')  

    @include('layouts.nav_egresado')

    <div class="navbar-egresado"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h3>Tus amigos</h3>
                <hr>
                @foreach($amigos as $egresado)
                <div class="card" style="width: 18rem;">
                    <img src="/{{ $egresado->imagen }}" class="card-img-top" alt="profile-picture">
                    <div class="card-body">
                        <h5 class="font-weight-bold">{{ $egresado->user->name }}</h5>
                        <h6>{{ $egresado->apellidos }}</h6>
                        <p class="card-text">{{ $egresado->edad }} anios - {{ $egresado->pais->nombre }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection