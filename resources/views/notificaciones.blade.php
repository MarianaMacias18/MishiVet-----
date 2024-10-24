@extends('layout')

@section('title', 'Notificaciones')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">Notificaciones de Adopción</h2>

        <!-- Mensajes de error y éxito -->
        @if (session('danger'))
            <x-alert type="danger" message="{{ session('danger') }}" />
        @endif
        @if (session('success'))
            <x-alert type="success" message="{{ session('success') }}" />
        @endif

        @if($notifications->isEmpty())
            <div class="alert alert-info text-center">No tienes notificaciones pendientes.</div>
        @else
            <div id="notificationsContainer">
                @foreach($notifications as $notification)
                    <div class="card mb-3 notification" data-date="{{ \Carbon\Carbon::parse($notification->created_at)->format('Y-m-d') }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">Solicitud de adopción para: {{ $notification->kitten->nombre }}</h5>
                            <h6 class="card-title">Salvaguardado en el refugio: {{ $notification->kitten->shelter->nombre }}</h6>

                            <!-- Mostrar imagen del gato -->
                            <div class="mb-3">
                                @if ($notification->kitten->foto) 
                                    <img src="{{ asset('storage/kittens/' . $notification->kitten->foto) }}" alt="{{ $notification->kitten->nombre }}" class="img-fluid" style="max-width: 150px; max-height: 150px; object-fit: cover; border-radius: 50%;">
                                @else
                                    <img src="{{ asset('img/icono_mishi.png') }}" alt="Foto por defecto" class="img-fluid" style="max-width: 150px; max-height: 150px; object-fit: cover; border-radius: 50%;">
                                @endif
                            </div>

                            <p class="card-text">
                                <strong>Usuario solicitante:</strong> {{ $notification->usuarioSolicitante->name }}<br>
                                <strong>Raza:</strong> {{ $notification->kitten->raza }}<br>
                                <strong>Edad:</strong> {{ $notification->kitten->edad }} años<br>
                                <strong>Color:</strong> {{ $notification->kitten->color }}<br>
                                <strong>Sexo:</strong> {{ $notification->kitten->sexo }}<br>
                                <strong>Detalles del Mishi:</strong> {{ $notification->kitten->detalles }}<br>
                                <strong>Fecha de Notificación:</strong> {{ \Carbon\Carbon::parse($notification->created_at)->translatedFormat('d \d\e F \d\e Y') }}<br>
                            </p>

                            <!-- Formulario para aceptar la adopción -->
                            <form action="{{ route('notifications.accept', $notification->kitten) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="ubicacion_refugio" value="{{ $notification->kitten->shelter->ubicacion }}">
                                <button type="submit" class="btn btn-success">Aceptar</button>
                            </form>

                            <!-- Botón de rechazar -->
                            <form action="{{ route('notifications.reject', $notification->kitten) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Rechazar</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
