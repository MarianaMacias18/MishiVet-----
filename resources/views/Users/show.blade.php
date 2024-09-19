<!DOCTYPE html>
<html>
<div class="container">
    <h2>Iniciar Sesión</h2>
    <form action="{{ route('users.login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" class="form-control" required>
            <small class="form-text text-muted"></small>
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" class="form-control" minlength="8" required>
            <small class="form-text text-muted"></small>
        </div>

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" id="remember" name="remember" class="form-check-input">
                <label class="form-check-label" for="remember">Recordar contraseña</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>

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
</div>
</html>