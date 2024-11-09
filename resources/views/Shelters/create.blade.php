@extends('layout')

@section('title', 'Crear Refugio')

@section('content')
<div class="background-image" style="background-image: url('{{ asset('img/background5.jpg') }}');">
    <div class="container mt-5">
        <!-- Contenedor del formulario con fondo semi-transparente -->
        <div class="bg-dark bg-opacity-50 p-5 rounded-3 shadow-sm">
            <x-edit-component 
                title="Crear Refugio" 
                action="{{ route('shelters.store') }}" 
                method="POST" 
                submitText="Crear Refugio"
                backRoute="{{ route('shelters.index') }}"
                deleteAction="" 
            >
                <!-- Contenedor de inputs personalizados -->
                <div class="row mb-3">
                    <!-- Nombre -->
                    <div class="col-md-6">
                        <label for="nombre" class="form-label fw-semibold text-white"><strong>Nombre</strong></label>
                        <input type="text" 
                               class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('nombre') is-invalid border-warning @enderror" 
                               id="nombre" name="nombre" placeholder="Nombre del refugio" required value="{{ old('nombre') }}">
                        @error('nombre')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dirección -->
                    <div class="col-md-6">
                        <label for="direccion" class="form-label fw-semibold text-white"><strong>Dirección</strong></label>
                        <input type="text" 
                               class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('direccion') is-invalid border-warning @enderror" 
                               id="direccion" name="direccion" placeholder="Dirección" required value="{{ old('direccion') }}">
                        @error('direccion')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Teléfono -->
                    <div class="col-md-6">
                        <label for="telefono" class="form-label fw-semibold text-white"><strong>Teléfono</strong></label>
                        <input type="text" 
                               class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('telefono') is-invalid border-warning @enderror" 
                               id="telefono" name="telefono" placeholder="Teléfono" required value="{{ old('telefono') }}">
                        @error('telefono')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Correo -->
                    <div class="col-md-6">
                        <label for="correo" class="form-label fw-semibold text-white"><strong>Correo</strong></label>
                        <input type="email" 
                               class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('correo') is-invalid border-warning @enderror" 
                               id="correo" name="correo" placeholder="Correo" required value="{{ old('correo') }}">
                        @error('correo')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Descripción -->
                    <div class="col-12">
                        <label for="descripcion" class="form-label fw-semibold text-white"><strong>Descripción</strong></label>
                        <textarea 
                            class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('descripcion') is-invalid border-warning @enderror" 
                            id="descripcion" name="descripcion" placeholder="Descripción">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Campo para subir una nueva imagen de avatar -->
                <div class="mb-3">
                    <label for="foto" class="form-label fw-semibold text-white"><strong>Foto del Refugio</strong></label>
                    <input type="file" 
                           id="foto" name="foto" 
                           class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold" 
                           onchange="previewImage(event)">
                    <small class="form-text text-white"><strong>Formato JPG, JPEG o PNG. Tamaño máximo: 2MB.<br>Nota: Puedes subir una foto después.</strong></small>
                    @error('foto')
                        <div class="text-warning">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Vista previa de la foto cargada -->
                <div id="preview-container" class="mt-3 text-center">
                    <img id="image-preview" src="#" alt="Vista previa de la imagen" style="max-width: 200px; height: auto; display: none; margin: 0 auto;">
                </div>

            </x-edit-component>
        </div>
    </div>
</div>

<script>
    // Función para mostrar la vista previa de la imagen cargada
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            const preview = document.getElementById('image-preview');
            preview.src = reader.result;
            preview.style.display = 'block'; // Muestra la imagen
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection
