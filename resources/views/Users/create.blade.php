<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos para la barra de navegación */
        .navbar {
            background-color: #2c2f33; /* Color de fondo de la barra */
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

        /* Centrado del formulario y estilos diferenciados */
        .form-container {
            background-color: white;
            padding: 40px;
            margin: 50px auto;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px; /* Limita el tamaño del formulario */
            position: relative; /* Para manejar los GIFs */
        }
        .gif-left {
            width: 250px;
            height: auto;
            position: absolute;
            bottom: -20px;
            left: 0; /* Posicionar a la izquierda */
            transform: translateX(0); /* No desplazar */
        }

        .gif-right {
            width: 250px;
            height: auto;
            position: absolute;
            bottom: -20px;
            right: 0; /* Posicionar a la derecha */
            transform: translateX(0); /* No desplazar */
        }

        .form-container {
            position: relative; /* Para que los GIFs se posicionen relativo a este contenedor */
            padding-bottom: 100px; /* Espacio adicional para los GIFs */
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
    <div class="form-container">
        <h2 class="text-center">Registro de Usuario</h2>
        
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" class="form-control" maxlength="60" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="apellidoP">Apellido Paterno:</label>
                <input type="text" id="apellidoP" name="apellidoP" class="form-control" maxlength="50" value="{{ old('apellidoP') }}" required>
                @if ($errors->has('apellidoP'))
                    <div class="text-danger">{{ $errors->first('apellidoP') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="apellidoM">Apellido Materno:</label>
                <input type="text" id="apellidoM" name="apellidoM" class="form-control" maxlength="50" value="{{ old('apellidoM') }}" required>
                @if ($errors->has('apellidoM'))
                    <div class="text-danger">{{ $errors->first('apellidoM') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" minlength="8" required>
                @if ($errors->has('password'))
                    <div class="text-danger">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" minlength="8" required>
                @if ($errors->has('password_confirmation'))
                    <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" class="form-control" value="{{ old('telefono') }}" required>
                @if ($errors->has('telefono'))
                    <div class="text-danger">{{ $errors->first('telefono') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <textarea id="direccion" name="direccion" class="form-control" rows="3" required>{{ old('direccion') }}</textarea>
                @if ($errors->has('direccion'))
                    <div class="text-danger">{{ $errors->first('direccion') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrar</button>
        </form>

        <div class="mt-3 text-center">
            <p>¿Tienes una cuenta? <a href="{{ route('users.loginshow') }}">¡Inicia Sesión!</a></p>
        </div>
    </div>

    <!-- Contenedor de GIFs -->
    <div class="gif-container">
        <img src="{{ asset('img/gift2.gif') }}" alt="" class="gif-left"> <!-- Gif a la izquierda -->
        <img src="{{ asset('img/gift2.gif') }}" alt="" class="gif-right"> <!-- Gif a la derecha -->
    </div>
</div>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
