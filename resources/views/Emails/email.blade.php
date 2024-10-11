<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Correo Electrónico - MishiVet</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f8ff; /* Fondo azul claro */
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #f8f9fa; /* Fondo gris claro para el contenedor */
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .header {
            text-align: center; /* Centra el texto del encabezado */
            padding: 20px 0;
            border-bottom: 2px solid #ff6b6b; /* Línea de separación en el encabezado */
            background-color: #f8d7da; /* Fondo suave para el encabezado */
            border-radius: 8px 8px 0 0; /* Bordes redondeados en la parte superior */
        }
        .header .icon {
            font-size: 100px; /* Tamaño del ícono */
            color: #dc3545; /* Color del ícono */
        }
        .header h1 {
            margin: 10px 0;
            color: #dc3545; /* Color del título */
            font-weight: bold;
            text-align: center; /* Centrar el texto */
        }
        .btn-primary {
            background-color: #dc3545; /* Color del botón */
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.3s ease; /* Transición suave para el fondo y la transformación */
        }
        .btn-primary:hover {
            background-color: #c82333; /* Color al pasar el mouse */
            transform: scale(1.05); /* Escala el botón ligeramente */
            box-shadow: 0 0 15px rgba(220, 53, 69, 0.7); /* Añade sombra para efecto de brillo */
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #6c757d;
        }
        .footer a {
            color: #dc3545; /* Color de los enlaces en el pie de página */
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .greeting {
            font-weight: bold;
            color: #333;
            margin-top: 20px;
            text-align: center; /* Centrar el texto */
            background-color: #e9ecef; /* Fondo gris claro para el saludo */
            padding: 10px;
            border-radius: 5px;
        }
        p {
            color: #555; /* Color del texto */
        }
        .date-info {
            font-size: 12px; /* Tamaño de la fecha */
            color: #6c757d; /* Color de la fecha */
            text-align: right; /* Alinear a la derecha */
        }
        .adoption-icons {
            font-size: 30px;
            color: #dc3545; /* Color de los íconos */
            margin: 10px 0;
        }
        .adoption-icons i {
            margin: 0 10px; /* Espaciado entre íconos */
        }
        .highlight {
            background-color: #ffeeba; /* Fondo amarillo suave para destacar */
            border-radius: 5px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-container text-center mb-2">
                <i class="fas fa-cat icon"></i> <!-- Ícono de gato de Font Awesome -->
            </div>
            <h1>¡Bienvenido a MishiVet!</h1>
        </div>
        <p class="greeting">¡Hola Mishi {{$user->name}}!</p>
        <p>Gracias por unirte a nuestra comunidad dedicada a la adopción de gatos. Tu registro es un paso importante para ayudar a estos adorables felinos a encontrar un hogar amoroso.</p>
        <p class="highlight">Para activar tu cuenta y acceder a todas nuestras funcionalidades, por favor confirma tu correo electrónico haciendo clic en el botón de abajo:</p>
        <div class="text-center">
            <a href="{{ $verificationUrl }}" class="btn btn-primary">
                Confirmar Correo Electrónico
            </a>
        </div>
        <br>
        <p>Si crees que no te has registrado en MishiVet, por favor ignora este mensaje.</p>
        
        <div class="adoption-icons text-center">
            <i class="fas fa-paw"></i> <!-- Ícono de pata de gato -->
            <i class="fas fa-heart"></i> <!-- Ícono de corazón -->
            <i class="fas fa-home"></i> <!-- Ícono de casa -->
        </div>

        <!-- Información de la fecha y hora -->
        <div class="date-info">
            <p>Enviado el: {{ date('d/m/Y') }} </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} MishiVet. Todos los derechos reservados.</p>
            <p><a href="#">Términos de Servicio</a></p>
        </div>
    </div>
</body>
</html>
