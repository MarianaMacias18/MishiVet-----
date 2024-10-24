<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="preload" href="{{ asset('css/welcome.css') }}" as="style">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        .text h2, 
        .text h3,
        .text p i, 
        .text p:last-of-type { 
            color: #FFD700; /* Color amarillo */
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
            <p>MishiVet es una plataforma web que permite la adopción de gatitos contando con una clínica veterinaria dedicada a su cuidado y bienestar, ofreciendo servicios de calidad 
                para garantizar la salud de tus mishis.</p>
            <p>Contacto: 33-22-11-44-55</p>
            <p>Correo de contacto: <i>mishivet@gmail.com</i></p>
            <p>© Copyright todos los derechos reservados.</p>
            <a href="{{route('users.login')}}">¡Conoce MishiVet!</a>
        </div>
        <ul class="social">
            <li><a href="#"><img src="https://i.ibb.co/x7P24fL/facebook.png"></a></li>
            <li><a href="#"><img src="https://i.ibb.co/Wnxq2Nq/twitter.png"></a></li>
            <li><a href="#"><img src="https://i.ibb.co/ySwtH4B/instagram.png"></a></li>
        </ul>
    </section>
    <script src="{{ asset('js/welcome.js') }}"></script>
</body>
</html>
