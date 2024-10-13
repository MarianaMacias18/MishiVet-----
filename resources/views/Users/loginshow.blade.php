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

        .gif {
            width: 250px;
            height: auto; /* Mantener la proporción */
            
           
            position: absolute; /* Posición absoluta */
            bottom: -20px; /* Ajustar la distancia desde el contenedor */
            left: 130%; /* Centrar horizontalmente */
            transform: translateX(-50%); /* Compensar el desplazamiento del ancho del GIF */
        }

        .form-container {
            position: relative; /* Para que el GIF se posicione relativo a este contenedor */
            padding-bottom: 50px; /* Espacio adicional para el GIF */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('mishivet.blade.php') }}">
                <img src="{{ asset('img/Logo1.png') }}" alt="Logo">
                <span class="logo-text">MishiVet</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- Alineación a la derecha -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('mishivet.blade.php') }}">Inicio</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 form-container">
                <h2 class="text-center my-4">Iniciar Sesión</h2>

                <!-- Mostrar mensaje de éxito al eliminar perfil -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Mostrar mensaje de error si existe -->
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
                <form action="{{ route('users.login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="email">Correo Electrónicogeto:</label>
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

                <!-- Botón de inicio de sesión con GitHub -->
                <div class="mt-3 text-center">
                    <a href="{{ route('login.github') }}" class="btn btn-dark w-100">
                        <i class="fab fa-github"></i> Iniciar sesión con GitHub
                    </a>
                </div>

                <div class="mt-3 text-center">
                    <p>¿No tienes una cuenta? <a href="{{ route('users.create') }}">Regístrate</a></p>
                </div>
                <img src="{{ asset('img/kittyWiggle.gif') }}" alt="" class="gif"> <!-- Añadido el class="gif" aquí -->
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome para el ícono de GitHub -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
