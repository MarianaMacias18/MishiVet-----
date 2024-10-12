@extends('layout')

@section('title', 'Crear Refugio')

@section('content')
<div class="container mt-5">
    <x-edit-component 
        title="Crear Refugio" 
        action="{{ route('shelters.store') }}" 
        method="POST" 
        submitText="Crear Refugio"
        backRoute="{{ route('shelters.index') }}"
        deleteAction="" 
    >
        <!-- Formulario interno del componente -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" required value="{{ old('nombre') }}">
            @error('nombre')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" required value="{{ old('direccion') }}">
            @error('direccion')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" required value="{{ old('telefono') }}">
            @error('telefono')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror" required value="{{ old('correo') }}">
            @error('correo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </x-edit-component>
</div>
@endsection
