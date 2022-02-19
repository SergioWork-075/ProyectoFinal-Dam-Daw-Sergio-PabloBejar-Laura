@extends('layouts.admin')
@section('content')
    <h3>
        <a href="{{ route("admin") }}" title="Inicio">Inicio</a> <span>| </span>
        <a href="{{ url("admin/usuarios") }}" title="Usuarios">Usuarios</a> <span>| </span>
    </h3>
    <div class="row">
        @php $accion = (Auth::user()->id) ? "personalizar/".Auth::user()->id : "guardar" @endphp
        <form class="col m12 l6" method="POST" enctype="multipart/form-data"
              action="{{ url("admin/usuarios/".$accion) }}">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input id="nombre" type="text" name="nombre" value="{{ Auth::user()->nombre }}">
                    <label for="nombre">Nombre</label>
                </div>
                @php $clase = (Auth::user()->id) ? "hide" : "" @endphp
                <div class="input-field col s12 {{ $clase }}" id="password">
                    <input id="password" type="password" name="password" value="">
                    <label for="password">Contraseña</label>
                </div>
                @if (Auth::user()->id)
                    <p>
                        <label for="cambiar_clave">
                            <input id="cambiar_clave" name="cambiar_clave" type="checkbox">
                            <span>Pulsa para cambiar la clave</span>
                        </label>
                    </p>
                @else
                    <input type="hidden" name="cambiar_clave" value="1">
                @endif
                <div class="col m3 l3 center-align">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Imagen</span>
                            <input type="file" name="imagen">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                    @if (Auth::user()->imagen)
                        {{ Html::image('img/'.Auth::user()->imagen, Auth::user()->titulo, ['class' => 'responsive-img']) }}
                    @endif
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <a href="{{ url("/index.php") }}" title="Volver">
                            <button class="btn waves-effect waves-light" type="button">Volver
                                <i class="material-icons right">replay</i>
                            </button>
                        </a>
                        <button class="btn waves-effect waves-light" type="submit" name="guardar">Guardar
                            <i class="material-icons right">save</i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection







