@extends('layout')

@section('title', 'Notificaciones Admin')

@section('content')
<div class="container mt-5">
    <h2>Notificaciones</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger">{{ session('danger') }}</div>
    @endif

    @if($notificaciones->isEmpty())
        <div class="alert alert-info">No hay notificaciones en este momento.</div>
    @else
        @foreach($notificaciones as $notificacion)
            <div class="notification mb-3 p-3 border rounded">
                @if($notificacion->estado_notificacion === 'aceptada')
                    <p><strong>La solicitud de adopción del gato <span class="text-danger">{{ $notificacion->kitten->nombre }}</span> ha sido aceptada.</strong></p>
                @elseif($notificacion->estado_notificacion === 'rechazada')
                    <p><strong>La solicitud de adopción del gato <span class="text-danger">{{ $notificacion->kitten->nombre }}</span> ha sido rechazada.</strong></p>
                @endif
                <p><strong>Fecha de adopción:</strong> {{ $notificacion->fecha->format('d/m/Y H:i') }}</p>
                <p><strong>Ubicación de refugio:</strong> {{ $notificacion->kitten->shelter->direccion ?? 'Ubicación no disponible' }}</p>
                <p><strong>Contacto:</strong> {{ $notificacion->kitten->shelter->telefono ?? 'Teléfono no disponible' }}</p>
                <form action="{{ route('notifications.destroy', $notificacion->id) }}" method="POST">
                    @csrf
                    @method('DELETE') 
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </form>
            </div>
        @endforeach
    @endif
</div>
@endsection
