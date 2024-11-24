@extends('layout')

@section('title', 'Ver Mishi en Adopción')

@section('content')
<div class="background-video position-relative">
    <!-- Video de fondo -->
    <video class="position-fixed top-0 start-0 w-100 h-100 object-fit-cover" src="{{ asset('video/adopciones.mp4') }}" muted loop autoplay></video>
    <div class="container mt-5 position-relative z-index-2">
        <!-- Modal de éxito -->
        @if (session('success'))
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-success text-white rounded-4 shadow-lg border-0">
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-bold" id="successModalLabel">¡Mishi-éxito!</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-light rounded-pill shadow-sm" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <h2 class="text-center mb-4 text-white"><strong>Detalles del mishi <span class="text-white">{{ $kitten->nombre }}</strong></span></h2>

        <!-- Carrusel -->
        <div id="kittenDetailsCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded shadow-lg bg-transparent" style="background-color: rgba(255, 255, 255, 0.75);">
                
                <!-- Detalles del Mishi -->
                <div class="carousel-item active">
                    <div class="row mb-4">
                        <div class="col-12 col-md-6">
                            <div class="card shadow-sm" style="background-color: rgba(255, 255, 255, 0.75);">
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
                        <div class="col-12 col-md-6">
                            <div class="card shadow-sm" style="background-color: rgba(255, 255, 255, 0.75);">
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
                                        <div class="mt-2">
                                            <a href="{{ route('dashboard.donate', $kitten) }}" class="btn btn-danger">
                                                Donar al Refugio
                                            </a>
                                        </div>
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
                    <div class="card shadow-sm" style="background-color: rgba(255, 255, 255, 0.75);">
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
                <div class="carousel-item style="background-color: rgba(255, 255, 255, 0.75);"">
                        <div class="card-body">
                            @if($events->isEmpty())
                                <div class="alert alert-info text-center shadow-sm">
                                    <strong>No hay eventos en los que el refugio del mishi participe por el momento.</strong>
                                </div>
                            @else
                                @foreach($events as $event)
                                    <div class="mb-3 p-3 border rounded" style="background-color: rgba(255, 255, 255, 0.9);">
                                        <h5 class="card-title text-success"><strong>Evento Próximo</strong></h5><br>
                                        <h6 class="text-primary">{{ $event->nombre }}</h6>
                                        <p><strong>Fecha:</strong> {{ $event->fecha }}</p>
                                        <p><strong>Descripción:</strong> {{ $event->descripcion }}</p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                </div>
            </div>

            <!-- Controles del carrusel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#kittenDetailsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#kittenDetailsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
    <!-- Script para abrir el modal si hay un mensaje de éxito -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success'))
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            @endif
        });
    </script>
@endsection
