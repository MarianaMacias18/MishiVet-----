<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos para la barra de navegación */
        .navbar {
            background-color:  #2c2f33; /* Color de fondo de la barra */
        }
        .navbar-brand img {
            width: 50px; /* Ajustar tamaño del logo */
            height: 50px; /* Ajustar tamaño del logo */
            margin-right: 10px; /* Espacio entre el logo y el texto */
            border-radius: 50%; /* Hacer que la imagen sea circular */
        }
        .logo-text {
            color: rgb(255, 223, 0); /* Color del texto MishiVet */
            font-weight: bold;
            font-size: 24px; /* Tamaño de la fuente */
        }
        .nav-link {
            color: rgb(255, 223, 0); /* Color de texto de los enlaces */
        }

        .nav-link:hover {
            color: white; /* Color de texto al pasar el mouse */
        }
        video { /* Estilos para el video de fondo */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .form-container { /* Centrar y estilizar el formulario */
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco semi-transparente */
            padding: 40px;
            margin: 0 auto; /* Ajuste para centrar el formulario */
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px; /* Limita el tamaño del formulario */
            z-index: 1; /* Asegura que el formulario esté por encima del video */
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('mishivet') }}">
                <img src="{{ asset('img/Logo1.png') }}" alt="Logo">
                <span class="logo-text">MishiVet</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mishivet') }}">Inicio</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenedor centrado para el formulario -->
    <div class="centered">
        <div class="col-md-6 col-lg-4 form-container">
            <h2 class="text-center my-4">Iniciar Sesión</h2>

            <!-- Mostrar mensajes -->
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('users.login') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control" minlength="1" required>
                </div>

                <div class="form-group mb-3 form-check">
                    <input type="checkbox" id="remember" name="remember" class="form-check-input">
                    <label class="form-check-label" for="remember">Mantener la sesión iniciada</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>

            <div class="mt-3 text-center">
                <a href="{{ route('login.github') }}" class="btn btn-dark w-100">
                    <i class="fab fa-github"></i> Iniciar sesión con GitHub
                </a>
            </div>

            <div class="mt-3 text-center">
                <p>¿No tienes una cuenta? <a href="{{ route('users.create') }}">Regístrate</a></p>
            </div>
        </div>
    </div>

    <!-- Video de fondo -->
    <video src="{{ asset('video/bigotes.mp4') }}" muted loop autoplay></video>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome para el ícono de GitHub -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>