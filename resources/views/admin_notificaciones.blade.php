@extends('layout')

@section('title', 'Notificaciones Admin')

@section('content')
<div class="background-image" style="background-image: url('{{ asset('img/not2.jpg') }}');">
<div class="container mt-1">
    <h2 class="text-center mb-5 text-uppercase text-warning">Notificaciones</h2>

    @if(session('success'))
        <div class="alert alert-success text-center font-weight-bold shadow-sm">{{ session('success') }}</div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger text-center font-weight-bold shadow-sm">{{ session('danger') }}</div>
    @endif

    @if($notificaciones->isEmpty())
        <div class="alert alert-info text-center shadow-sm">
            <strong>No hay notificaciones en este momento.</strong>
        </div>
    @else
        @foreach($notificaciones as $notificacion)
            <div class="notification mb-4 p-4 border rounded shadow-lg" style="background-color: rgba(255, 255, 255, 0.75);">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="text-dark">
                        <i class="fas fa-bell text-warning"></i>
                        Notificación de <strong class="{{ $notificacion->estado_notificacion === 'aceptada' ? 'text-success' : 'text-danger' }}">{{ $notificacion->estado_notificacion === 'aceptada' ? 'Aceptación' : 'Rechazo' }}</strong>
                    </h5>
                    <span class="badge {{ $notificacion->estado_notificacion === 'aceptada' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($notificacion->estado_notificacion) }}
                    </span>
                </div>
                
                <p><strong>Gato: <span class="text-primary">{{ $notificacion->kitten->nombre }}</span></p></strong> 
                <p><strong>Fecha de adopción:</strong> {{ $notificacion->fecha->format('d/m/Y H:i') }}</p>
                <p><strong>Ubicación de refugio:</strong> {{ $notificacion->kitten->shelter->direccion ?? 'Ubicación no disponible' }}</p>
                <p><strong>Contacto:</strong> {{ $notificacion->kitten->shelter->telefono ?? 'Teléfono no disponible' }}</p>
                
                <div class="text-center mt-3">
                    <form action="{{ route('notifications.destroy', $notificacion->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Eliminar Notificación
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
</div>
@endsection
