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
                    @if($kitten->foto)
                        <img src="{{ asset($kitten->foto) }}" alt="Foto de {{ $kitten->nombre }}" width="100">
                    @else
                        No disponible
                    @endif
                </td>
                <td>{{ $kitten->estado }}</td>
        
                <td>
                    <a href="{{ route('kittens.show', $kitten) }}" class="btn btn-info">Ver</a>      
                        <a href="{{ route('kittens.edit', $kitten->id) }}" class="btn btn-warning">Editar</a>
                         <form action="{{ route('kittens.destroy', $kitten->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar a {{ $kitten->nombre }}?');">
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