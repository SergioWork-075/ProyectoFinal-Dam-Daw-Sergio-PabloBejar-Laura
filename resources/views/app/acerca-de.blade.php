@extends('layouts.app')

@section('content')

    <h3>
        <a href="{{ route('home') }}" title="Inicio">Inicio</a> <span>| Acerca de</span>
    </h3>
    <div class="row">
        <i class="large material-icons">info_outline</i>
        <p>
            Esta página  forma del equipo de las clases de Dam y de Daw y esta relacionado con el universo de Pacman
        </p>
        <p>
            Está desarrollada en PHP con Programación orientada a Objetos, siguiendo el patrón Modelo Vista Controlador y
            utiliza MySQL para la persistencia de datos.Además el juego esta desarrollado en Unity y con el lenguaje de programación de C#
        </p>
    </div>
@endsection
