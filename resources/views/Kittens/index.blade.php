@extends('layout')

@section('title', 'Mishis')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">MIS MISHIS</h1>
    
    <!-- Crear Mishi -->
    <div class="text-center mb-4">
        <a href="{{ route('kittens.create') }}" class="btn btn-lg btn-success">Agregar Mishi</a>
    </div>

    <!-- Mensaje de error -->
    @if (session('error'))
        <x-alert type="danger" message="{{ session('error') }}" />
    @endif

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif

    <!-- Aviso si no hay mishis -->
    @if ($kittens->isEmpty())
        <x-aviso-component 
            titulo="¡Bienvenido, {{ Auth::user()->name }}!" 
            mensaje="¡Bienvenido a tu sección de mishis! Aún no tienes mishis creados. ¡Crea tu primer mishi y comienza a cuidarlos!"
            botonTexto="Cerrar" 
        />
    @endif

    <!-- Listado de mishis -->
    @if (!$kittens->isEmpty())
        <div class="row">
            @foreach($kittens as $kitten)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg h-100 border-dark rounded" style="margin: 10px; display: flex; flex-direction: column;">
                        <!-- Envolver toda la tarjeta con un enlace para ver detalles -->
                        <a href="{{ route('kittens.show', $kitten) }}" style="text-decoration: none; flex-grow: 1; color: inherit;">
                            <div class="text-center">
                                @if ($kitten->foto)
                                    <img src="{{ asset('storage/kittens/' . $kitten->foto) }}" alt="{{ $kitten->nombre }}" class="card-img-top rounded-3" style="width: 100%; height: 300px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('img/icono_mishi.png') }}" alt="Foto por defecto" class="card-img-top rounded-3" style="width: 100%; height: 300px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="card-body bg-light">
                                <h5 class="card-title text-dark">{{ $kitten->nombre }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Refugio: {{ $kitten->shelter->nombre ?? 'No asignado' }}</h6>
                                <p><strong>Raza:</strong> {{ $kitten->raza }}</p>
                                <p><strong>Edad en años:</strong> {{ $kitten->edad }}</p>
                                <p><strong>Sexo:</strong> {{ $kitten->sexo }}</p>
                                <p><strong>Color:</strong> {{ $kitten->color }}</p>
                                @if (!empty($kitten->detalles))
                                    <p><strong>Detalles:</strong> {{ $kitten->detalles }}</p>
                                @endif
                                <!-- Estado con color según valor -->
                                <p><strong>Estado:</strong> 
                                    @if ($kitten->estado == 'Libre')
                                        <span class="badge bg-success">{{ $kitten->estado }}</span>
                                    @elseif ($kitten->estado == 'Apartado')
                                        <span class="badge bg-warning">{{ $kitten->estado }}</span>
                                    @elseif ($kitten->estado == 'Adoptado')
                                        <span class="badge bg-info">{{ $kitten->estado }}</span>
                                    @else
                                        {{ $kitten->estado }}
                                    @endif
                                </p>
                            </div>
                        </a>

                        <!-- Botones abajo -->
                        <div class="btn-group d-flex justify-content-between mt-auto" role="group" aria-label="Acciones">
                            <a href="{{ route('kittens.edit', $kitten) }}" class="btn btn-outline-warning w-100 mb-2 mb-md-0">Editar</a>
                            <form action="{{ route('kittens.destroy', $kitten) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar a {{ $kitten->nombre }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
