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
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" onclick="$('#successModal').modal('hide');"></button>
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

        <h2 class="text-center mb-4 text-primary">Perfil de Usuario</h2>

        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Información Personal</h5>
                        <div class="mb-2 text-center">
                            @if ($user->avatar)
                                @if (filter_var($user->avatar, FILTER_VALIDATE_URL))
                                    <!-- Si el avatar es una URL completa (como desde GitHub) -->
                                    <img src="{{ $user->avatar }}" alt="Avatar de GitHub" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <!-- Si el avatar es una imagen subida y almacenada localmente -->
                                    <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Avatar de Perfil" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                @endif
                            @else
                                <!-- Mostrar un avatar por defecto si no hay avatar guardado -->
                                <img src="{{ asset('img/icono_mishi.png') }}" alt="Avatar por defecto" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                            @endif
                        </div>
                        <div class="mb-2">
                            <strong>Nombre:</strong>
                            <p class="form-control-plaintext">{{ $user->name }}</p>
                        </div>
                        <div class="mb-2">
                            <strong>Apellido Paterno:</strong>
                            <p class="form-control-plaintext">{{ $user->apellidoP }}</p>
                        </div>
                        <div class="mb-2">
                            <strong>Apellido Materno:</strong>
                            <p class="form-control-plaintext">{{ $user->apellidoM }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Información de Contacto</h5>
                        <div class="mb-2">
                            <strong>Correo Electrónico:</strong>
                            <p class="form-control-plaintext">{{ $user->email }}</p>
                        </div>
                        <div class="mb-2">
                            <strong>Teléfono:</strong>
                            <p class="form-control-plaintext">{{ $user->telefono }}</p>
                        </div>
                        <div class="mb-2">
                            <strong>Dirección:</strong>
                            <p class="form-control-plaintext">{{ $user->direccion }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3 text-center">
            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Editar Perfil</a>
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
