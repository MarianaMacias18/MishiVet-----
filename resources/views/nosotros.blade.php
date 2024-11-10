@extends('layout')

@section('title', 'Nosotros')

@section('content')
<div class="background-image" style="background-image: url('{{ asset('img/kittyWiggle.gif') }}');">
    <div class="container mt-5">
        <!-- Sección principal sobre nosotros -->
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h2 class="display-5 fw-bold">Sobre Nosotros</h2>
                <p class="lead mt-3">
                    En <strong class="text-warning">MishiVet</strong>, nos apasiona la <strong class="text-warning">adopción</strong> y el <strong class="text-warning">cuidado de gatitos</strong>. 
                    Somos una plataforma web comprometida en ayudar a estos pequeños felinos a encontrar un hogar lleno de amor. 
                    Además, contamos con contactos de una clínica veterinaria especializada para asegurar el bienestar y la salud de cada mishi.
                </p>
                <p>
                    Con años de experiencia y un equipo altamente capacitado, nuestros servicios veterinarios se enfocan en brindar 
                    atención de calidad, desde chequeos de rutina hasta tratamientos especializados. Creemos que cada gato merece 
                    un cuidado excepcional, por eso ponemos todo nuestro esfuerzo en garantizar su salud.
                </p>
                <p class="text-muted">
                    Si estás buscando adoptar un gatito o requieres atención veterinaria para el tuyo, <strong class="text-warning" >MishiVet</strong> 
                    está aquí para ti. ¡Tu mishi está en las mejores manos!
                </p>
            </div>
            <!-- Imagen de gatito -->
            <div class="col-md-6">
                <img src="{{ asset('img/gift3.gif') }}" alt="Adopción de Gatitos" >
            </div>
        </div>

        <!-- Sección de servicios destacados -->
        <div class="row text-center my-5">
            <h3 class="fw-bold mb-4">Nuestros Servicios</h3>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <i class="bx bxs-heart bx-lg text-danger"></i>
                        <h4 class="card-title mt-3">Adopción</h4>
                        <p class="card-text">Ayudamos a gatitos sin hogar a encontrar familia.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <i class="bx bxs-clinic bx-lg text-success"></i>
                        <h4 class="card-title mt-3">Ser Guardian</h4>
                        <p class="card-text">Ser guardian de michis.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <i class="bx bxs-cat bx-lg text-warning"></i>
                        <h4 class="card-title mt-3">Consultas Especializadas</h4>
                        <p class="card-text">Contactos especificos para el cuidado de tu felino.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de contacto -->
        <div class="bg-light p-5 rounded mt-5">
            <h3 class="fw-bold">Contacto</h3>
            <p><i class="bx bx-phone"></i> Teléfono: 33-22-11-44-55</p>
            <p><i class="bx bx-envelope"></i> Correo de contacto: mishivet@gmail.com</p>
            <p><i class="bx bx-map"></i> Dirección: Calle de los Michis 123, Ciudad Gatuna</p>
        </div>
    </div>
</div>
@endsection
