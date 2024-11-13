{{-- resources/views/shelters/edit.blade.php --}}

@extends('layout')

@section('title', 'Editar Refugio')

@section('content')
<div class="background-image" style="background-image: url('{{ asset('img/background6.jpg') }}');">
    <div class="container mt-5">
        <!-- Contenedor del formulario con fondo semi-transparente -->
        <div class="bg-dark bg-opacity-50 p-5 rounded-3 shadow-sm">
            <x-edit-component 
                title="Editar Refugio" 
                action="{{ route('shelters.update', $shelter) }}" 
                method="PUT" 
                submitText="Actualizar Refugio" 
                backRoute="{{ route('shelters.show', $shelter) }}" 
                deleteAction="{{ route('shelters.destroy', $shelter) }}">
                
                <!-- Foto del refugio -->
                <div class="text-center mb-3">
                    @if ($shelter->foto)
                        <img src="{{ asset('storage/shelters/' . $shelter->foto) }}" alt="{{ $shelter->nombre }}" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <img src="{{ asset('img/icono_refugio.png') }}" alt="Foto por defecto" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    @endif
                </div>

                <!-- Inputs del formulario -->
                <div class="row mb-3">
                    <!-- Nombre -->
                    <div class="col-md-6">
                        <label for="nombre" class="form-label text-white fw-semibold"><strong>Nombre</strong></label>
                        <input type="text" name="nombre" id="nombre" class="form-control bg-white text-dark opacity-75 border-dark fw-bold rounded-3 shadow-sm @error('nombre') is-invalid border-warning @enderror" value="{{ old('nombre', $shelter->nombre) }}" required>
                        @error('nombre')
                            <div class="invalid-feedback text-warning">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dirección -->
                    <div class="col-md-6">
                        <label for="direccion" class="form-label text-white fw-semibold"><strong>Dirección</strong></label>
                        <input type="text" name="direccion" id="direccion" class="form-control bg-white text-dark fw-bold opacity-75 border-dark rounded-3 shadow-sm @error('direccion') is-invalid border-warning @enderror" value="{{ old('direccion', $shelter->direccion) }}" required>
                        @error('direccion')
                            <div class="invalid-feedback text-warning">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Teléfono -->
                    <div class="col-md-6">
                        <label for="telefono" class="form-label text-white fw-semibold"><strong>Teléfono</strong></label>
                        <input type="text" name="telefono" id="telefono" class="form-control bg-white text-dark fw-bold opacity-75 border-dark rounded-3 shadow-sm @error('telefono') is-invalid border-warning @enderror" value="{{ old('telefono', $shelter->telefono) }}" required>
                        @error('telefono')
                            <div class="invalid-feedback text-warning">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Correo -->
                    <div class="col-md-6">
                        <label for="correo" class="form-label text-white fw-semibold"><strong>Correo</strong></label>
                        <input type="email" name="correo" id="correo" class="form-control bg-white text-dark fw-bold opacity-75 border-dark rounded-3 shadow-sm @error('correo') is-invalid border-warning @enderror" value="{{ old('correo', $shelter->correo) }}" required>
                        @error('correo')
                            <div class="invalid-feedback text-warning">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <!-- Descripción -->
                    <label for="descripcion" class="form-label text-white fw-semibold"><strong>Descripción</strong></label>
                    <textarea name="descripcion" id="descripcion" class="form-control bg-white text-dark fw-bold opacity-75 border-dark rounded-3 shadow-sm @error('descripcion') is-invalid border-warning @enderror">{{ old('descripcion', $shelter->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback text-warning">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo para subir una nueva imagen -->
                <div class="mb-3">
                    <label for="foto" class="form-label text-white"><strong>Subir nueva foto de refugio</strong></label>
                    <input type="file" name="foto" id="foto" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm" onchange="previewImage(event)">
                    <small class="form-text text-white"><strong>Formato JPG, JPEG o PNG. Tamaño máximo: 2MB.</strong></small>
                    @error('foto')
                        <div class="text-warning">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Vista previa de la foto cargada -->
                <div id="preview-container" class="mt-3 text-center">
                    <img id="image-preview" src="#" alt="Vista previa de la imagen" style="max-width: 200px; height: auto; display: none;">
                </div>

                <!-- Checkbox para eliminar la imagen actual -->
                @if ($shelter->foto)
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="delete_foto" name="delete_foto" value="1">
                        <label for="delete_foto" class="form-check-label text-white">Eliminar foto del refugio actual.</label>
                    </div>
                @endif

                <!-- Dueño del refugio -->
                <div class="form-group">
                    <label for="owner" class="form-label text-white"><strong>Dueño</strong></label>
                    <input type="text" class="form-control bg-light text-dark" value="{{ auth()->user()->name }}" readonly style="background-color: #dcdcdc; color: #000; border: 1px solid #aaa;">
                </div>

            </x-edit-component>
        </div>
    </div>
</div>
@endsection
