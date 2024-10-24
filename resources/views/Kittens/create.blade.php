@extends('layout')

@section('title', 'Crear Mishi')

@section('content')
    @if ($shelters->isEmpty())
        <x-aviso-component 
            titulo="MishiAviso sin Refugios disponibles" 
            mensaje="Parece que aún no has creado un refugio en donde salvaguardar a tus mishis. Por favor, crea uno antes de registrar a un mishi."
            botonTexto="Cerrar" 
        />
    @endif
    <x-edit-component 
        title="Creación de Mishis" 
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
            <small class="form-text text-muted">El nombre del mishi no debe repetirse en otros mishis.</small>
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="raza">Raza</label>
            <select name="raza" id="raza" class="form-control" required onchange="handleRazaChange(this)">
                <option value="">Selecciona una raza</option>
                <option value="Persa" {{ old('raza') == 'Persa' ? 'selected' : '' }}>Persa</option>
                <option value="Siames" {{ old('raza') == 'Siames' ? 'selected' : '' }}>Siamés</option>
                <option value="Bengali" {{ old('raza') == 'Bengali' ? 'selected' : '' }}>Bengalí</option>
                <option value="Maine Coon" {{ old('raza') == 'Maine Coon' ? 'selected' : '' }}>Maine Coon</option>
                <option value="Sphynx" {{ old('raza') == 'Sphynx' ? 'selected' : '' }}>Sphynx</option>
                <option value="Scottish Fold" {{ old('raza') == 'Scottish Fold' ? 'selected' : '' }}>Scottish Fold</option>
                <option value="Ragdoll" {{ old('raza') == 'Ragdoll' ? 'selected' : '' }}>Ragdoll</option>
                <option value="Birmano" {{ old('raza') == 'Birmano' ? 'selected' : '' }}>Birmano</option>
                <option value="Britanico de pelo corto" {{ old('raza') == 'Britanico de pelo corto' ? 'selected' : '' }}>Británico de pelo corto</option>
                <option value="Chartreux" {{ old('raza') == 'Chartreux' ? 'selected' : '' }}>Chartreux</option>
                <option value="Mezclada" {{ old('raza') == 'Mezclada' ? 'selected' : '' }}>Mezclada</option>
            </select>
            @error('raza')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="edad">Edad en años</label>
            <select name="edad" id="edad" class="form-control" required>
                <option value="">Selecciona la edad</option>
                @for($i = 1; $i <= 15; $i++)
                    <option value="{{ $i }}" {{ old('edad') == $i ? 'selected' : '' }}>{{ $i == 1 ? 'Mishito (menos de 1 año a un año)' : $i . ' año' }}</option>
                @endfor
            </select>
            
            @error('edad')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="sexo">Sexo</label>
            <select name="sexo" id="sexo" class="form-control" required>
                <option value="">Selecciona un sexo</option>
                <option value="Macho" {{ old('sexo') == 'Macho' ? 'selected' : '' }}>Macho</option>
                <option value="Hembra" {{ old('sexo') == 'Hembra' ? 'selected' : '' }}>Hembra</option>
            </select>
            @error('sexo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="color">Color</label>
            <select name="color" id="color" class="form-control" required onchange="handleColorChange(this)">
                <option value="">Selecciona un color</option>
                <option value="Blanco" {{ old('color') == 'Blanco' ? 'selected' : '' }}>Blanco</option>
                <option value="Negro" {{ old('color') == 'Negro' ? 'selected' : '' }}>Negro</option>
                <option value="Gris" {{ old('color') == 'Gris' ? 'selected' : '' }}>Gris</option>
                <option value="Marrón" {{ old('color') == 'Marrón' ? 'selected' : '' }}>Marrón</option>
                <option value="Atigrado" {{ old('color') == 'Atigrado' ? 'selected' : '' }}>Atigrado</option>
                <option value="Bicolor" {{ old('color') == 'Bicolor' ? 'selected' : '' }}>Bicolor</option>
                <option value="Tricolor" {{ old('color') == 'Tricolor' ? 'selected' : '' }}>Tricolor</option>
                <option value="Siamés" {{ old('color') == 'Siamés' ? 'selected' : '' }}>Siamés</option>
                <option value="Tabby" {{ old('color') == 'Tabby' ? 'selected' : '' }}>Tabby</option>
                <option value="Persa" {{ old('color') == 'Persa' ? 'selected' : '' }}>Persa</option>
                <option value="Naranjiño" {{ old('color') == 'Naranjiño' ? 'selected' : '' }}>Naranjiño</option>
                <option value="Multicolor" {{ old('color') == 'Multicolor' ? 'selected' : '' }}>Multicolor</option>
            </select>
            @error('color')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="estado">Estado actual del mishi</label>
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
            <small class="form-text text-muted">Los detalles son opcionales, sin embargo, pueden ser una guía de cuidados y aspectos a tener en consideración del mishi.</small>
            @error('detalles')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
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
                    <option value="{{ $shelter->id }}" {{ old('id_refugio') == $shelter->id ? 'selected' : '' }}>{{ $shelter->nombre }}</option>
                @endforeach
            </select>
            @error('id_refugio')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Crear Mishi</button>
    </x-edit-component>
@endsection
