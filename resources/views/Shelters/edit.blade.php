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
        <div class="text-center mb-3">
            @if ($shelter->foto)
                <img src="{{ asset('storage/shelters/' . $shelter->foto) }}" alt="{{ $shelter->nombre }}" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
            @else
                <img src="{{ asset('img/icono_refugio.png') }}" alt="Foto por defecto" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
            @endif
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $shelter->nombre) }}" required>
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion', $shelter->direccion) }}" required>
            @error('direccion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $shelter->telefono) }}" required>
            @error('telefono')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo', $shelter->correo) }}" required>
            @error('correo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $shelter->descripcion) }}</textarea>
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo para subir una nueva imagen del mishi -->
        <div class="mb-3">
            <label for="foto" class="form-label">Subir foto de refugio:</label>
            <input type="file" id="foto" name="foto" class="form-control">
            <small class="form-text text-muted">Sube una imagen en formato JPG, JPEG o PNG. Tamaño máximo: 2MB.</small>
            @error('foto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <!-- Checkbox para eliminar la imagen actual -->
        @if ($shelter->foto)
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="delete_foto" name="delete_foto" value="1">
                <label for="delete_foto" class="form-check-label">Eliminar foto del Refugio actual.</label>
            </div>
        @endif

        <div class="form-group">
            <label>Dueño:</label>
            <input type="text" class="form-control bg-light" value="{{ auth()->user()->name }}" readonly style="background-color: #dcdcdc; color: #000; border: 1px solid #aaa;">
        </div>
    </x-edit-component>
@endsection
