@extends('layout')

@section('title', 'Notificaciones')

@section('content')
<div class="background-image" style="background-image: url('{{ asset('img/not3.png') }}');">
    <div class="container mt-5">
        <h2 class="text-center text-uppercase text-warning mb-4">Notificaciones de Adopción</h2>

        <!-- Mensajes de error y éxito -->
        @if (session('danger'))
            <x-alert type="danger" message="{{ session('danger') }}" />
        @endif
        @if (session('success'))
            <x-alert type="success" message="{{ session('success') }}" />
        @endif

        @if($notifications->isEmpty())
            <div class="alert alert-info text-center shadow-sm">No tienes notificaciones pendientes.</div>
        @else
            <div id="notificationsContainer">
                @foreach($notifications as $notification)
                    <div class="card mb-4 notification border-0 shadow-sm" style="background-color: rgba(255, 255, 255, 0.75);"
                         data-fecha="{{ \Carbon\Carbon::parse($notification->created_at)->format('Y-m-d') }}">
                        <div class="card-body text-center p-4">
                            <h5 class="card-title text-uppercase font-weight-bold text-dark mb-2">Solicitud de adopción para: 
                                <span class="text-primary"><strong>{{ $notification->kitten->nombre }}</strong></span>
                            </h5>
                            <h6 class="card-subtitle text-success mb-3"><strong>Refugio: {{ $notification->kitten->shelter->nombre }}</strong></h6>

                            <!-- Mostrar imagen del gato -->
                            <div class="mb-3">
                                @if ($notification->kitten->foto)
                                    <img src="{{ asset('storage/kittens/' . $notification->kitten->foto) }}" alt="{{ $notification->kitten->nombre }}" class="img-fluid rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('img/icono_mishi.png') }}" alt="Foto por defecto" class="img-fluid rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                                @endif
                            </div>

                            <p class="card-text">
                                <strong>Usuario quién solicita adoptar:   <span class="text-danger"> {{ $notification->usuarioSolicitante->name }}</strong><br>
                                <strong>Características del Mishi</strong> <br>
                                <strong>Raza:</strong> {{ $notification->kitten->raza }}<br>
                                <strong>Edad:</strong> {{ $notification->kitten->edad }} años<br>
                                <strong>Color:</strong> {{ $notification->kitten->color }}<br>
                                <strong>Sexo:</strong> {{ $notification->kitten->sexo }}<br>
                                <strong>Detalles especiales:</strong> {{ $notification->kitten->detalles ?? 'Sin detalles' }}<br>
                                <strong>Fecha de Notificación:</strong> {{ \Carbon\Carbon::parse($notification->created_at)->translatedFormat('d \d\e F \d\e Y') }}<br>
                            </p>
                            
                            <!-- Botones de acción -->
                            <div class="mt-3">
                                <!-- Formulario para aceptar la adopción -->
                                <form action="{{ route('notifications.accept', $notification->kitten) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="ubicacion_refugio" value="{{ $notification->kitten->shelter->ubicacion }}">
                                    <button type="submit" class="btn btn-success btn-sm px-4">
                                        <i class="fas fa-check-circle"></i> Aceptar
                                    </button>
                                </form>

                                <!-- Botón de rechazar -->
                                <form action="{{ route('notifications.reject', $notification->kitten) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm px-4">
                                        <i class="fas fa-times-circle"></i> Rechazar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
