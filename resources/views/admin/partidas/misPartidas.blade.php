@extends('layouts.admin')
@section('content')

    <h3>Inicio</h3>
    <div class="row">
        <p>Clasificación de las mejores partidas</p>
        @foreach ($rowset as $row)
            <article class="col m6 l6">
                <div class="card horizontal small" style="background-color: #ffffff">
                    <div class="card-image" style="margin-left: 2%;">
                        @if (!$row->imagen)
                            {{ Html::image('img/icon.png') }}
                        @endif
                        @if ($row->imagen)
                            {{ Html::image('img/'.$row->imagen, $row->titulo) }}
                        @endif
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">

                            <h3 style="color: #000000">{{ $row->usuario  }}</h3>
                            <h4 style="color: #ff9100">Puntuación: {{ $row->puntos  }}</h4>
                            <h4>Tiempo: {{ $row->tiempo  }}</h4>
                        </div>
                        <div class="card-info">
                            <p>{{ date("d/m/Y", strtotime($row->fecha)) }}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{ url('partida/'.$row->slug) }}">Más información</a>
                        </div>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endsection

