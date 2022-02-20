@extends('layouts.app')

@section('content')

    <h3>
        <a href="{{ route('home') }}" title="Inicio">Inicio</a> <span>| </span>
        <a href="{{ route('partidas') }}" title="Partidas">Partidas</a> <span>| </span>
        <span>{{ $row->usuario }}</span>
    </h3>
    <div class="row">

        <article class="col s12">
            <div class="card horizontal large noticia">
                <div class="card-image">
                    @foreach ($imagenJoin as $row)
                        @if (!$row->imagen)
                            {{ Html::image('img/icon.png') }}
                        @endif
                        @if ($row->imagen)
                            {{ Html::image('img/'.$row->imagen, $row->titulo) }}
                        @endif
                    @endforeach
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <h4>{{ $row->usuario }}</h4>
                        <p>{{ $row->puntos }}</p>
                        <p>{!! $row->tiempo !!}</p>
                        <br>
                        <p>
                            <strong>Fecha</strong>: {{ date("d/m/Y", strtotime($row->fecha)) }}<br>
                            <strong>Autor</strong>: {{ $row->autor  }}
                        </p>
                    </div>
                </div>
            </div>
        </article>
    </div>
@endsection
