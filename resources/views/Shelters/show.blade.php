@extends('layout')

@section('title', 'Ver Refugio')

@section('content')
<div class="container mt-5">
    <h1>{{ $shelter->nombre }}</h1>
    <div class="text-center mb-3">
        @if ($shelter->foto)
            <img src="{{ asset('storage/shelters/' . $shelter->foto) }}" alt="{{ $shelter->nombre }}" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
        @else
            <img src="{{ asset('img/icono_refugio.png') }}" alt="Foto por defecto" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
        @endif
    </div>
    <p>Dirección: {{ $shelter->direccion }}</p>
    <p>Teléfono: {{ $shelter->telefono }}</p>
    <p>Correo: {{ $shelter->correo }}</p>
    <p>Descripción: {{ $shelter->descripcion }}</p>

    <a href="{{ route('shelters.index') }}" class="btn btn-primary">Volver</a>
    <a href="{{ route('shelters.edit', $shelter) }}" class="btn btn-warning">Editar</a>
    <form action="{{ route('shelters.destroy', $shelter) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
</div>
@endsection