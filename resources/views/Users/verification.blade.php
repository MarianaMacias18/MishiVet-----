<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica tu Correo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa; /* Fondo gris claro */
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff; /* Fondo blanco para el contenedor */
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }
        h2 {
            text-align: center;
            color: #343a40; /* Color de título */
            margin-bottom: 20px;
        }
        .alert {
            border-radius: 5px;
            font-size: 16px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .alert-success {
            background-color: #d4edda; /* Fondo verde suave */
            color: #155724; /* Texto verde oscuro */
        }
        .alert-danger {
            background-color: #f8d7da; /* Fondo rojo suave */
            color: #721c24; /* Texto rojo oscuro */
        }
        .alert-info {
            background-color: #cce5ff; /* Fondo azul suave */
            color: #004085; /* Texto azul oscuro */
        }
        form {
            display: inline-block;
        }
        button {
            color: #007bff;
            text-decoration: underline;
            border: none;
            background: none;
            cursor: pointer;
        }
        button:hover {
            text-decoration: none;
            color: #0056b3; /* Cambia el color al pasar el ratón */
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #6c757d;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Verificación de Correo Electrónico</h2>

    <!-- Mostrar mensaje de éxito si existe -->
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

    <div class="alert alert-info">
        @if (session('user') && session('user')->name)
            Gracias por registrarte, {{ session('user')->name }}.
        @else
            Gracias por registrarte. Por favor verifica tu correo.
        @endif
        <p>Antes de continuar, revisa tu correo electrónico para verificar tu cuenta. Si no has recibido el correo electrónico, puedes solicitar otro:</p>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Haz clic aquí para solicitar otro</button>.
        </form>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} MishiVet. Todos los derechos reservados.</p>
    </div>
</div>
</body>
</html>
