{{-- resources/views/Adoptions/adoption-history.blade.php --}}

@extends('layout')

@section('title', ' Adoption History ')

@section('content')
<div class="background-image" style="background-image: url('{{ asset('img/his1.jpg') }}');">
<div class="container mt-1">
    <h2 class="text-center mb-5 text-uppercase text-warning">Historial de Adopciones </h2>

    @if(session('success'))
        <div class="alert alert-success text-center font-weight-bold shadow-sm">{{ session('success') }}</div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger text-center font-weight-bold shadow-sm">{{ session('danger') }}</div>
    @endif

    @if($adoptions->isEmpty())
        <div class="alert alert-info text-center shadow-sm">
            <strong>No has adoptado a ningun mishi por el momento.</strong>
        </div>
    @else
        @foreach($adoptions as $adoption)
            <div class="notification mb-4 p-4 border rounded shadow-lg" style="background-color: rgba(255, 255, 255, 0.75);">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="text-dark">
                        <i class="fas fa-paw text-primary"></i>
                        Historial de Adopción de <strong><span class="text-danger"> {{ $adoption->user->name }}</strong>
                    </h5>
                </div>
                <p><strong>Fecha de Adopción:</strong> {{ $adoption->fecha_adopcion }}</p>
                <p><strong>Mishi:<span class="text-primary"> {{ $adoption->kitten->nombre }}</strong> </span></p>
                <p><strong>Nombre del Refugio:</strong> {{ $adoption->shelter->nombre}}</p>
                <p><strong>Ubicación de Refugio:</strong> {{ $adoption->shelter->direccion ?? 'Ubicación no disponible' }}</p>
                
                
            </div>
        @endforeach
        
    @endif
    
@endsection
