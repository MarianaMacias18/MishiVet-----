@extends('layout')

@section('title', 'Eventos')

@section('content')
<div class="background-video position-relative">
    <video class="position-fixed top-0 start-0 w-100 h-100 object-fit-cover" src="{{ asset('video/mishi_admin2.mp4') }}" muted loop autoplay></video>
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary"><strong>MIS PROXIMOS EVENTOS</strong></h1>
    <!-- Agregar Evento -->
    <div class="text-center mb-4">
        <a href="{{ route('events.create') }}" class="btn btn-lg btn-success">Crear Evento</a>
    </div>

    <!-- Mensaje de error -->
    @if (session('error'))
        <x-alert type="danger" message="{{ session('error') }}" />
    @endif

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif

    <!-- Aviso si no hay eventos -->
    @if ($events->isEmpty())
        <x-aviso-component 
            titulo="¡Bienvenido, {{ Auth::user()->name }}!" 
            mensaje="Esta será tu sección para poder crear tus eventos. ¡Crea tu primer evento y comienza a organizarlos!"
            botonTexto="Cerrar" 
        />
    @endif

    <!-- Carrusel de eventos -->
    @if (!$events->isEmpty())
        <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" id="carouselItems">
                @foreach (array_chunk($events->all(), 6) as $key => $chunk)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                        <div class="row">
                            @foreach ($chunk as $event)
                                <div class="col-md-4 mb-4 event-card" data-fecha="{{ \Carbon\Carbon::parse($event->fecha)->format('Y-m-d') }}">
                                    <div class="card shadow-lg h-100 border border-dark rounded" style="background-color: rgba(255, 255, 255, 0.75);">
                                        <a href="{{ route('events.show', $event) }}" class="text-decoration-none text-dark" style="display: block; height: 100%;">
                                            <div class="card-body bg-light bg-opacity-25" style="height: 100%; padding: 20px;">
                                                <h5 class="card-title text-success">
                                                    <strong>{{ $event->nombre }}</strong>
                                                </h5>
                                                <p class="event-date">
                                                    <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($event->fecha)->format('d/m/Y') }} 
                                                    <strong>Hora:</strong> {{ \Carbon\Carbon::parse($event->fecha)->format('H:i') }}
                                                </p>                                                       
                                                <p><strong>Refugios Asociados:</strong></p>
                                                <ul>
                                                    @foreach($event->shelters as $shelter)
                                                        <li>{{ $shelter->nombre }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </a>

                                        <!-- Botones de acción fuera del enlace para que no redirijan -->
                                        <div class="btn-group d-flex justify-content-around" role="group" aria-label="Acciones">
                                            <a href="{{ route('events.edit', $event) }}" class="btn btn-outline-warning w-100 mb-2 mb-md-0">Editar</a>
                                            <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar el evento {{ $event->nombre }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger w-100">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif
</div>
</div>
@endsection
