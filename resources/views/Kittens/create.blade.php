@extends('layout')

@section('title', 'Crear Mishi')

@section('content')
<div class="background-image" style="background-image: url('{{ asset('img/mishi1.jpg') }}');">
    <div class="container mt-5">
        <!-- Contenedor del formulario con fondo semi-transparente -->
        <div class="bg-dark bg-opacity-50 p-5 rounded-3 shadow-sm">
            @if ($shelters->isEmpty())
                <x-aviso-component 
                    titulo="MishiAviso sin Refugios disponibles" 
                    mensaje="Parece que aún no has creado un refugio en donde salvaguardar a tus mishis. Por favor, crea uno antes de registrar a un mishi."
                    botonTexto="Cerrar" 
                />
            @endif
            <x-edit-component 
                title="Añadir Mishi" 
                action="{{ route('kittens.store') }}" 
                method="POST"  
                submitText="Crear Mishi" 
                backRoute="{{ route('kittens.index') }}"
                deleteAction=""
                enctype="multipart/form-data" 
            >
                <!-- Nombre -->
                <div class="form-group mb-3">
                    <label for="nombre" class="form-label fw-semibold text-white"><strong>Nombre</strong></label>
                    <input type="text" name="nombre" id="nombre" placeholder="Ingresa nombre del mishi" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('nombre') is-invalid border-warning @enderror" value="{{ old('nombre') }}" required>
                    <small class="form-text text-white">El nombre del mishi no debe repetirse en otros mishis.</small>
                    @error('nombre')
                        <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Raza -->
                <div class="form-group mb-3">
                    <label for="raza" class="form-label fw-semibold text-white"><strong>Raza</strong></label>
                    <select name="raza" id="raza" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('raza') is-invalid border-warning @enderror" required onchange="handleRazaChange(this)">
                        <option value="">Selecciona una raza</option>
                        <option value="Persa" {{ old('raza') == 'Persa' ? 'selected' : '' }}>Persa</option>
                        <option value="Siamés" {{ old('raza') == 'Siamés' ? 'selected' : '' }}>Siamés</option>
                        <option value="Bengalí" {{ old('raza') == 'Bengalí' ? 'selected' : '' }}>Bengalí</option>
                        <option value="Maine Coon" {{ old('raza') == 'Maine Coon' ? 'selected' : '' }}>Maine Coon</option>
                        <option value="Sphynx" {{ old('raza') == 'Sphynx' ? 'selected' : '' }}>Sphynx</option>
                        <option value="Scottish Fold" {{ old('raza') == 'Scottish Fold' ? 'selected' : '' }}>Scottish Fold</option>
                        <option value="Ragdoll" {{ old('raza') == 'Ragdoll' ? 'selected' : '' }}>Ragdoll</option>
                        <option value="Birmano" {{ old('raza') == 'Birmano' ? 'selected' : '' }}>Birmano</option>
                        <option value="Británico de pelo corto" {{ old('raza') == 'Británico de pelo corto' ? 'selected' : '' }}>Británico de pelo corto</option>
                        <option value="Chartreux" {{ old('raza') == 'Chartreux' ? 'selected' : '' }}>Chartreux</option>
                        <option value="Mezclada" {{ old('raza') == 'Mezclada' ? 'selected' : '' }}>Mezclada</option>
                    </select>
                    @error('raza')
                        <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Edad -->
                <div class="form-group mb-3">
                    <label for="edad" class="form-label fw-semibold text-white"><strong>Edad en años</strong></label>
                    <select name="edad" id="edad" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('edad') is-invalid border-warning @enderror" required>
                        <option value="">Selecciona la edad</option>
                        @for($i = 1; $i <= 15; $i++)
                            <option value="{{ $i }}" {{ old('edad') == $i ? 'selected' : '' }}>{{ $i == 1 ? 'Mishito (menos de 1 año a un año)' : $i . ' años' }}</option>
                        @endfor
                    </select>
                    @error('edad')
                        <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sexo -->
                <div class="form-group mb-3">
                    <label for="sexo" class="form-label fw-semibold text-white"><strong>Sexo</strong></label>
                    <select name="sexo" id="sexo" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('sexo') is-invalid border-warning @enderror" required>
                        <option value="">Selecciona un sexo</option>
                        <option value="Macho" {{ old('sexo') == 'Macho' ? 'selected' : '' }}>Macho</option>
                        <option value="Hembra" {{ old('sexo') == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                    </select>
                    @error('sexo')
                        <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Color -->
                <div class="form-group mb-3">
                    <label for="color" class="form-label fw-semibold text-white"><strong>Color</strong></label>
                    <select name="color" id="color" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('color') is-invalid border-warning @enderror" required onchange="handleColorChange(this)">
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
                        <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Estado -->
                <div class="form-group mb-3">
                    <label for="estado" class="form-label fw-semibold text-white"><strong>Estado actual del mishi</strong></label>
                    <select name="estado" id="estado" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('estado') is-invalid border-warning @enderror" required>
                        <option value="Libre" {{ old('estado') == 'Libre' ? 'selected' : '' }}>Libre</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Detalles -->
                <div class="form-group mb-3">
                    <label for="detalles" class="form-label fw-semibold text-white"><strong>Detalles</strong></label>
                    <textarea name="detalles" id="detalles" placeholder="Ingresa detalles del mishi" rows="3" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('detalles') is-invalid border-warning @enderror">{{ old('detalles') }}</textarea>
                    <small class="form-text text-white">La información adicional puede incluir tratamientos, enfermedades o cuidados del mishi.</small>
                    @error('detalles')
                        <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Imagen -->
                <div class="form-group mb-3">
                    <label for="imagen" class="form-label fw-semibold text-white"><strong>Subir imagen del Mishi</strong></label>
                    <input type="file" name="imagen" id="imagen" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('imagen') is-invalid border-warning @enderror" accept="image/*" onchange="previewImage(event)">
                    <small class="form-text text-white">Nota: Puedes subir una foto del mishi para después.</small>
                    @error('imagen')
                        <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Vista previa de la foto cargada -->
                <div id="preview-container" class="mt-3 text-center">
                    <img id="image-preview" src="#" alt="Vista previa de la imagen" style="max-width: 200px; height: auto; display: none; margin: 0 auto;">
                </div>
                <!-- Refugio -->
                <div class="form-group mb-3">
                    <label for="id_refugio" class="form-label fw-semibold text-white"><strong>Refugio Asociado</strong></label> 
                    <select class="form-control text-dark fw-bold opacity-75 border-dark rounded-3 shadow-sm @error('id_refugio') is-invalid border-warning @enderror" name="id_refugio" id="id_refugio" required>
                        @foreach($shelters as $shelter)
                            <option value="{{ $shelter->id }}" {{ old('id_refugio') == $shelter->id ? 'selected' : '' }}>{{ $shelter->nombre }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-white">Tú mishi solo puede pertenecer a un refugio a la vez.</small>
                    @error('id_refugio')
                        <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                    @enderror
                </div>
            </x-edit-component>
        </div>
    </div>
</div>
@endsection
