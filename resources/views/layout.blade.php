<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/887a835504.js" crossorigin="anonymous"></script>
    <style>
        /* Para mantener visibles los íconos cuando se colapsa el sidebar */
        .sidebar {
            transition: width 0.3s ease;
        }

        .sidebar.open {
            width: 80px; /* Ancho cuando está colapsado */
        }

        .sidebar .nav-link span {
            display: inline; /* Texto visible por defecto */
        }

        .sidebar.open .nav-link span {
            display: none; /* Texto oculto cuando está colapsado */
        }

        .sidebar.open .bx-menu {
            display: none; /* Ocultar icono del menú cuando está abierto */
        }

        .sidebar.open .bx-menu-alt-right {
            display: inline; /* Mostrar icono alternativo cuando está abierto */
        }

        /* Estilos para el logo */
        .logo-container {
            text-align: center;
            margin: 50px 0; /* Margen superior e inferior */
        }

        .logo-container img {
            width: 80%; /* Ajustar el tamaño del logo */
            max-width: 180px; /* Ancho máximo del logo */
        }

        /* Estilos para el botón de salir */
        .logout-button {
            width: 100%; /* Hacer que el botón ocupe todo el ancho */
        }
    </style>
</head>

<body class="d-flex">

    <!-- Sidebar -->
    <div class="d-flex flex-column bg-dark vh-100 sidebar" id="sidebar" style="width: 250px;">
        <div class="p-3 text-white d-flex align-items-center">
            <span class="fs-4">MishiVet</span>
            <!-- Toggle button for expanding/collapsing sidebar -->
            <i class='bx bx-menu ms-auto' id="btn"></i>
        </div>

        <!-- Collapsible sidebar content -->
        <div id="sidebarContent">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="{{ route('dashboard.index') }}">
                        <i class='bx bx-home'></i>
                        <span class="ms-2">Adopciones</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="{{ route('dashboard.index') }}">
                        <i class='bx bxs-castle'></i>
                        <span class="ms-2">Ser Guardian</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="{{ route('dashboard.index') }}">
                        <i class='bx bx-notification'></i>
                        <span class="ms-2">Notificaciones</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="{{ route('users.show', Auth::user()->name) }}">
                        <i class='bx bx-user'></i>
                        <span class="ms-2">Perfil</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="{{ route('dashboard.nosotros') }}">
                        <i class='bx bx-info-circle'></i>
                        <span class="ms-2">Nosotros</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Logo debajo de "Nosotros" -->
        <div class="logo-container">
            <img src="{{ asset('img/Logo1.png') }}" alt="Logo" class="rounded-circle">
        </div>

        <!-- Footer with logout button -->
        <form action="{{ route('users.logout') }}" method="POST" class="mt-auto">
            @csrf
            <button class="btn btn-danger btn-sm logout-button" type="submit">
                <i class="bx bx-log-out"></i> Salir
            </button>
        </form>
    </div>

    <!-- Main content -->
    <div class="flex-grow-1">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript para manejar el colapso y la expansión del sidebar
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange(); // Llamando a la función para cambiar el icono
        });

        // Función para cambiar el icono del botón
        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); // Reemplazar icono
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); // Reemplazar icono
            }
        }
    </script>
</body>

</html>
