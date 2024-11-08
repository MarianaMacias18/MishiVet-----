@extends('layout')

@section('title', 'Ver Mishi en Adopción')

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
    <h2 class="text-center mb-4 text-primary">Detalles del mishi <span class="text-danger">{{ $kitten->nombre }}</span></h2>

    <!-- Carrusel -->
    <div id="kittenDetailsCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner rounded shadow-lg" style="background-color: #f8f9fa;">

            <!-- Detalles del Mishi -->
            <div class="carousel-item active">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-dark">Información del Mishi</h5>
                                <div class="text-center mb-3">
                                    @if ($kitten->foto)
                                        <img src="{{ asset('storage/kittens/' . $kitten->foto) }}" alt="{{ $kitten->nombre }}" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('img/icono_mishi.png') }}" alt="Foto por defecto" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                    @endif
                                </div>
                                <p><strong>Raza:</strong> {{ $kitten->raza }}</p>
                                <p><strong>Edad:</strong> {{ $kitten->edad }} años</p>
                                <p><strong>Sexo:</strong> {{ $kitten->sexo }}</p>
                                <p class="card-text text-dark"><strong>Estado:</strong> 
                                    <span class="badge {{ $kitten->estado == 'Libre' ? 'bg-info' : 'bg-warning' }}">{{ $kitten->estado }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Detalles adicionales -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-success">Detalles Adicionales</h5>
                                <p><strong>Información y cuidados:</strong> {{ $kitten->detalles}}</p>
                                <p><strong>Color:</strong> {{ $kitten->color}}</p>

                                <!-- Botones de acción -->
                                <div class="mt-4 text-left">
                                    <form action="{{ route('notifications.store', $kitten) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success me-4"
                                            @if($kitten->estado == 'Apartado') disabled @endif>
                                            @if($kitten->estado == 'Apartado')
                                                Adopción no disponible
                                            @else
                                                ¡Adoptar este Mishi!
                                            @endif
                                        </button>
                                    </form>
                                    <!-- Botón de Donar al Refugio -->
                                    <div class="mt-2">
                                        <a href="{{ route('dashboard.donate', $kitten) }}" class="btn btn-danger">
                                            Donar al Refugio
                                        </a>
                                    </div>
                                    <!-- Botón de Descargar PDF -->
                                    <div class="mt-2">
                                        <a href="{{ route('doc.pdf', $kitten) }}" class="btn btn-primary">
                                            Descargar PDF
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Refugio Asociado -->
            <div class="carousel-item">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title text-success">Refugio {{ $kitten->shelter->nombre ?? 'No asignado' }}</h5>
                        @if ($kitten->shelter && $kitten->shelter->foto)
                            <img src="{{ asset('storage/shelters/' . $kitten->shelter->foto) }}" alt="{{ $kitten->shelter->nombre }}" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('img/icono_refugio.png') }}" alt="Foto por defecto" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                        <p><strong>Dirección:</strong> {{ $kitten->shelter->direccion ?? 'No disponible' }}</p>
                        <p><strong>Teléfono:</strong> {{ $kitten->shelter->telefono ?? 'No disponible' }}</p>
                        <p><strong>Correo:</strong> {{ $kitten->shelter->correo ?? 'No disponible' }}</p>
                        @if ($kitten->shelter && !empty($kitten->shelter->descripcion))
                            <p><strong>Descripción:</strong> {{ $kitten->shelter->descripcion }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Eventos Asociados -->
            <div class="carousel-item">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-success">Eventos Proximos</h5>
                        @if($events->isEmpty())
                            <p>No hay eventos asociados a este mishi o su refugio.</p>
                        @else
                            <ul>
                                @foreach($events as $event)
                                    <li>
                                        <h6>{{ $event->nombre }}</h6>
                                        <p><strong>Fecha:</strong> {{ $event->fecha }}</p>
                                        <p><strong>Descripción:</strong> {{ $event->descripcion }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- Controles del carrusel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#kittenDetailsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#kittenDetailsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
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
