<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Preload del archivo CSS -->
    <link rel="preload" href="{{ asset('css/welcome.css') }}" as="style">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

    <!-- Font Awesome para los íconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Estilos generales de texto */
        .text h2, 
        .text h3,
        .text p i, 
        .text p:last-of-type { 
            color: #FFD700; /* Color amarillo */
            transition: transform 0.3s ease, font-size 0.3s ease; /* Suaviza el cambio de tamaño */
        }

        /* Al pasar el mouse sobre h2 (ADOPCIÓN) y h3 (Y CUIDADO DE GATOS), disminuye el tamaño del texto */
        .text h2:hover, 
        .text h3:hover {
            transform: scale(1.2); /* disminuye el tamaño */
            font-size: 2.5em; /* disminuye el tamaño de la fuente */
        }

        /* Tamaño inicial del ícono de WhatsApp */
        .whatsapp-icon {
            font-size: 24px;
            color: #25D366; 
            transition: transform 0.3s ease; 
            margin-right: 10px; 
        }

        /* Efecto al pasar el mouse por encima del ícono */
        .whatsapp-icon:hover {
            transform: scale(1.5); /* Aumenta el tamaño del ícono */
        }
    </style>
</head>
<body>
    <section class="showcase">
        <header>
            <h2 class="logo">MishiVet</h2>
            <div class="container">
                <nav>
                    <a href="{{route('users.login')}}">Iniciar sesión</a>
                    <a href="{{route('users.create')}}">Registrarse</a>
                </nav>
            </div>
        </header>

        <video src="{{ asset('video/mishi.mp4') }}" muted loop autoplay></video>
        <div class="overlay"></div>

        <div class="text">
            <h2><i>ADOPCIÓN</i></h2>
            <h3><i>Y CUIDADO DE GATOS</i></h3>
            <p>MishiVet es una plataforma web que permite la adopción de gatitos contando con una clínica veterinaria dedicada a su cuidado y bienestar, ofreciendo servicios de calidad para garantizar la salud de tus mishis.</p>
            <p>
                <!-- Ícono de WhatsApp junto a Contacto -->
                <i class="fab fa-whatsapp whatsapp-icon"></i> Contacto: 33-22-11-44-55
            </p>
            <p>Correo de contacto: <i>mishivet@gmail.com</i></p>
            <p>© Copyright todos los derechos reservados.</p>
            <a href="{{route('users.login')}}">¡Conoce MishiVet!</a>
        </div>

        <ul class="social">
            <li><a href="https://www.facebook.com/"><img src="https://i.ibb.co/x7P24fL/facebook.png"></a></li>
            <li><a href="https://x.com/"><img src="{{ asset('img/x_logo.png') }}" alt="X Icon"></a></li>
            <li><a href="https://www.instagram.com/"><img src="https://i.ibb.co/ySwtH4B/instagram.png"></a></li>
        </ul>
    </section>

    <script src="{{ asset('js/welcome.js') }}"></script>
</body>
</html>
