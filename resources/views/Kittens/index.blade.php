@extends('layout')

@section('title', 'Mishis')

@section('content')
<div class="container mt-5">
    <h1>Mishis</h1>
    <a href="{{ route('kittens.create') }}" class="btn btn-primary mb-3">Crear nuevo Mishi</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Raza</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>Color</th>
                <th>Detalles</th>
                <th>Foto</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($kittens as $kitten)
            <tr>
                <td>{{ $kitten->nombre }}</td>
                <td>{{ $kitten->raza }}</td>
                <td>{{ $kitten->edad }}</td>
                <td>{{ $kitten->sexo }}</td>
                <td>{{ $kitten->color }}</td>
                <td>{{ $kitten->detalles }}</td>
                
                <td>
                      @if (filter_var($kitten->foto, FILTER_VALIDATE_URL))
                            <!-- Si el avatar es una URL completa (como desde GitHub) -->
                            <img src="{{ $kitten->foto }}" alt="foto kitten" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <!-- Si el avatar es una imagen subida y almacenada localmente -->
                                <img src="{{ asset('storage/kittens/' . $kitten->foto) }}" alt="kitten foto" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                </td>
                <td>{{ $kitten->estado }}</td>
        
                <td>
                    <a href="{{ route('kittens.show', $kitten) }}" class="btn btn-info">Ver</a>      
                        <a href="{{ route('kittens.edit', $kitten) }}" class="btn btn-warning">Editar</a>
                         <form action="{{ route('kittens.destroy', $kitten) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar a {{ $kitten->nombre }}?');">
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