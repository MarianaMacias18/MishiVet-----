<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Registro de Usuario</h2>
    
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

        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
    <div class="mt-3">
        <p>¿Tienes una cuenta? <a href="{{ route('users.show') }}">¡Inicia Sesión!</a></p>
    </div>
</div>
</body>
</html>
