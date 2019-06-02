@extends('layouts.app')

@section('title', 'Crear noticia')

@section('content')  

<div class="wrapper">
    <div class="profile-background-admin"> 
        <div class="filter-black"></div>  
    </div>
    @include('layouts.nav_admin')
    <div class="profile-content section-nude mb-5">
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
                    <p>Aqui puedes agregar nuevas noticias al sistema</p>
                    <br/>
                </div>
            </div>
            <hr>
            @include('layouts.alerts')
            <div class="row mx-auto">
                <div class="col-10 mx-auto">
                    <form class="register-form" method="POST" action="{{ route('admin.noticia.store') }}" enctype="multipart/form-data">
                        @csrf

                        <label class="orange-color">Nombre</label>                        
                        <input name="nombre" required type="text" class="form-control border" placeholder="nombre">
                        @if ($errors->has('nombre'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                            <br>
                            <br>
                        @endif

                        <label class="orange-color mt-2">Descripcion</label>                        
                        <textarea name="descripcion" required id="" cols="30" class="form-control border"></textarea>
                        @if ($errors->has('descripcion'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('descripcion') }}</strong>
                            </span>
                            <br>
                        @endif
                        
                        <hr>

                        <div class="row">
                            <div class="col-4 border p-1" id="archivos">
                                <p class="text-center font-weight-bold">Agrega archivos a la notica</p>
                                @if ($errors->has('archivos.*'))
                                    <span class="help-block small">
                                            <strong>{{ $errors->first('archivos.*') }}</strong>
                                    </span>
                                    <br>
                                @endif
                                <a id="add-file" class="m-3" type=button><i class="fas fa-plus-circle fa-lg orange-color"></i></a>
                                
                                <input name="archivos[]" type="file" class="form-control-file mb-1" accept=".pdf, .docx" id="input-archivo">
                            </div>
                            <div class="col-4 border p-1" id="imagenes">
                                <p class="text-center font-weight-bold">Agrega imagenes a la notica</p>
                                @if ($errors->has('imagenes.*'))
                                    <span class="help-block small">
                                            <strong>{{ $errors->first('imagenes.*') }}</strong>
                                    </span>
                                    <br>
                                @endif
                                <a id="add-image" class="m-3" type=button><i class="fas fa-plus-circle fa-lg orange-color"></i></a>
                                
                                <input name="imagenes[]" type="file" class="form-control-file mb-1" accept="image/png, image/jpeg" id="input-imagen">
                            </div>
                            <div class="col-4 border p-1" id="videos">
                                <p class="text-center font-weight-bold">Agrega videos a la noticia</p>
                                @if ($errors->has('videos.*'))
                                    <span class="help-block small">
                                            <strong>{{ $errors->first('videos.*') }}</strong>
                                    </span>
                                    <br>
                                @endif
                                <a id="add-video" class="m-3" type=button><i class="fas fa-plus-circle fa-lg orange-color"></i></a>

                                <input name="videos[]" type="text" class="form-control border mb-1 shadow-sm" id="input-video">
                            </div>
                        </div>
                        
                        <br>

                        <button class="col-6 mx-auto btn btn-danger btn-block">Crear noticia</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 
@endsection

@section('scripts')
<script src="{{ asset('js/noticias/add-multimedia.js') }}">
</script>
@endsection