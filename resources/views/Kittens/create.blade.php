@extends('layout')

@section('title', 'Mishis')

@section('content')

    <h1>{{ isset($kitten) ? 'Editar Mishi' : 'Crear Mishi' }}</h1>

    <form action="{{ isset($kitten) ? route('kittens.update', $kitten->id) : route('kittens.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($kitten))
            @method('PUT')
        @endif

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre', $kitten->nombre ?? '') }}">
         @error('nombre')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        <label for="raza">Raza:</label>
        <input type="text" name="raza" value="{{ old('raza', $kitten->raza ?? '') }}">
        @error('raza')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <label for="edad">Edad:</label>
        <input type="number" name="edad" value="{{ old('edad', $kitten->edad ?? '') }}">
        @error('edad')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <label for="sexo">Sexo:</label>
        <select name="sexo">
            <option value="macho" {{ (old('sexo') ?? ($kitten->sexo ?? '')) == 'macho' ? 'selected' : '' }}>Macho</option>
            <option value="hembra" {{ (old('sexo') ?? ($kitten->sexo ?? '')) == 'hembra' ? 'selected' : '' }}>Hembra</option>
        </select>
        @error('sexo')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <label for="estado">Estado:</label>
        <select name="estado">
            <option value="adoptado" {{ (old('estado') ?? ($kitten->estado ?? '')) == 'adoptado' ? 'selected' : '' }}>Adoptado</option>
            <option value="apartado" {{ (old('estado') ?? ($kitten->estado ?? '')) == 'apartado' ? 'selected' : '' }}>Apartado</option>
            <option value="libre" {{ (old('estado') ?? ($kitten->estado ?? '')) == 'libre' ? 'selected' : '' }}>Libre</option>
        </select>
        @error('estado')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <div class="mb-3">
                <label for="foto" class="form-label">Subir o actualizar fotoMishi</label>
                <input type="file" id="foto" name="foto" class="form-control">
                <small class="form-text text-muted">Sube una imagen en formato JPG, JPEG o PNG. Tamaño máximo: 2MB.</small>
        </div>
        @error('foto')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <label for="detalles">Detalles:</label>
        <textarea name="detalles">{{ old('detalles', $kitten->detalles ?? '') }}</textarea>
        @error('detalles')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <button type="submit">{{ isset($kitten) ? 'Actualizar' : 'Crear' }}</button>
    </form>
@endsection