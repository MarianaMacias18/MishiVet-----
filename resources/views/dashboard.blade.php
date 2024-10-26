@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <div class="container mt-5">
        @if(Auth::check())
            <h2 class="text-center">Bienvenido a MishiVet, {{ Auth::user()->name }}</h2>

            <!-- Mensajes de error y éxito -->
            @if (session('danger'))
                <x-alert type="danger" message="{{ session('danger') }}" />
            @endif
            @if (session('success'))
                <x-alert type="success" message="{{ session('success') }}" />
            @endif

            <h3 class="mt-5">Mishis disponibles para adopción</h3>

            @if ($kittens->isEmpty())
                <x-aviso-component 
                    titulo="¡No hay gatos disponibles para adopción!" 
                    mensaje="Actualmente no hay gatos en adopción que no te pertenezcan dentro de MishiVet. ¡Vuelve más tarde!" 
                    botonTexto="Cerrar" 
                />
            @else
                <div class="row">
                    @foreach($kittens as $kitten)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="text-center">
                                    @if ($kitten->foto)
                                        <img src="{{ asset('storage/kittens/' . $kitten->foto) }}" alt="{{ $kitten->nombre }}" class="card-img-top" style="width: 100%; height: 300px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('img/icono_mishi.png') }}" alt="Foto por defecto" class="card-img-top" style="width: 100%; height: 300px; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $kitten->nombre }}</h5>
                                    <h6 class="card-subtitle mb-2 text-dark-blue">Refugio: {{ $kitten->shelter->nombre ?? 'No asignado' }}</h6>
                                    <p><strong>Raza:</strong> {{ $kitten->raza }}</p>
                                    <p><strong>Edad:</strong> {{ $kitten->edad }} años</p>
                                    <p><strong>Sexo:</strong> {{ $kitten->sexo }}</p>
                                    <p><strong>Color:</strong> {{ $kitten->color }}</p>
                                    @if (!empty($kitten->detalles))
                                        <p><strong>Detalles:</strong> {{ $kitten->detalles }}</p>
                                    @endif 
                                    <p><strong>Estado:</strong> {{ $kitten->estado }}</p>
                                    
                                    <!-- Botón para ver detalles centrado -->
                                    <div class="text-center mb-2">
                                        <a href="{{ route('dashboard.kittens.show', $kitten) }}" class="btn btn-primary btn-lg">Detalles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @else
            <h2 class="text-center">Bienvenido, Invitado</h2>
        @endif
    </div>
@endsection
