@extends('layout')

@section('title', 'Ver Refugio')

@section('content')
<div class="container mt-5">
    <h1>{{ $shelter->nombre }}</h1>
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