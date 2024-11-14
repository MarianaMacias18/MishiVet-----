{{-- resources/views/Adoptions/shelter-adoption-history.blade.php --}}

@extends('layout')

@section('title', 'Historial de Adopciones')

@section('content')
<div class="background-image" style="background-image: url('{{ asset('img/his4.jpg') }}');">
    <div class="container mt-1">
        <h2 class="text-center mb-5 text-uppercase text-warning">
            Historial de Adopciones @if($shelter) para {{ $shelter->nombre }} @endif
        </h2>

        <!-- Mensajes de éxito y error -->
        @if(session('success'))
            <div class="alert alert-success text-center font-weight-bold shadow-sm">{{ session('success') }}</div>
        @endif
        @if(session('danger'))
            <div class="alert alert-danger text-center font-weight-bold shadow-sm">{{ session('danger') }}</div>
        @endif

        <!-- Si no hay adopciones -->
        @if($adoptions->isEmpty())
            <div class="alert alert-info text-center shadow-sm">
                <strong>No hay adopciones registradas para el refugio actual.</strong>
            </div>
        @else
            <!-- Mostrar adopciones -->
            @foreach($adoptions as $adoption)
                <div class="notification mb-4 p-4 border rounded shadow-lg" style="background-color: rgba(255, 255, 255, 0.75);">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="text-success">
                            <i class="fas fa-paw text-dark"></i>
                            <strong>Historial de Adopción</strong>
                        </h5>
                    </div>

                    <p><strong>Fecha de Adopción:</strong> {{ $adoption->fecha_adopcion }}</p>
                    <p><strong>Mishi:</strong> <span class="text-primary"><strong>{{ $adoption->kitten->nombre }}</strong></span></p>
                    <p><strong>Usuario Adoptador: <span class="text-danger"> {{ $adoption->user->name }}</strong></p>

                    <!-- Mostrar detalles de refugio solo si el usuario es un refugio -->
                    @if($shelter)
                        <p><strong>Ubicación de Refugio:</strong> {{ $adoption->shelter->direccion ?? 'Ubicación no disponible' }}</p>
                        <p><strong>Contacto del Refugio:</strong> {{ $adoption->shelter->telefono ?? 'Teléfono no disponible' }}</p>
                    @endif
                </div>
            @endforeach
        @endif
    <!-- Botones -->
    <div class="mt-3 text-center">
        <!-- Botón Volver -->
        <a href="{{ route('shelters.index') }}" class="btn btn-lg btn-outline-primary w-50 mb-3">Volver</a>
    </div>
    </div>
</div>
@endsection
