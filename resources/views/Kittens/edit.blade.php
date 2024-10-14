@extends('layout')

@section('title', 'Editar Mishi')

@section('content')
    <x-edit-component 
        title="Edición Mishis" 
        action="{{ route('kittens.update', $kitten) }}" 
        method="PUT" 
        submitText="Actualizar Mishi" 
        backRoute="{{ route('kittens.show', $kitten) }}" 
        deleteAction="{{ route('kittens.destroy', $kitten) }}">

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $kitten->nombre) }}" required>
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="raza">Raza</label>
            <input type="text" name="raza" class="form-control" value="{{ old('raza', $kitten->raza) }}" required>
            @error('raza')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="edad">Edad</label>
            <input type="text" name="direccion" class="form-control" value="{{ old('edad', $kitten->edad) }}" required>
            @error('edad')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="sexo">Sexo</label>
            <input type="text" name="sexo" class="form-control" value="{{ old('sexo', $kitten->sexo) }}" required>
            @error('sexo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" name="color" class="form-control" value="{{ old('color', $kitten->color) }}" required>
            @error('color')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" name="raza" class="form-control" value="{{ old('estado', $kitten->estado) }}" required>
            @error('estado')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="raza">Teléfono</label>
            <input type="text" name="raza" class="form-control" value="{{ old('raza', $kitten->raza) }}" required>
            @error('raza')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="detalles">Detalles</label>
            <textarea name="detalles" class="form-control">{{ old('detalles', $kitten->detalles) }}</textarea>
            @error('detalles')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

    </x-edit-component>
@endsection
