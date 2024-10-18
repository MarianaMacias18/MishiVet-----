
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
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="raza">Raza</label>
            <input type="text" name="raza" class="form-control" value="{{ old('raza') }}" required>
            @error('raza')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="edad">Edad</label>
            <input type="text" name="edad" class="form-control" value="{{ old('edad') }}" >
            @error('edad')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="sexo">Sexo</label>
            <select name="sexo" class="form-control" required>
                <option value="macho" {{ old('sexo') == 'macho' ? 'selected' : '' }}>Macho</option>
                <option value="hembra" {{ old('sexo') == 'hembra' ? 'selected' : '' }}>Hembra</option>
            </select>
            @error('sexo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" name="color" class="form-control" value="{{ old('color') }}" required>
            @error('color')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" class="form-control" required>
                <option value="libre" {{ old('estado') == 'libre' ? 'selected' : '' }}>Libre</option>
                <option value="apartado" {{ old('estado') == 'apartado' ? 'selected' : '' }}>Apartado</option>
                <option value="adoptado" {{ old('estado') == 'adoptado' ? 'selected' : '' }}>Adoptado</option>
            </select>
            @error('estado')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="detalles">Detalles</label>
            <textarea name="detalles" class="form-control">{{ old('detalles') }}</textarea>
            @error('detalles')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Campo para subir una nueva imagen de avatar -->
        <div class="mb-3">
            <label for="foto" class="form-label">Subir foto gato:</label>
            <input type="file" id="foto" name="foto" class="form-control">
            <small class="form-text text-muted">Sube una imagen en formato JPG, JPEG o PNG. Tamaño máximo: 2MB.</small>
            @error('foto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="id_refugio">Refugio Asociado</label>
            <select multiple class="form-control @error('id_refugio') is-invalid @enderror" name="id_refugio[]" required>
                @foreach($shelters as $shelter)
                    <option value="{{ $shelter->id }}">{{ $shelter->nombre }}
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
