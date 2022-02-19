@extends('layouts.admin')

@section('content')

    <h3>
        <a href="{{ route("admin") }}" title="Inicio">Inicio</a> <span>| </span>
        <a href="{{ url("admin/partidas") }}" title="Partidas">Partidas</a> <span>| </span>
        @if ($row->id)
            <span>Editar {{ $row->nombre }}</span>
        @else
            <span>Nueva Partida</span>
        @endif
    </h3>
    <div class="row">
        @php $accion = ($row->id) ? "actualizar/".$row->id : "guardar" @endphp
        <form class="col m12 l6" method="POST" enctype="multipart/form-data"
              action="{{ url("admin/partidas/".$accion) }}">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input id="usuario" type="text" name="usuario" value="{{ $row->usuario }}">
                    <label for="usuario">Usuario</label>
                </div>
                <div class="input-field col s12">
                    <input id="puntos" type="text" name="puntos" value="{{ $row->puntos }}">
                    <label for="puntos">Puntos</label>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <a href="{{ url("admin/partidas") }}" title="Volver">
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
