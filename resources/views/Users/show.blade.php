@extends('layout')

@section('title', 'Ver Perfil')

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

        <h2>Perfil de Usuario</h2>

        <div class="mb-3">
            <label for="name" class="form-label"><strong>Nombre:</strong></label>
            <p>{{ $user->name }}</p>
        </div>

        <div class="mb-3">
            <label for="apellidoP" class="form-label"><strong>Apellido Paterno:</strong></label>
            <p>{{ $user->apellidoP }}</p>
        </div>

        <div class="mb-3">
            <label for="apellidoM" class="form-label"><strong>Apellido Materno:</strong></label>
            <p>{{ $user->apellidoM }}</p>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label"><strong>Correo Electrónico:</strong></label>
            <p>{{ $user->email }}</p>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label"><strong>Teléfono:</strong></label>
            <p>{{ $user->telefono }}</p>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label"><strong>Dirección:</strong></label>
            <p>{{ $user->direccion }}</p>
        </div>

        <div class="mt-3 text-center">
            <p><a href="{{ route('users.edit', $user) }}">Editar Perfil</a></p>
        </div>
    </div>

    <!-- jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Mostrar modal de éxito si hay un mensaje de sesión
            @if (session('success'))
                $('#successModal').modal('show');
            @endif
        });
    </script>
@endsection
