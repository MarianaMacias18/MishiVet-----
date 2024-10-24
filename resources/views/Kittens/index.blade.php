@extends('layout')

@section('title', 'Mishis')

@section('content')
<div class="container mt-5">
    <h1>Mis Mishis</h1>
    <a href="{{ route('kittens.create') }}" class="btn btn-primary mb-3">Crear Mishi</a>
    
    <!-- Mensaje de error -->
    @if (session('error'))
        <x-alert type="danger" message="{{ session('error') }}" />
    @endif

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif

    @if ($kittens->isEmpty())
        <x-aviso-component 
            titulo="¡Bienvenido, {{ Auth::user()->name }}!" 
            mensaje="¡Bienvenido a tú sección de mishis! Aún no tienes mishis creados. ¡Crea tu primer mishi y comienza a cuidarlos!"
            botonTexto="Cerrar" 
        />
    @endif
    
    <!-- Listado de mishis -->
    @if (!$kittens->isEmpty())
        <div class="row">
            @foreach($kittens as $kitten)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="text-center">
                            @if ($kitten->foto)
                                <img src="{{ asset('storage/kittens/' . $kitten->foto) }}" alt="{{ $kitten->nombre }}" class="card-img-top" style="width: 100%; height: 300px; object-fit: cover;">
                            @else
                                <img src="{{ asset('img/icono_mishi.png') }}" alt="Foto por defecto" class="card-img-top" style="width: 100%; height: 300px; object-fit: cover;">
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $kitten->nombre }}</h5>
                            <h6 class="card-subtitle mb-2 text-dark-blue">Refugio: {{ $kitten->shelter->nombre ?? 'No asignado' }}</h6>
                            <p><strong>Raza:</strong> {{ $kitten->raza }}</p>
                            <p><strong>Edad en años:</strong> {{ $kitten->edad }}</p>
                            <p><strong>Sexo:</strong> {{ $kitten->sexo }}</p>
                            <p><strong>Color:</strong> {{ $kitten->color }}</p>
                            <p><strong>Detalles:</strong> {{ $kitten->detalles }}</p>
                            <p><strong>Estado:</strong> {{ $kitten->estado }}</p>
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <a href="{{ route('kittens.show', $kitten) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('kittens.edit', $kitten) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('kittens.destroy', $kitten) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar a {{ $kitten->nombre }}?');">
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
