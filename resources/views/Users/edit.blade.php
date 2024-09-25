@extends('layout')

@section('title', 'Editar Perfil')

@section('content')
    <div class="container mt-5">
        <!-- Modal de éxito -->
        @if (session('success'))
            <div class="modal fade show" id="successModal" tabindex="-1" role="dialog" style="display: block; background-color: rgba(0, 0, 0, 0.5);">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">¡Mishi-éxito!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#successModal').modal('hide');">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>{{ session('success') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#successModal').modal('hide');">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <h2>Editar Perfil</h2>
        <!-- Metodo PUT para hacer un UPDATE de Usuarios -->
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT') 
            
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="apellidoP" class="form-label">Apellido Paterno</label>
                <input type="text" id="apellidoP" name="apellidoP" class="form-control" value="{{ old('apellidoP', $user->apellidoP) }}" required>
            </div>

            <div class="mb-3">
                <label for="apellidoM" class="form-label">Apellido Materno</label>
                <input type="text" id="apellidoM" name="apellidoM" class="form-control" value="{{ old('apellidoM', $user->apellidoM) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" minlength="8">
                <small class="form-text text-muted">Puedes omitirlo si no deseas cambiar tu contraseña.</small>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" minlength="8">
                <small class="form-text text-muted">Confirma tu nueva contraseña.</small>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="form-control" value="{{ old('telefono', $user->telefono) }}">
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <textarea id="direccion" name="direccion" class="form-control" rows="3">{{ old('direccion', $user->direccion) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="mt-3 text-center">
        <p><a href="{{ route('users.show', $user) }}">Volver</a></p>
    </div>

    <!-- Método Delete/Destroy Usuarios -->
    <form id="delete-profile-form" action="{{ route('users.destroy', $user) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-danger" id="delete-profile-btn">
            Eliminar Perfil
        </button>
    </form>

    <!-- jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Mostrar modal de éxito si hay un mensaje de sesión
            @if (session('success'))
                $('#successModal').modal('show');
            @endif
    
            // Confirmación antes de eliminar el perfil
            $('#delete-profile-btn').on('click', function(event) {
                event.preventDefault(); // Prevenir el comportamiento por defecto del botón
    
                // Mostrar cuadro de confirmación
                if (confirm('¿Estás seguro de que deseas eliminar tu perfil? Esta acción no se puede deshacer.')) {
                    // Si el usuario confirma, enviar el formulario
                    $('#delete-profile-form').submit();
                }
            });
        });
    </script>    
@endsection
