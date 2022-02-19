@extends('layouts.app')

@section('content')

    <h3>Inicio</h3>
    <div class="row">
    <p>Clasificación de las mejores partidas</p>
        @foreach ($rowset as $row)
            <article class="col m6 l6">
                <div class="card horizontal small">
                    <div class="card-image">
                        @if (!$row->imagen)
                            {{ Html::image('img/icon.png') }}
                        @endif
                        @if ($row->imagen)
                            {{ Html::image('img/'.$row->imagen, $row->titulo) }}
                        @endif
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">

                            <h4>{{ $row->usuario  }}</h4>
                            <p>Puntuación: {{ $row->puntos  }}</p>
                            <p>Tiempo: {{ $row->tiempo  }}</p>
                        </div>
                        <div class="card-info">
                            <p>{{ date("d/m/Y", strtotime($row->fecha)) }}</p>
                        </div>
                    </div>
                </div>
            </article>
        @endforeach

    </div>

@endsection
