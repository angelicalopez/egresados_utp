@extends('layouts.app')

@section('title', 'Perfil del egresado')

@section('content')  

    @include('layouts.nav_egresado')
    <div class="navbar-egresado"></div>
    <div class="container-fluid vh-100">
        <div class="row h-50 p-2 shadow-sm">
            <div class="col-6 d-flex flex-column justify-content-center">
                <img class="img-thumbnail h-50 w-50 mx-auto" src="{{ asset('paper_img/male_avatar.png') }}" alt="profile picture">
                <h5 class="text-center mt-2">
                    <a class="p-2 orange-color button-hover" href="#">Actualizar perfil</a>   
                </h5>
            </div>
            <div class="col-6 d-flex flex-column justify-content-center" id="profile-section-2">
                <div class="text-center">
                    <div> {{ $user->name }} </div>
                    <div> {{ $user->egresado->apellidos }} </div>
                    <div> {{ $user->egresado->pais->nombre }} </div>
                    <div> {{ $user->egresado->edad }} anios</div>
                </div>
            </div>
        </div>
        <div class="row mh-50 p-2 shadow-sm">
            <div class="col-6 d-flex flex-column justify-content-center p-2 text-white" id="profile-section-3">
                <h5 class="text-center">INTERESES</h5>
                <div class="overflow-y p-4" id="">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center button-hover">
                            <a class="profile-section-3-link w-100" href="#">Cras justo odio</a>
                            <span class="badge badge-primary badge-pill">14</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center button-hover">
                            <a class="profile-section-3-link w-100" href="#">Cras justo odio</a>
                            <span class="badge badge-primary badge-pill">2</span>
                        </li>
                    </ul>
                </div>
                <h5 class="text-center mt-2">
                    <a class="p-2 orange-color button-hover" href="#">Actualizar intereses</a>   
                </h5>
            </div>
            <div class="col-6 d-flex flex-column justify-content-center"></div>
        </div>
    </div>
@endsection