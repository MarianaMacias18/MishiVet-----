<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <style>
        /* Para mantener visibles los íconos cuando se colapsa el sidebar */
        .sidebar {
            transition: width 0.3s ease;
            position: sticky;
            top: 0;
            height: 100vh;
            width: 250px;
        }

        .sidebar.open {
            width: 80px;
        }

        .sidebar .nav-link {
            color: white;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            transform: scale(1.05);
        }

        .sidebar .nav-link span {
            display: inline;
        }

        .sidebar.open .nav-link span {
            display: none;
        }

        .sidebar.open .bx-menu {
            display: none;
        }

        .sidebar.open .bx-menu-alt-right {
            display: inline;
        }

        .logo-container {
            text-align: center;
            margin: 50px 0;
        }

        .logo-container img {
            width: 80%;
            max-width: 180px;
        }

        .logo-text {
            color: white;
            font-weight: bold;
            transition: opacity 0.3s ease;
            text-align: center;
            width: 100%;
        }

        .sidebar.open .logo-text {
            opacity: 0;
            pointer-events: none;
        }

        .logout-button {
            width: 100%;
        }

        .main-content {
            overflow-y: auto;
            height: 100vh;
        }

        /* Botón de colapso fijo */
        #btn {
            position: absolute;
            top: 10px;
            right: -30px;
            background: #343a40;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            transition: right 0.3s ease;
            z-index: 1;
        }

        .sidebar.open #btn {
            right: -20px;
        }

        .welcome-message {
            transition: opacity 0.3s ease;
        }

        .sidebar.open .welcome-message {
            opacity: 0;
            pointer-events: none;
        }

        .text-dark-blue {
            color: #003879;
        }

        /* Media Queries para pantallas pequeñas */
        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                z-index: 1000;
                width: 100%;
            }

            .sidebar.open {
                width: 100%;
            }

            .main-content {
                margin-left: 0;
            }

            #btn {
                position: fixed;
                right: 10px;
                top: 10px;
            }

            .sidebar .nav-link {
                font-size: 14px;
            }
        }
    </style>
</head>

<body class="d-flex">
   
    <!-- Sidebar Componente Dinámico -->
    <x-sidebar />
   
    <!-- Main content -->
    <div class="flex-grow-1 main-content">
        <!-- Barra de navegación -->
        <x-navbar />
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
