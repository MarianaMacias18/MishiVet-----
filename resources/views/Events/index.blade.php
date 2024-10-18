@extends('layout')

@section('title', 'Eventos')

@section('content')
<div class="container mt-5">
    <h1>Eventos</h1>
    <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Crear Evento</a>
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
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Refugios Asociados</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->nombre }}</td>
                <td>{{ $event->fecha }}</td>
                <td>{{ $event->descripcion }}</td>
                <td>
                    @foreach($event->shelters as $shelter)
                        {{ $shelter->nombre }}<br>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('events.show', $event) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('events.edit', $event) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;">
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
