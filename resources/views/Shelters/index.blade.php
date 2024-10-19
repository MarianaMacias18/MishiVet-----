@extends('layout')

@section('title', 'Refugios')

@section('content')
<div class="container mt-5">
    <h1>Mis Refugios</h1>
    <a href="{{ route('shelters.create') }}" class="btn btn-primary mb-3">Agregar Refugio</a>

    <!-- Mensaje de error -->
    @if (session('error'))
        <x-alert type="danger" message="{{ session('error') }}" />
    @endif

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif
    
    <div class="row">
        @foreach ($shelters as $shelter)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="text-center">
                        @if ($shelter->foto)
                            <img src="{{ asset('storage/shelters/' . $shelter->foto) }}" alt="{{ $shelter->nombre }}" class="card-img-top" style="width: 100%; height: 300px; object-fit: cover;">
                        @else
                            <img src="{{ asset('img/icono_refugio.png') }}" alt="Foto por defecto" class="card-img-top" style="width: 100%; height: 300px; object-fit: cover;">
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-dark-blue">{{ $shelter->nombre }}</h5>
                        <p><strong>Dirección:</strong> {{ $shelter->direccion }}</p>
                        <p><strong>Teléfono:</strong> {{ $shelter->telefono }}</p>
                        <p><strong>Correo:</strong> {{ $shelter->correo }}</p>
                        <div class="btn-group" role="group" aria-label="Acciones">
                            <a href="{{ route('shelters.show', $shelter) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('shelters.edit', $shelter) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('shelters.destroy', $shelter) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar el refugio {{ $shelter->nombre }}?');">
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
</div>
@endsection
