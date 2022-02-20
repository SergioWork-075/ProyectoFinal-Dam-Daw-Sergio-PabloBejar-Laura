@extends('layouts.admin')
@section('content')
    <h3>
        <a href="{{ route("admin") }}" title="Inicio">Inicio</a> <span>| partidas</span>
    </h3>
    <div class="row">
        <!--Nuevo-->
        <article class="col s12 l6">
            <div class="card horizontal admin">
                <div class="card-stacked">
                    <div class="card-content">
                        <i class="grey-text material-icons medium">image</i>
                        <h4 class="grey-text">
                            nueva partida
                        </h4><br><br>
                    </div>
                    <div class="card-action">
                        <a href="{{ url("admin/partidas/crear") }}" title="Añadir nueva partida">
                            <i class="material-icons">add_circle</i>
                        </a>
                    </div>
                </div>
            </div>
        </article>
        @foreach ($rowset as $row)
            <article class="col s12 l6">
                <div class="card horizontal  sticky-action admin">
                    <div class="card-stacked">
                        @if ($row->imagen)
                            <i>{{ Html::image('img/'.$row->imagen, $row->titulo) }}</i>
                        @endif
                        <div class="card-content">
                            @if (!$row->imagen)
                                <i>{{ Html::image('img/icon.png') }}</i>
                            @endif
                            <h4>
                                {{ $row->titulo }}
                            </h4>
                            <strong>Usuario:</strong> {{ $row->usuario }}<br>
                            <strong>Puntos:</strong> {{ $row->puntos }}<br>
                            <strong>tiempo:</strong> {{ $row->tiempo}}<br>
                            <strong>Fecha:</strong> {{ date("d/m/Y", strtotime($row->fecha)) }}
                        </div>
                        <div class="card-action">
                            <a href="{{ url("admin/partidas/editar/".$row->id) }}" title="Editar">
                                <i class="material-icons">edit</i>
                            </a>
                            @php
                                $title = ($row->activo == 1) ? "Desactivar" : "Activar";
                                $color = ($row->activo == 1) ? "green-text" : "red-text";
                                $icono = ($row->activo == 1) ? "mood" : "mood_bad";
                            @endphp
                            <a href="{{ url("admin/partidas/activar/".$row->id) }}" title="{{ $title }}">
                                <i class="{{ $color }} material-icons">{{ $icono }}</i>
                            </a>
                            <a href="#" class="activator" title="Borrar">
                                <i class="material-icons">delete</i>
                            </a>
                        </div>
                    </div>
                    <!--Confirmación de borrar-->
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Borrar partida<i class="material-icons right">close</i></span>
                        <p>
                            ¿Está seguro de que quiere borrar la partida<strong>{{ $row->titulo }}</strong>?<br>
                            Esta acción no se puede deshacer.
                        </p>
                        <a href="{{ url("admin/partidas/borrar/".$row->id) }}" title="Borrar">
                            <button class="btn waves-effect waves-light" type="button">Borrar
                                <i class="material-icons right">delete</i>
                            </button>
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endsection
