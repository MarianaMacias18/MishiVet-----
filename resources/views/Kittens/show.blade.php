@extends('layout')

@section('title', 'Ver Mishi')

@section('content')
<div class="container mt-5">
    <h1>{{ $kitten->nombre }}</h1>
    <p>Raza: {{ $kitten->raza }}</p>
    <p>Edad: {{ $kitten->edad }}</p>
    <p>Sexo: {{ $kitten->sexo }}</p>
    <p>Color: {{ $kitten->color}}</p>
    <p>Sexo: {{ $kitten->estado }}</p>
    <p>Detalles: {{ $kitten->detalles }}</p>
    <p>Foto: 
        <td>
            @if($kitten->foto)
            <img src="{{ asset($kitten->foto) }}" alt="Foto de {{ $kitten->nombre }}" width="100">
            @else
                No disponible
            @endif
        </td>
    </p>
    <a href="{{ route('kittens.index') }}" class="btn btn-primary">Volver</a>
    <a href="{{ route('kittens.edit', $kitten) }}" class="btn btn-warning">Editar</a>
    <form action="{{ route('kittens.destroy', $kitten) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
</div>
@endsection