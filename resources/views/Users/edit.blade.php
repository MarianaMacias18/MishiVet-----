@extends('layout')

@section('title', 'Editar Perfil')

@section('content')
<div class="background-image" style="background-image: url('{{ asset('img/background5.jpg') }}');">
    <div class="container mt-5 position-relative">
        <div class="bg-dark bg-opacity-50 p-5 rounded-4 shadow-sm">
        <x-edit-component 
                title="Perfil" 
                action="{{ route('users.update', $user) }}" 
                method="PUT" 
                submitText="Actualizar Perfil" 
                backRoute="{{ route('users.show', $user) }}" 
                deleteAction="{{ route('users.destroy', $user) }}">

        <!-- Sección del título y la imagen -->
        <div class="mb-4 text-center">
            @if ($user->avatar)
                @if (filter_var($user->avatar, FILTER_VALIDATE_URL))
                    <!-- Si el avatar es una URL completa (como desde GitHub) -->
                    <img src="{{ $user->avatar }}" alt="Avatar de GitHub" class="rounded-circle img-fluid mb-3" style="width: 210px; height: 210px; object-fit: cover;">
                @else
                    <!-- Si el avatar es una imagen subida y almacenada localmente -->
                    <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Avatar de Perfil" class="rounded-circle img-fluid mb-3" style="width: 210px; height: 210px; object-fit: cover;">
                @endif
            @else
                <!-- Mostrar un avatar por defecto si no hay avatar guardado -->
                <img src="{{ asset('img/icono_mishi.png') }}" alt="Avatar por defecto" class="rounded-circle img-fluid mb-3" style="width: 210px; height: 210px; object-fit: cover;">
            @endif


        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="form-label text-white fw-semibold"><strong>Nombre</strong></label>
                <input type="text" id="name" name="name" class="form-control bg-white text-dark opacity-75 border-primary fw-bold rounded-3 shadow-sm @error('name') is-invalid border-warning @enderror" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback text-warning"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="apellidoP" class="form-label text-white fw-semibold"><strong>Apellido Paterno</strong></label>
                <input type="text" id="apellidoP" name="apellidoP" class="form-control bg-white text-dark opacity-75 border-primary fw-bold rounded-3 shadow-sm @error('apellidoP') is-invalid border-warning @enderror" value="{{ old('apellidoP', $user->apellidoP) }}" required>
                @error('apellidoP')
                     <div class="invalid-feedback text-warning"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="apellidoM" class="form-label text-white fw-semibold"><strong>Apellido Materno</strong></label>
                <input type="text" id="apellidoM" name="apellidoM" class="form-control bg-white text-dark opacity-75 border-primary fw-bold rounded-3 shadow-sm @error('apellidoM') is-invalid border-warning @enderror" value="{{ old('apellidoM', $user->apellidoM) }}" required>
                @error('apellidoM')
                    <div class="invalid-feedback text-warning"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label text-white fw-semibold"><strong>Correo Electrónico</strong></label>
                <input type="email" id="email" name="email" class="form-control bg-white text-dark opacity-75 border-primary fw-bold rounded-3 shadow-sm @error('email') is-invalid border-warning @enderror" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback text-warning"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="password" class="form-label text-info fw-semibold"><strong>Cambiar Contraseña</strong></label>
                <input type="password" id="password" name="password" placeholder="Ingresa una contraseña" class="form-control bg-white text-success opacity-75 border-info fw-bold rounded-3 shadow-sm @error('password') is-invalid border-warning @enderror" minlength="8">
                <small class="form-text text-white">Puedes omitirlo si no deseas cambiar tu contraseña.</small>
                @error('password')
                    <div class="invalid-feedback text-warning"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="password_confirmation" class="form-label text-info fw-semibold"><strong>Confirmar Contraseña</strong></label>
                <input type="password" id="password_confirmation" placeholder="Confirma tu nueva contraseña" name="password_confirmation" class="form-control bg-white text-success opacity-75 border-info fw-bold rounded-3 shadow-sm @error('password_confirmation') is-invalid border-warning @enderror" minlength="8">
                @error('password_confirmation')
                    <div class="invalid-feedback text-warning"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label text-white fw-semibold"><strong>Teléfono</strong></label>
            <input type="text" id="telefono" name="telefono" class="form-control bg-white text-dark opacity-75 border-primary fw-bold rounded-3 shadow-sm @error('telefono') is-invalid border-warning @enderror" value="{{ old('telefono', $user->telefono) }}">
            @error('telefono')
                <div class="invalid-feedback text-warning"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label text-white fw-semibold"><strong>Dirección</strong></label>
            <textarea id="direccion" name="direccion" class="form-control bg-white text-dark opacity-75 border-primary fw-bold rounded-3 shadow-sm @error('direccion') is-invalid border-warning @enderror" rows="3">{{ old('direccion', $user->direccion) }}</textarea>
            @error('direccion')
                <div class="invalid-feedback text-warning"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <!-- Campo para subir una nueva imagen de avatar -->
        <div class="mb-3">
            <label for="avatar" class="form-label text-white fw-semibold"><strong>Subir o Actualizar MishiAvatar</strong></label>
            <input type="file" id="avatar" name="avatar" class="form-control bg-white text-dark opacity-75 border-primary fw-bold rounded-3 shadow-sm @error('avatar') is-invalid border-warning @enderror" onchange="previewImage(event)">
            <small class="form-text text-white">Subir una imagen en formato JPG, JPEG o PNG. Tamaño máximo: 2MB.</small>
            @error('avatar')
                <div class="invalid-feedback text-warning"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <!-- Vista previa de la foto cargada -->
        <div id="preview-container" class="mt-3 text-center">
            <img id="image-preview" src="#" alt="Vista previa de la imagen" style="max-width: 200px; height: auto; display: none; margin: 0 auto;">
        </div>

        <!-- Checkbox para eliminar la imagen actual -->
        @if ($user->avatar)
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="delete_avatar" name="delete_avatar" value="1">
                <label for="delete_avatar" class="form-check-label text-white">Eliminar foto de perfil o avatar actual.</label>
            </div>
        @endif
    </x-edit-component>
    </div>
  </div>
</div>

    <!-- jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
