@extends('layout')

@section('title', 'Refugios')

@section('content')
<div class="container mt-5">
    <h1>Mis Refugios</h1>
    <a href="{{ route('shelters.create') }}" class="btn btn-primary">Agregar Refugio</a>
    <!-- Mensaje de error -->
    @if (session('error'))
        <x-alert type="danger" message="{{ session('error') }}" />
    @endif

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shelters as $shelter)
                <tr>
                    <td>{{ $shelter->nombre }}</td>
                    <td>{{ $shelter->direccion }}</td>
                    <td>{{ $shelter->telefono }}</td>
                    <td>{{ $shelter->correo }}</td>
                    <td>
                        <a href="{{ route('shelters.show', $shelter) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('shelters.edit', $shelter) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('shelters.destroy', $shelter) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
