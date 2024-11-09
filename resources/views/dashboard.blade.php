@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <style>
        /* Fondo semi-transparente */
        .semi-transparent-bg {
            background-color: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(0, 0, 0, 0.15);
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
    </style>
    <div class="background-video position-relative">
        <video class="position-fixed top-0 start-0 w-100 h-100 object-fit-cover" src="{{ asset('video/mishi_dash.mp4') }}" muted loop autoplay></video>
        <div class="container mt-5">
            <div class="text-center mb-5">
                <p class="display-7 title shadow p-6">
                    <strong>Conoce a nuestros mishis disponibles para adopción en MishiVet</strong>
                </p>
            </div>

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
                    <div class="carousel-inner rounded shadow-lg">
                        @foreach ($kittens->chunk(3) as $index => $kittenChunk)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="row">
                                    @foreach ($kittenChunk as $kittenIndex => $kitten)
                                        <div class="col-12 col-sm-6 col-md-4 mb-4 fade-in" style="animation-delay: {{ $kittenIndex * 0.3 }}s;">
                                            <div class="card shadow border-0 h-100 semi-transparent-bg">
                                                <a href="{{ route('dashboard.kittens.show', $kitten) }}" class="text-decoration-none text-dark">
                                                    <div class="text-center bg-dark text-white rounded-top p-2">
                                                        @if ($kitten->foto)
                                                            <img src="{{ asset('storage/kittens/' . $kitten->foto) }}" alt="{{ $kitten->nombre }}" class="card-img-top rounded-top img-fluid" style="height: 300px; object-fit: cover;">
                                                        @else
                                                            <img src="{{ asset('img/icono_mishi.png') }}" alt="Foto por defecto" class="card-img-top rounded-top img-fluid" style="height: 300px; object-fit: cover;">
                                                        @endif
                                                    </div>
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title text-danger fw-bold">{{ $kitten->nombre }}</h5>
                                                        <h6 class="card-subtitle mb-2 text-success font-italic">Refugio: {{ $kitten->shelter->nombre ?? 'No asignado' }}</h6>
                                                        <p class="card-text"><strong>Raza:</strong> {{ $kitten->raza }}</p>
                                                        <p class="card-text"><strong>Edad:</strong> {{ $kitten->edad }} {{ $kitten->edad == 1 ? 'año' : 'años' }}</p>
                                                        <p class="card-text"><strong>Sexo:</strong> {{ $kitten->sexo }}</p>
                                                        <p class="card-text"><strong>Estado:</strong> 
                                                            <span class="badge {{ $kitten->estado == 'Libre' ? 'badge-libre' : 'badge-ocupado' }}">{{ $kitten->estado }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="card-footer card-footer-custom text-center rounded-bottom">
                                                        <small><strong>Más detalles al hacer clic en la imagen</strong></small>
                                                    </div>
                                                </a>
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
                <div class="text-center mt-5 semi-transparent-bg p-5 rounded-3">
                    <h2 class="text-secondary">Bienvenido, Invitado</h2>
                    <p class="lead text-muted">Inicia sesión para ver a nuestros gatitos disponibles para adopción.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
