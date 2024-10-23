<style>
    /* Aumentar el ancho de la barra de búsqueda al hacer clic */
    .search-input {
        transition: width 0.4s ease;
        width: 150px; /* Ancho inicial */
    }

    .search-input:focus {
        width: 250px; /* Ancho al hacer clic */
        outline: none; /* Eliminar el contorno por defecto */
    }

    /* Estilo para resaltar los enlaces al pasar el mouse */
    .nav-link {
        transition: color 0.3s ease, background-color 0.3s ease, border 0.3s ease;
        padding: 0.375rem 0.75rem; /* Espaciado para el enlace */
        border-radius: 5px; /* Bordes redondeados */
        color: #ffc107; /* Color del texto por defecto */
    }

    .nav-link-bordered {
        border: 2px solid transparent; /* Contorno transparente por defecto */
    }

    .nav-link-bordered:hover {
        color: #ffc107; /* Cambia el color del texto al pasar el mouse */
        background-color: rgba(255, 255, 255, 0.2); /* Fondo menos transparente al pasar el mouse */
        border-color: #ffc107; /* Cambia el color del contorno */
        font-weight: bold; /* Hacer el texto en negrita */
    }

    .navbar-nav .nav-link {
        border: 2px solid transparent; /* Contorno transparente por defecto */
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-lg">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('mishivet') }}">
            @if (Auth::check())
                <img src="{{ asset('img/bonito.gif') }}" alt="Logo" class="rounded-circle" width="50" height="50">
                <span class="ms-2 logo-text text-info">Welcome {{ Auth::user()->name }}!</span>
            @else
                <img src="{{ asset('img/kittyWiggle.gif') }}" alt="Logo" class="rounded-circle" width="50" height="50">
                <span class="ms-2 logo-text">MishiVet</span>
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    @if (Auth::check())
                        <a class="nav-link nav-link-bordered text-warning btn btn-outline-warning" href="{{ route('dashboard.index') }}">Adopciones</a>
                    @else
                        <a class="btn btn-outline-info" href="{{ route('mishivet') }}">Mishi Inicio</a>
                    @endif
                </li>
            </ul>
            <form class="d-flex ms-3 search-form" role="search" onsubmit="return false;">
                <input id="searchInput" class="form-control me-2 search-input" type="search" placeholder="Buscar..." aria-label="Buscar" onclick="this.focus()">
                <button class="btn btn-outline-warning search-btn" type="button" onclick="searchInPage()">Buscar</button>
            </form>
        </div>
    </div>
</nav>

<!-- JavaScript para búsqueda en la página -->
<script>
    function searchInPage() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const bodyText = document.body.innerText.toLowerCase();

        if (input === "") {
            alert("Por favor ingresa un término de búsqueda.");
            return;
        }

        const matches = bodyText.includes(input);

        if (matches) {
            window.find(input);
        } else {
            alert("No se encontraron coincidencias.");
        }
    }
</script>
