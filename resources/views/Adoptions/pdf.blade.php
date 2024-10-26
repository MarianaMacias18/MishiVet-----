<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Adopción - {{ $kittens->nombre }}</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            color: #343a40;
            margin: 0;
            padding: 10px;
            box-sizing: border-box;
        }
        .pdf-container {
            width: 90%; /* Reduce el ancho general */
            max-width: 750px; /* Ajusta el ancho máximo */
            margin: auto;
            padding: 15px; /* Reduce el padding interior */
            border: 1px solid #000; /* Disminuye el grosor de la línea */
            border-radius: 8px;
            page-break-inside: avoid;
        }
        .header {
            display: flex;
            align-items: center;
            flex-direction: column;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 8px; /* Ajusta el espaciado inferior */
            margin-bottom: 15px; /* Reduce el margen inferior */
        }
        .header-logo {
            width: 60px; /* Reduce el tamaño del logo */
            height: auto;
            margin-bottom: 8px; 
        }
        .header-info {
            text-align: center;
        }
        .header-info h1 {
            font-size: 1.5rem; /* Reduce tamaño de MishiVet */
            color: red;
            margin: 0;
        }
        .header-info h2 {
            font-size: 1rem; /* Reduce el tamaño del subtítulo */
            color: black;
            margin: 0;
        }
        .subheader {
            font-size: 0.8rem;
            text-align: right;
            color: #6c757d;
        }
        .card {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 10px; /* Reduce padding */
            margin: 5px 0; /* Reduce margen */
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }
        .card-header {
            font-size: 1.1rem; /* Reduce el tamaño */
            font-weight: bold;
            color: #007bff;
            text-align: center;
            margin-bottom: 8px;
        }
        .img-thumbnail {
            border-radius: 50%;
            width: 90px; /* Reduce el tamaño de las imágenes */
            height: 90px;
            object-fit: cover;
            display: block;
            margin: 0 auto 10px;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            padding: 3px 8px;
            font-size: 0.8rem;
            border-radius: 0.2rem;
            color: #fff;
            background-color: #28a745;
        }
        .info-row {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            gap: 8px;
        }
        .info-label {
            font-weight: bold;
            color: #495057;
            font-size: 0.9rem; /* Ajuste de tamaño de texto */
        }
        .info-value {
            color: #212529;
            font-size: 0.9rem; /* Ajuste de tamaño de texto */
        }
    </style>
</head>
<body>
    <div class="pdf-container">
        <!-- Header -->
        <div class="header">
            <div class="header-info">
                <img src="{{ public_path('img/Logo1.png') }}" alt="Logo MishiVet" class="rounded-circle img-fluid mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                <h1>MishiVet</h1>
                <h2>Adopción y cuidado de tus Mishis</h2>
                <p><strong> Contáctanos: </strong>mishivet@gmail.com</p>
                <p><strong>Fecha de generación de reporte: </strong>{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
            </div>
        </div>
        <!-- Información del Mishi -->
        <div class="card">
            <div class="card-header">Información del Mishi <span style="color: red;">{{$kittens->nombre}}</span></div>
            <div class="text-center">
                @if ($kittens->foto)
                    <img src="{{ public_path('storage/kittens/' . $kittens->foto) }}" alt="{{ $kittens->nombre }}" class="img-thumbnail">
                @else
                    <img src="{{ public_path('img/icono_mishi.png') }}" alt="Foto por defecto" class="img-thumbnail">
                @endif
            </div>
            <div class="info-row">
                <span class="info-label">Raza:</span><span class="info-value"> {{ $kittens->raza }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Edad en años:</span><span class="info-value"> {{ $kittens->edad }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Sexo:</span><span class="info-value"> {{ $kittens->sexo }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Color:</span><span class="info-value"> {{ $kittens->color }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Detalles del Mishi:</span><span class="info-value"> {{ $kittens->detalles }}</span>
            </div>
            <br>
            <div class="info-row">
                <span class="info-label">Estado actual del Mishi:</span><span class="info-value badge"> <strong>{{ $kittens->estado }} <-</strong></span>
            </div>
        </div>

        <!-- Información del Refugio -->
        <div class="card">
            <div class="card-header">Información del Refugio Asociado  <span style="color: red;">{{$shelters->nombre}}</span><</div>
            <div class="text-center">
                @if ($shelters->foto)
                    <img src="{{ public_path('storage/shelters/' . $shelters->foto) }}" alt="{{ $shelters->nombre }}" class="img-thumbnail">
                @else
                    <img src="{{ public_path('img/icono_refugio.png') }}" alt="Foto por defecto" class="img-thumbnail">
                @endif
            </div>
            <div class="info-row">
                <span class="info-label">Dirección:</span><span class="info-value"> {{ $shelters->direccion }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Teléfono:</span><span class="info-value"> {{ $shelters->telefono }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Correo:</span><span class="info-value"> {{ $shelters->correo }}</span>
            </div>
        </div>
    </div>
</body>
</html>
