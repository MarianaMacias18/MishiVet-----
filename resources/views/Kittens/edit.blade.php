@extends('layout')

@section('title', 'Editar Mishi')

@section('content')
<div class="background-image" style="background-image: url('{{ asset('img/mishi2.jpg') }}');">
    <div class="container mt-5">
        <!-- Contenedor del formulario con fondo semi-transparente -->
        <div class="bg-dark bg-opacity-50 p-5 rounded-3 shadow-sm">
        <!-- Método PUT para hacer un UPDATE de Kittens -->
        <x-edit-component 
            title="Editar Mishi" 
            action="{{ route('kittens.update', $kitten) }}" 
            method="PUT" 
            submitText="Actualizar Mishi" 
            backRoute="{{ route('kittens.show', $kitten) }}" 
            deleteAction="{{ route('kittens.destroy', $kitten) }}"
            enctype="multipart/form-data">
            <!-- Campo para mostrar la foto actual -->
            <div class="mb-4 text-center">
                @if ($kitten->foto)
                    <img src="{{ asset('storage/kittens/' . $kitten->foto) }}" alt="{{ $kitten->nombre }}" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                @else
                    <img src="{{ asset('img/icono_mishi.png') }}" alt="Foto por defecto" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                @endif
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre" class="form-label fw-semibold text-white"><strong>Nombre</strong></label>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre de mishi" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('nombre') is-invalid border-warning @enderror" value="{{ old('nombre', $kitten->nombre) }}" required>
                        @error('nombre')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="raza" class="form-label fw-semibold text-white"><strong>Raza</strong></label>
                        <select name="raza" id="raza" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('raza') is-invalid border-warning @enderror" required onchange="handleRazaChange(this)">
                            <option value="">Selecciona una raza</option>
                            <option value="Persa" {{ old('raza', mb_strtolower($kitten->raza)) == 'persa' ? 'selected' : '' }}>Persa</option>
                            <option value="Siamés" {{ old('raza', mb_strtolower($kitten->raza)) == 'siamés' ? 'selected' : '' }}>Siamés</option>
                            <option value="Bengalí" {{ old('raza', mb_strtolower($kitten->raza)) == 'bengalí' ? 'selected' : '' }}>Bengalí</option>
                            <option value="Maine Coon" {{ old('raza', mb_strtolower($kitten->raza)) == 'maine coon' ? 'selected' : '' }}>Maine Coon</option>
                            <option value="Sphynx" {{ old('raza', mb_strtolower($kitten->raza)) == 'sphynx' ? 'selected' : '' }}>Sphynx</option>
                            <option value="Scottish Fold" {{ old('raza', mb_strtolower($kitten->raza)) == 'scottish fold' ? 'selected' : '' }}>Scottish Fold</option>
                            <option value="Ragdoll" {{ old('raza', mb_strtolower($kitten->raza)) == 'ragdoll' ? 'selected' : '' }}>Ragdoll</option>
                            <option value="Birmano" {{ old('raza', mb_strtolower($kitten->raza)) == 'birmano' ? 'selected' : '' }}>Birmano</option>
                            <option value="Británico de pelo corto" {{ old('raza', mb_strtolower($kitten->raza)) == 'británico de pelo corto' ? 'selected' : '' }}>Británico de pelo corto</option>
                            <option value="Chartreux" {{ old('raza', mb_strtolower($kitten->raza)) == 'chartreux' ? 'selected' : '' }}>Chartreux</option>
                            <option value="Mezclada" {{ old('raza', mb_strtolower($kitten->raza)) == 'mezclada' ? 'selected' : '' }}>Mezclada</option>
                        </select>
                    
                        @error('raza')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>
                                   
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="edad" class="form-label fw-semibold text-white"><strong>Edad en años</strong></label>
                        <select name="edad" id="edad" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('edad') is-invalid border-warning @enderror" required>
                            <option value="">Selecciona la edad</option>
                            @for($i = 1; $i <= 15; $i++)
                                <option value="{{ $i }}" {{ old('edad', $kitten->edad) == $i ? 'selected' : '' }}>
                                    {{ $i == 1 ? 'Mishito (menos de 1 año a un año)' : $i . ' años' }}
                                </option>
                            @endfor
                        </select>
                        
                        @error('edad')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sexo" class="form-label fw-semibold text-white"><strong>Sexo</strong></label>
                        <select name="sexo" id="sexo" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('sexo') is-invalid border-warning @enderror" required>
                            <option value="Macho" {{ old('sexo', $kitten->sexo) == 'Macho' ? 'selected' : '' }}>Macho</option>
                            <option value="Hembra" {{ old('sexo', $kitten->sexo) == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                        </select>
                        @error('sexo')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="color" class="form-label fw-semibold text-white"><strong>Color</strong></label>
                        <select name="color" id="color" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('color') is-invalid border-warning @enderror" required onchange="handleColorChange(this)">
                            <option value="">Selecciona un color</option>
                            <option value="Blanco" {{ old('color', mb_strtolower($kitten->color)) == 'blanco' ? 'selected' : '' }}>Blanco</option>
                            <option value="Negro" {{ old('color', mb_strtolower($kitten->color)) == 'negro' ? 'selected' : '' }}>Negro</option>
                            <option value="Gris" {{ old('color', mb_strtolower($kitten->color)) == 'gris' ? 'selected' : '' }}>Gris</option>
                            <option value="Marrón" {{ old('color', mb_strtolower($kitten->color)) == 'marrón' ? 'selected' : '' }}>Marrón</option>
                            <option value="Atigrado" {{ old('color', mb_strtolower($kitten->color)) == 'atigrado' ? 'selected' : '' }}>Atigrado</option>
                            <option value="Bicolor" {{ old('color', mb_strtolower($kitten->color)) == 'bicolor' ? 'selected' : '' }}>Bicolor</option>
                            <option value="Tricolor" {{ old('color', mb_strtolower($kitten->color)) == 'tricolor' ? 'selected' : '' }}>Tricolor</option>
                            <option value="Siamés" {{ old('color', mb_strtolower($kitten->color)) == 'siamés' ? 'selected' : '' }}>Siamés</option>
                            <option value="Tabby" {{ old('color', mb_strtolower($kitten->color)) == 'tabby' ? 'selected' : '' }}>Tabby</option>
                            <option value="Persa" {{ old('color', mb_strtolower($kitten->color)) == 'persa' ? 'selected' : '' }}>Persa</option>
                            <option value="Naranjiño" {{ old('color', mb_strtolower($kitten->color)) == 'naranjiño' ? 'selected' : '' }}>Naranjiño</option>
                            <option value="Multicolor" {{ old('color', mb_strtolower($kitten->color)) == 'multicolor' ? 'selected' : '' }}>Multicolor</option>
                        </select>
                        @error('color')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>                    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado" class="form-label fw-semibold text-white"><strong>Estado actual del Mishi</strong></label>
                        <select name="estado" id="estado" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('estado') is-invalid border-warning @enderror" required>
                            <option value="Libre" {{ old('estado', $kitten->estado) == 'Libre' ? 'selected' : '' }}>Libre</option>
                            <option value="Apartado" {{ old('estado', $kitten->estado) == 'Apartado' ? 'selected' : '' }}>Apartado</option>
                            <option value="Adoptado" {{ old('estado', $kitten->estado) == 'Adoptado' ? 'selected' : '' }}>Adoptado</option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="detalles" class="form-label fw-semibold text-white"><strong>Detalles</strong></label>
                <textarea name="detalles" id="detalles" placeholder="Detalles del mishi" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('detalles') is-invalid border-warning @enderror">{{ old('detalles', $kitten->detalles) }}</textarea>
                <small class="form-text text-white">Los detalles son opcionales, sin embargo, pueden ser una guía de cuidados y aspectos a tener en consideración del mishi.</small>
                @error('detalles')
                    <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo para subir una nueva imagen del mishi -->
            <div class="mb-3">
                <label for="foto" class="form-label fw-semibold text-white"><strong>Subir imagen del Mishi</strong></label>
                <input type="file" id="foto" name="foto" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('foto') is-invalid border-warning @enderror" onchange="previewImage(event)">
                <small class="form-text text-white">Sube una imagen en formato JPG, JPEG o PNG. Tamaño máximo: 2MB.</small>
                @error('foto')
                    <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                @enderror
            </div>

            <!-- Vista previa de la foto cargada -->
            <div id="preview-container" class="mt-3 text-center">
                <img id="image-preview" src="#" alt="Vista previa de la imagen" style="max-width: 200px; height: auto; display: none; margin: 0 auto;">
            </div>

            <!-- Checkbox para eliminar la imagen actual -->
            @if ($kitten->foto)
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="delete_foto" name="delete_foto" value="1">
                    <label for="delete_foto" class="form-check-label text-white">Eliminar foto del Mishi actual.</label>
                </div>
            @endif

            <div class="form-group">
                <label for="id_refugio" class="form-label fw-semibold text-white"><strong>Refugio Asociado</strong></label> 
                <select class="form-control text-dark fw-bold opacity-75 border-dark rounded-3 shadow-sm @error('id_refugio') is-invalid border-warning @enderror" name="id_refugio" id="id_refugio" required>
                    @foreach($shelters as $shelter)
                    <option value="{{ $shelter->id }}" {{ old('id_refugio', $kitten->shelter->id ?? null) == $shelter->id ? 'selected' : '' }}>
                        {{ $shelter->nombre }}
                    </option>                    
                    @endforeach
                </select>
                @error('id_refugio')
                        <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                @enderror
            </div>
         
        </x-edit-component>
        </div>
    </div>
</div>
@endsection
