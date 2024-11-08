@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <style>
        .fade-in {
            opacity: 0;
            animation: fadeInAnimation 1s forwards;
        }

        @keyframes fadeInAnimation {
            to {
                opacity: 1;
            }
        }
    </style>
    <div class="text-center mb-5">
        <p class="display-7 text-white font-weight-bold shadow p-3 rounded bg-dark">
            <strong>Conoce a nuestros mishis disponibles para adopción en MishiVet</strong>
        </p>
    </div>
    <div class="container mt-5">
        @if(Auth::check())
            <!-- Mensajes de error y éxito -->
            @if (session('danger'))
                <x-alert type="danger" message="{{ session('danger') }}" class="alert alert-danger text-center shadow-lg" role="alert" />
            @endif
            @if (session('success'))
                <x-alert type="success" message="{{ session('success') }}" class="alert alert-success text-center shadow-lg" role="alert" />
            @endif

            <!-- Carrusel de gatos disponibles para adopción -->
            <div id="kittensCarousel" class="carousel slide mt-5" data-bs-ride="carousel">
                <div class="carousel-inner rounded shadow-lg" style="background-color: #f8f9fa;">
                    @foreach ($kittens->chunk(3) as $index => $kittenChunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($kittenChunk as $kittenIndex => $kitten)
                                    <div class="col-md-4 mb-4 fade-in" style="animation-delay: {{ $kittenIndex * 0.3 }}s;">
                                        <div class="card shadow border-0 h-100">
                                            <div class="text-center bg-light rounded-top">
                                                <a href="{{ route('dashboard.kittens.show', $kitten) }}">
                                                    @if ($kitten->foto)
                                                        <img src="{{ asset('storage/kittens/' . $kitten->foto) }}" alt="{{ $kitten->nombre }}" class="card-img-top rounded-top" style="width: 100%; height: 300px; object-fit: cover;">
                                                    @else
                                                        <img src="{{ asset('img/icono_mishi.png') }}" alt="Foto por defecto" class="card-img-top rounded-top" style="width: 100%; height: 300px; object-fit: cover;">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="card-body text-center" style="background-color: #f1f5f9;">
                                                <h5 class="card-title text-danger">{{ $kitten->nombre }}</h5>
                                                <h6 class="card-subtitle mb-2 text-success font-italic">Refugio: {{ $kitten->shelter->nombre ?? 'No asignado' }}</h6>
                                                <p class="card-text text-dark"><strong>Raza:</strong> {{ $kitten->raza }}</p>
                                                <p class="card-text text-dark"><strong>Edad:</strong> {{ $kitten->edad }} {{ $kitten->edad == 1 ? 'año' : 'años' }}</p>
                                                <p class="card-text text-dark"><strong>Sexo:</strong> {{ $kitten->sexo }}</p>
                                                <p class="card-text text-dark"><strong>Estado:</strong> 
                                                    <span class="badge {{ $kitten->estado == 'Libre' ? 'bg-info' : 'bg-warning' }}">{{ $kitten->estado }}</span>
                                                </p>
                                            </div>
                                            <div class="card-footer bg-primary text-white text-center rounded-bottom">
                                                <small>Más detalles al hacer clic en la imagen</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Controles de carrusel -->
                <button class="carousel-control-prev" type="button" data-bs-target="#kittensCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#kittensCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        @else
            <div class="text-center mt-5">
                <h2 class="text-secondary">Bienvenido, Invitado</h2>
                <p class="lead text-muted">Inicia sesión para ver a nuestros gatitos disponibles para adopción.</p>
            </div>
        @endif
    </div>
@endsection

