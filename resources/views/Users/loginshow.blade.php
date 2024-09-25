<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <h2 class="text-center my-4">Iniciar Sesión</h2>

                <!-- Mostrar mensaje de éxito al eliminar perfil -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form action="{{ route('users.login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                        <small class="form-text text-muted"></small>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" class="form-control" minlength="1" required>
                        <small class="form-text text-muted"></small>
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
                    <p>¿No tienes una cuenta? <a href="{{ route('users.create') }}">Regístrate</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
