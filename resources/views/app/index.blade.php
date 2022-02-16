@extends('layouts.app')

@section('content')

    <h3>Inicio</h3>
    <div class="row">

        @foreach ($rowset as $row)

            <article class="col m6 l3">
                <div class="card horizontal small">
                    @foreach ($imagenJoin as $img)
                    <div class="card-image">
                        {{ Html::image('img/'.$img->imagen, $img->titulo) }}
                    </div>
                    @endforeach
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
