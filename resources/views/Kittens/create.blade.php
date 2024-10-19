@extends('layout')

@section('title', 'Crear Mishi')

@section('content')
    <x-edit-component 
        title="Creacion Mishis" 
        action="{{ route('kittens.store') }}" 
        method="POST"  
        submitText="Crear Mishi" 
        backRoute="{{ route('kittens.index') }}"
        deleteAction=""
        enctype="multipart/form-data" 
    >
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="raza">Raza</label>
            <input type="text" name="raza" id="raza" class="form-control" value="{{ old('raza') }}" required>
            @error('raza')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="edad">Edad</label>
            <input type="text" name="edad" id="edad" class="form-control" value="{{ old('edad') }}">
            @error('edad')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="sexo">Sexo</label>
            <select name="sexo" id="sexo" class="form-control" required>
                <option value="Macho" {{ old('sexo') == 'Macho' ? 'selected' : '' }}>Macho</option>
                <option value="Hembra" {{ old('sexo') == 'Hembra' ? 'selected' : '' }}>Hembra</option>
            </select>
            @error('sexo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" name="color" id="color" class="form-control" value="{{ old('color') }}" required>
            @error('color')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="Libre" {{ old('estado') == 'Libre' ? 'selected' : '' }}>Libre</option>
            </select>
            @error('estado')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="detalles">Detalles</label>
            <textarea name="detalles" id="detalles" class="form-control">{{ old('detalles') }}</textarea>
            @error('detalles')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Campo para subir una nueva imagen de avatar -->
        <div class="mb-3">
            <label for="foto" class="form-label">Subir foto de mishi:</label>
            <input type="file" id="foto" name="foto" class="form-control">
            <small class="form-text text-muted">Sube una imagen en formato JPG, JPEG o PNG. Tamaño máximo: 2MB. <br>Nota: Puedes subir una foto después.</small>
            @error('foto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="id_refugio">Refugio Asociado</label>
            <select class="form-control @error('id_refugio') is-invalid @enderror" name="id_refugio" id="id_refugio" required>
                @foreach($shelters as $shelter)
                    <option value="{{ $shelter->id }}" {{ old('id_refugio') == $shelter->id ? 'selected' : '' }}>
                        {{ $shelter->nombre }}
                    </option>
                @endforeach
            </select>
            @error('id_refugio')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </x-edit-component>
@endsection
