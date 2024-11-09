@extends('layout')

@section('title', 'Detalles del Evento')

@section('content')
<div class="container mt-5">
    <!-- Título del evento -->
    <h1 class="text-center text-primary mb-4">{{ $event->nombre }}</h1>

    <!-- Detalles del evento -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p class="fs-5"><strong>Fecha:</strong> {{ $event->fecha }}</p>
            <p class="fs-5"><strong>Descripción:</strong> {{ $event->descripcion }}</p>
        </div>
    </div>

    <!-- Refugios asociados -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h3 class="text-secondary">Refugios Asociados</h3>
            <ul class="list-group">
                @foreach($event->shelters as $shelter)
                    <li class="list-group-item">
                        <strong>{{ $shelter->nombre }}</strong> - 
                        Ubicación: {{ $shelter->pivot->ubicacion }} - 
                        Participantes: {{ $shelter->pivot->participantes }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Botones con el mismo estilo que en las vistas anteriores -->
    <div class="mt-3 text-center">
        <!-- Botón Editar -->
        <a href="{{ route('events.edit', $event) }}" class="btn btn-lg btn-outline-warning w-50 mb-3">Editar</a>
        <!-- Botón Volver a la lista de eventos -->
        <a href="{{ route('events.index') }}" class="btn btn-lg btn-outline-secondary w-50 mb-3">Volver a la lista de eventos</a>
    </div>
</div>
@endsection
