@extends('layout')

@section('title', 'Ver Mishi')

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

    <h2 class="text-center mb-4 text-primary">Perfil de {{ $kitten->nombre }}</h2>

    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Información del Mishi</h5>
                    <div class="text-center mb-3">
                        @if ($kitten->foto)
                            <img src="{{ asset('storage/kittens/' . $kitten->foto) }}" alt="{{ $kitten->nombre }}" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('img/icono_mishi.png') }}" alt="Foto por defecto" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                    </div>
                    <div class="mb-2">
                        <strong>Raza:</strong>
                        <p class="form-control-plaintext">{{ $kitten->raza }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>Edad:</strong>
                        <p class="form-control-plaintext">{{ $kitten->edad }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>Refugio Asociado:</strong>
                        <p class="form-control-plaintext">{{ $kitten->shelter->nombre ?? 'No asignado' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Detalles Adicionales</h5>
                    <div class="mb-2">
                        <strong>Sexo:</strong>
                        <p class="form-control-plaintext">{{ $kitten->sexo }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>Color:</strong>
                        <p class="form-control-plaintext">{{ $kitten->color }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>Estado:</strong>
                        <p class="form-control-plaintext">{{ $kitten->estado }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>Detalles:</strong>
                        <p class="form-control-plaintext">{{ $kitten->detalles }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 text-center">
        <a href="{{ route('kittens.index') }}" class="btn btn-primary">Volver</a>
        <a href="{{ route('kittens.edit', $kitten) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('kittens.destroy', $kitten) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
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
