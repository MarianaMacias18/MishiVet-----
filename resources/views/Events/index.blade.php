@extends('layout')

@section('title', 'Eventos')

@section('content')
<div class="container mt-5">
    <h1>Eventos</h1>
    <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Crear Evento</a>

    <!-- Mensaje de error -->
    @if (session('error'))
        <x-alert type="danger" message="{{ session('error') }}" />
    @endif

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif

    <!-- Comprobar si no hay eventos -->
    @if ($events->isEmpty())
        <x-aviso-component 
            titulo="¡Bienvenido, {{ Auth::user()->name }}!" 
            mensaje="Está será tú sección para poder crear tus eventos principales. ¡Crea tu primer evento y comienza a organizarlos!"
            botonTexto="Cerrar" 
        />
    @else
        <div class="row" id="eventList">
            @foreach ($events as $event)
                <div class="col-md-4 mb-4 event-card">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->nombre }}</h5>
                            <p class="event-date" data-fecha="{{ \Carbon\Carbon::parse($event->fecha)->format('Y-m-d H:i') }}">
                                <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($event->fecha)->format('d/m/Y') }} <strong>Hora:</strong> {{ \Carbon\Carbon::parse($event->fecha)->format('H:i') }}
                            </p>                                                       
                            <p><strong>Refugios Asociados:</strong></p>
                            <ul>
                                @foreach($event->shelters as $shelter)
                                    <li>{{ $shelter->nombre }}</li>
                                @endforeach
                            </ul>
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <a href="{{ route('events.show', $event) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('events.edit', $event) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar el evento {{ $event->nombre }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
