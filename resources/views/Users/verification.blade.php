<!DOCTYPE html>
<html>
<head>
    <title>Verifica tu Correo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="my-4">Verificación de Correo Electrónico</h2>

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
        Antes de continuar, por favor revisa tu correo electrónico para verificar tu cuenta.
        Si no has recibido el correo electrónico,
        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">haz clic aquí para solicitar otro</button>.
        </form>
    </div>
    
</div>
</body>
</html>
