{{-- resources/views/shelters/edit.blade.php --}}

@extends('layout')

@section('title', 'Editar Refugio')

@section('content')
    <x-edit-component 
        title="Edición Refugio" 
        action="{{ route('shelters.update', $shelter) }}" 
        method="PUT" 
        submitText="Actualizar Refugio" 
        backRoute="{{ route('shelters.show', $shelter) }}" 
        deleteAction="{{ route('shelters.destroy', $shelter) }}">

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $shelter->nombre) }}" required>
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $shelter->direccion) }}" required>
            @error('direccion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $shelter->telefono) }}" required>
            @error('telefono')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" name="correo" class="form-control" value="{{ old('correo', $shelter->correo) }}" required>
            @error('correo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ old('descripcion', $shelter->descripcion) }}</textarea>
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Dueño:</label>
            <input type="text" class="form-control bg-light" value="{{ auth()->user()->name }}" readonly style="background-color: #dcdcdc; color: #000; border: 1px solid #aaa;">
        </div>
    </x-edit-component>
@endsection
