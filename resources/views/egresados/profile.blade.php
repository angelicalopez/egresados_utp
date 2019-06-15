@extends('layouts.app')

@section('title', 'Perfil del egresado')

@section('content')  

    @include('layouts.nav_egresado')
    <div class="navbar-egresado"></div>
    <div class="container vh-100 p-3">
        <div class="row p-20 h-50">
            <div class="col-12 d-inline-flex flex-row">
                <div class="align-self-center h-75 w-50">
                    <div class="mx-auto p-4 h-75 w-75">
                        @if($user->egresado->imagen)
                            <img class="img-thumbnail mx-auto @if($can_edit) edit-picture @endif" id="profile-picture" src="/{{ $user->egresado->imagen }}" alt="profile picture">
                        @else
                            <img class="img-thumbnail mx-auto @if($can_edit) edit-picture @endif" id="profile-picture" src="{{ asset('paper_img/male_avatar.png') }}" alt="profile picture">
                        @endif
                    </div>
                </div>
                <div class="align-self-center">
                    <div class="text-left">
                        <div><h2>{{ $user->name }} {{ $user->egresado->apellidos }}</h2></div>
                        <div><h4>{{ $user->egresado->pais->nombre }}</h4></div>
                        <div> {{ $user->egresado->edad }} anios</div>
                    </div>
                    @if($can_edit)
                    <h5 class="text-center mt-5">
                        <a class="p-2 bg-orange text-white rounded-pill" href="#">Actualizar perfil</a>   
                    </h5>
                    <h5 class="text-center mt-3">
                        <button id="btn-edit-picture" type="button" class="d-none" data-toggle="modal" data-target="#edit_picture_modal">Actualizar foto</button>
                    </h5>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="row p-20 h-50">
            <div class="col-6 d-flex flex-column justify-content-center p-2 text-white" id="profile-section-3">
                <h4 class="text-center orange-color">INTERESES</h4>
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
                @if($can_edit)
                <h5 class="text-center mt-2">
                    <a class="p-2 orange-color rounded-pill button-hover" href="#">Actualizar intereses</a>   
                </h5>
                @endif
            </div>
            <div class="col-6 d-flex flex-column justify-content-center">
                <h4 class="text-center orange-color">AMIGOS</h4>
            </div>
        </div>
        
    </div>
    <!-- Modal -->
    <div class="modal fade" id="edit_picture_modal" tabindex="-1" role="dialog" aria-labelledby="editPictureModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editPictureModal">Actualizar imagen de perfil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{ route('egresado.picture', $user->egresado->id) }}" enctype="multipart/form-data">
            <div class="modal-body">
                    @csrf
                    {{ method_field('put') }}
                    <h6 class="text-center orange-color">Subir imagen</h6>                        
                    <input name="imagen" type="file" class="form-control-file mb-1" accept="image/png, image/jpeg">
                    @if ($errors->has('imagen'))
                        <span class="help-block">
                                <strong>{{ $errors->first('imagen') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btn-confirm-delete">Confirmar</button>
            </div>
            </form>
        </div>
      </div>
    </div>  
@endsection

@section('scripts')
    <script src="{{ asset('js/egresados/editar_imagen.js') }}"></script>
@endsection