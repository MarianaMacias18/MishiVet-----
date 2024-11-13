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
        video {  /* Estilos para el video de fondo */
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            z-index: -1;
        }
        .form-container { /* Centrado del formulario y estilos diferenciados */
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
    <!-- Barra de navegación -->
    <x-navbar />
<!-- Contenedor del formulario -->
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
            <p class="text-dark">¿Tienes una cuenta? 
                <a href="{{ route('users.loginshow') }}" class="btn btn-link text-primary fw-bold">¡Inicia Sesión!</a>
            </p>
        </div>
        
    </div>
</div>

<!-- Video de fondo -->
<video src="{{ asset('video/pasto.mp4') }}" muted loop autoplay></video>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
