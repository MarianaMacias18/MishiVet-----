@extends('layout')

@section('title', 'Detalles del Evento')

@section('content')
<div class="container mt-5">
    <h1>{{ $event->nombre }}</h1>
    <p><strong>Fecha:</strong> {{ $event->fecha }}</p>
    <p><strong>Descripción:</strong> {{ $event->descripcion }}</p>
    
    <h3>Refugios Asociados</h3>
    <ul>
        @foreach($event->shelters as $shelter)
        <li>{{ $shelter->nombre }} - Ubicación: {{ $shelter->pivot->ubicacion }} - Participantes: {{ $shelter->pivot->participantes }}</li>
        @endforeach
    </ul>

    <a href="{{ route('events.edit', $event) }}" class="btn btn-warning">Editar</a>

    <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>

    <a href="{{ route('events.index') }}" class="btn btn-secondary">Volver a la lista de eventos</a>
</div>
@endsection
