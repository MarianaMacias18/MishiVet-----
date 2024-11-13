@extends('layout')

@section('title', 'Ver Mishi en Adopción')

@section('content')
<div class="background-video position-relative">
    <!-- Video de fondo -->
    <video class="position-fixed top-0 start-0 w-100 h-100 object-fit-cover" src="{{ asset('video/adopciones.mp4') }}" muted loop autoplay></video>
    <div class="container mt-5 position-relative z-index-2">
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

        <h2 class="text-center mb-4 text-dark"><strong>Detalles del mishi <span class="text-danger">{{ $kitten->nombre }}</strong></span></h2>

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
                                <p>No hay eventos asociados a este mishi o su refugio.</p>
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
@endsection
