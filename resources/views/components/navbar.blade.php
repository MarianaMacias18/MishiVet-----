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

    /* Estilo para centrar el label y el select */
    .filter-container {
        display: flex;
        align-items: center; /* Centra los elementos verticalmente */
        margin-left: 1rem; /* Espaciado entre elementos */
    }

    /* Espaciado para el botón de búsqueda y el filtro */
    .search-form {
        margin-left: 1rem; /* Espaciado entre elementos */
    }

    /* Espaciado para el texto del filtro */
    .filter-text {
        margin-right: 0.5rem; /* Espaciado a la derecha para alinear con el botón */
        color: #ffc107; /* Color del texto */
        text-align: center; /* Centra el texto */
    }

    /* Mejora de la responsividad para pantallas pequeñas */
    @media (max-width: 768px) {
        .navbar-nav {
            flex-direction: column; /* Hacer que los enlaces de navegación se apilen */
            text-align: center; /* Alinear los enlaces al centro */
        }

        .search-form {
            width: 100%; /* Hacer que el formulario de búsqueda ocupe todo el ancho */
            margin-top: 1rem;
        }

        .filter-container {
            flex-direction: column; /* Los filtros también deben apilarse en pantallas pequeñas */
            margin-left: 0;
            margin-top: 1rem;
        }

        .filter-text {
            margin-right: 0; /* Quitar margen derecho en pantallas pequeñas */
        }
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
            <form class="d-flex search-form" role="search" onsubmit="return false;">
                <input id="searchInput" class="form-control me-2 search-input" type="search" placeholder="Buscar..." aria-label="Buscar" onclick="this.focus()">
                <button class="btn btn-outline-warning search-btn" type="button" onclick="searchInPage()">Buscar</button>
            </form>

            <!-- Filtro de estado dentro de la navbar solo en la ruta "kittens.index" -->
            @if (request()->routeIs('kittens.index'))
                <div class="ms-3 filter-container">
                    <label for="estadoFiltro" class="filter-text mb-0">Filtrar por Estado</label>
                    <select id="estadoFiltro" class="form-select" onchange="filtrarKittens()">
                        <option value="todos">Todos</option>
                        <option value="libre">Libre</option>
                        <option value="apartado">Apartado</option>
                        <option value="adoptado">Adoptado</option> 
                    </select>
                </div>
            @endif
            @if (request()->routeIs('dashboard.index'))
                <div class="ms-3 filter-container">
                    <label for="estadoFiltro" class="filter-text mb-0">Filtrar por Estado</label>
                    <select id="estadoFiltro" class="form-select" onchange="filtrarKittens()">
                        <option value="todos">Todos</option>
                        <option value="libre">Libre</option>
                        <option value="apartado">Apartado</option>
                    </select>
                </div>
            @endif
            @if (request()->routeIs('events.index'))
                <div class="ms-3 filter-container">
                    <label for="dateFilter" class="filter-text mb-0">Fecha</label>
                    <input type="date" id="dateFilter" class="form-control" onchange="filtrarEventos()">
                </div>
                <div class="ms-3 filter-container">
                    <label for="monthFilter" class="filter-text mb-0">Mes</label>
                    <select id="monthFilter" class="form-select" onchange="filtrarEventos()">
                        <option value="">Todos</option>
                        @foreach (range(1, 12) as $month)
                            <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                {{ ucfirst(\Carbon\Carbon::create()->locale('es')->month($month)->translatedFormat('F')) }}
                            </option>
                        @endforeach
                    </select>
                </div>
           @endif
           @if (request()->routeIs('dashboard.notificaciones'))
                <div class="ms-3 filter-container">
                    <label for="filterDate" class="filter-text mb-0">Filtrar por Fecha</label>
                    <input type="date" id="filterDate" class="form-control" onchange="filterByDate()">
                </div>
            @endif
        </div>
    </div>
</nav>

<!-- JavaScript para búsqueda en la página con desplazamiento automático -->
<script>
    function searchInPage() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const bodyText = document.body.innerText.toLowerCase();

        if (input === "") {
            alert("Por favor ingresa un término de búsqueda.");
            return;
        }

        // Intentamos encontrar la coincidencia en el texto de la página
        const matches = bodyText.includes(input);

        if (matches) {
            // Usamos window.find() para resaltar la coincidencia
            const found = window.find(input);
            
            if (found) {
                // Obtenemos todos los nodos de texto
                const allElements = document.querySelectorAll('*');

                // Iteramos para encontrar el elemento que contiene el texto buscado
                allElements.forEach(element => {
                    if (element.innerText && element.innerText.toLowerCase().includes(input)) {
                        // Desplazamos hacia el elemento que contiene la coincidencia
                        element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        return;
                    }
                });
            }
        } else {
            alert("No se encontraron coincidencias.");
        }
    }

    function filtrarKittens() {
        // Obtener el valor seleccionado del filtro
        const filtro = document.getElementById('estadoFiltro').value;

        // Obtener todas las tarjetas de gatos
        const kittens = document.querySelectorAll('.card');

        // Recorrer cada tarjeta y mostrar/ocultar según el estado
        kittens.forEach(kitten => {
            const estadoElement = Array.from(kitten.querySelectorAll('p')).find(p => p.textContent.startsWith('Estado:'));

            // Verifica si se encontró el elemento
            if (!estadoElement) {
                console.error("No se encontró el elemento del estado en este kitten.");
                return; // Salir de la iteración actual
            }
        
            const estado = estadoElement.textContent.split(': ')[1].trim(); // Extrae el estado
            const estadoNormalizado = estado.toLowerCase(); // Normaliza el estado
            const filtroNormalizado = filtro.toLowerCase(); // Normaliza el filtro
        
            // Debugging
            console.log(`Estado Normalizado: ${estadoNormalizado}, Filtro Normalizado: ${filtroNormalizado}`);
        
            // Verificar el filtro
            if (filtro === 'todos' || estadoNormalizado === filtroNormalizado) {
                kitten.parentElement.style.display = 'block'; // Muestra la tarjeta
            } else {
                kitten.parentElement.style.display = 'none'; // Oculta la tarjeta
            }
        });
    }
    
    function filtrarEventos() {
        const fechaSeleccionada = document.getElementById('dateFilter').value; // Obtiene la fecha seleccionada
        const mesSeleccionado = document.getElementById('monthFilter').value; // Obtiene el mes seleccionado
        const eventos = document.querySelectorAll('.event-card'); // Obtiene todas las tarjetas de evento
    
        eventos.forEach(evento => {
            const fechaEvento = evento.querySelector('.event-date').getAttribute('data-fecha'); // Obtiene la fecha del evento en formato YYYY-MM-DD HH:MM
            const mesEvento = fechaEvento.split('-')[1]; // Obtiene el mes de la fecha del evento
    
            // Verificar el filtro
            const esFechaValida = fechaSeleccionada === '' || fechaEvento.startsWith(fechaSeleccionada);
            const esMesValido = mesSeleccionado === '' || mesEvento === mesSeleccionado;
    
            if (esFechaValida && esMesValido) {
                evento.style.display = 'block'; // Muestra el evento si coincide
            } else {
                evento.style.display = 'none'; // Oculta el evento si no coincide
            }
        });
    }
    function filtrarNotificaciones() {
        const fechaSeleccionada = document.getElementById('filterDate').value; // Obtiene la fecha seleccionada
        const notificaciones = document.querySelectorAll('.notification-card'); // Cambia esto según la clase de tus tarjetas de notificación
    
        notificaciones.forEach(notificacion => {
            const fechaNotificacion = notificacion.querySelector('.notification-date').getAttribute('data-fecha'); // Asegúrate de que esto coincida con el atributo que almacena la fecha
    
            if (fechaSeleccionada === '' || fechaNotificacion.startsWith(fechaSeleccionada)) {
                notificacion.style.display = 'block'; // Muestra la notificación si coincide
            } else {
                notificacion.style.display = 'none'; // Oculta la notificación si no coincide
            }
        });
    }
</script>
