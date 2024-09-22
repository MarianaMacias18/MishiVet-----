<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    @if(Auth::check())
        <h2>Bienvenido a MishiVet, {{ Auth::user()->name }}</h2>
        <div class="mt-3 text-center">
            <p><a href="{{ route('users.edit', Auth::user()->name) }}">Perfil</a></p>
        </div>
        
        <!-- Formulario de Logout -->
        <form action="{{ route('users.logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
    @else
        <h2>Bienvenido, Invitado</h2>
    @endif
</body>
</html>
