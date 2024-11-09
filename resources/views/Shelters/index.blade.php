@extends('layout')

@section('title', 'Refugios')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">MIS REFUGIOS</h1>
    
    <!-- Agregar Refugio -->
    <div class="text-center mb-4">
        <a href="{{ route('shelters.create') }}" class="btn btn-lg btn-success">Agregar Refugio</a>
    </div>

    <!-- Mensaje de error -->
    @if (session('error'))
        <x-alert type="danger" message="{{ session('error') }}" />
    @endif

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif

    <!-- Aviso si no hay refugios -->
    @if ($shelters->isEmpty())
        <x-aviso-component 
            titulo="¡Bienvenido, {{ Auth::user()->name }}!" 
            mensaje="Aquí podrás crear tus refugios para salvaguardar a tus mishis. ¡Entiendo y quiero comenzar!"
            botonTexto="Cerrar" 
        />
    @endif

    <!-- Listado de refugios -->
    @if (!$shelters->isEmpty())
        <div class="row">
            @foreach ($shelters as $shelter)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg h-100 border-dark rounded" style="margin: 10px; display: flex; flex-direction: column;">
                        <!-- Hacer que toda la tarjeta sea clickeable para ver los detalles del refugio -->
                        <a href="{{ route('shelters.show', $shelter) }}" style="text-decoration: none; flex-grow: 1; color: inherit;">
                            <div class="text-center">
                                @if ($shelter->foto)
                                    <img src="{{ asset('storage/shelters/' . $shelter->foto) }}" alt="{{ $shelter->nombre }}" class="card-img-top rounded-3" style="width: 100%; height: 300px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('img/icono_refugio.png') }}" alt="Foto por defecto" class="card-img-top rounded-3" style="width: 100%; height: 300px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="card-body bg-light">
                                <h5 class="card-title text-dark">{{ $shelter->nombre }}</h5>
                                <p><strong>Dirección:</strong> {{ $shelter->direccion }}</p>
                                <p><strong>Teléfono:</strong> {{ $shelter->telefono }}</p>
                                <p><strong>Correo:</strong> {{ $shelter->correo }}</p>
                            </div>
                        </a>
                        
                        <!-- Botones abajo (no serán afectados por el clic en la tarjeta) -->
                        <div class="btn-group d-flex justify-content-between mt-auto" role="group" aria-label="Acciones">
                            <!-- Botón de Editar -->
                            <a href="{{ route('shelters.edit', $shelter) }}" class="btn btn-outline-warning w-100 mb-2 mb-md-0" style="pointer-events: all;">Editar</a>
                            
                            <!-- Formulario de Eliminar -->
                            <form action="{{ route('shelters.destroy', $shelter) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar el refugio {{ $shelter->nombre }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100" style="pointer-events: all;">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
