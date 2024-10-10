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
            transition: width 0.3s ease; /* Transición suave para el ancho */
            position: sticky; /* Para que el sidebar se mantenga en su posición */
            top: 0; /* Mantener el sidebar en la parte superior al hacer scroll */
            height: 100vh; /* Ajustar altura automáticamente */
            width: 250px; /* Ancho inicial del sidebar */
        }
    
        .sidebar.open {
            width: 80px; /* Ancho cuando está colapsado */
        }
    
        .sidebar .nav-link {
            color: white; /* Color de texto por defecto */
            transition: all 0.3s ease; /* Transición suave para todos los cambios */
        }
    
        .sidebar .nav-link:hover {
            color: white; /* Color al pasar el mouse */
            background-color: rgba(255, 255, 255, 0.1); /* Fondo al pasar el mouse */
            transform: scale(1.05); /* Efecto de aumento al pasar el mouse */
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
    
        /* Estilos para el texto de MishiVet */
        .logo-text {
            color: white; /* Color del texto */
            font-weight: bold; /* Hacer el texto más fuerte */
            transition: opacity 0.3s ease; /* Transición suave */
            text-align: center; /* Centrar el texto */
            width: 100%; /* Hacer que el texto ocupe todo el ancho */
        }
    
        .sidebar.open .logo-text {
            opacity: 0; /* Ocultar el texto cuando el sidebar está colapsado */
            pointer-events: none; /* Evitar clics en el texto */
        }
    
        /* Estilos para el botón de salir */
        .logout-button {
            width: 100%; /* Hacer que el botón ocupe todo el ancho */
        }
    
        /* Asegurarse de que el contenido principal sea scrollable */
        .main-content {
            overflow-y: auto; /* Permitir scroll vertical */
            height: 100vh; /* Ajustar la altura para el scroll */
        }
    
        /* Botón de colapso fijo */
        #btn {
            position: absolute; /* Posición absoluta para que esté siempre visible */
            top: 10px; /* Margen desde la parte superior */
            right: -30px; /* Margen desde el borde derecho para que sea visible */
            background: #343a40; /* Color de fondo para el botón */
            border-radius: 50%; /* Hacer que el botón sea redondo */
            color: white; /* Color del icono */
            cursor: pointer; /* Cambiar cursor al pasar el mouse */
            transition: right 0.3s ease; /* Transición suave para la posición */
            z-index: 1; /* Asegurarse de que esté por encima de otros elementos */
        }
    
        .sidebar.open #btn {
            right: -20px; /* Ajustar la posición cuando el sidebar está colapsado */
        }
                /* Estilos para el texto de bienvenida */
        .welcome-message {
            transition: opacity 0.3s ease; /* Transición suave para el texto */
        }

        .sidebar.open .welcome-message {
            opacity: 0; /* Ocultar el texto cuando el sidebar está colapsado */
            pointer-events: none; /* Evitar clics en el texto */
        }
    </style>
</head>

<body class="d-flex">

    <!-- Sidebar Componente Dinámico -->
    <x-sidebar />

    <!-- Main content -->
    <div class="flex-grow-1 main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });

        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
            }
        }
    </script>
</body>

</html>
