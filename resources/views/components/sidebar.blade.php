<div class="d-flex flex-column bg-dark sidebar" id="sidebar">
    <div class="p-3 text-white d-flex align-items-center justify-content-center position-relative">
        <span class="fs-4 logo-text text-warning">MishiVet</span> 
        <i class='bx bx-menu ms-auto' id="btn"></i>
    </div>

    <div id="sidebarContent">
        <ul class="nav flex-column">
            @foreach($sidebarOptions as $option)
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ $option['label'] === 'Volver a adopciones' ? 'text-warning' : 'text-white' }}" 
                       href="{{ route($option['route'], $option['params'] ?? []) }}">
                        @if ($option['label'] === 'Donaciones')
                             <i class="{{ $option['icon'] }} bx-md text-warning"></i> 
                        @else
                             <i class="{{ $option['icon'] }} bx-md text-info"></i> 
                        @endif
                        <span class="ms-3">{{ $option['label'] }}</span>

                        {{-- Mostrar conteos específicos en "Notificaciones" y "Notificaciones de Adopción" --}}
                        {{-- Notificaciones que recibe un "Usuario" de parte de un "Guardian" --}}
                        @if ($option['label'] === 'Notificaciones' && $guardianNotificationCount > 0)
                            <span class="badge bg-danger ms-3">{{ $guardianNotificationCount }}</span>
                        {{-- Notificaciones que recibe un "Guardian" de parte de un "Usuario" --}}
                        @elseif ($option['label'] === 'Notificaciones de Adopción' && $userNotificationCount > 0)
                            <span class="badge bg-danger ms-3">{{ $userNotificationCount }}</span>
                        @elseif ($option['label'] === 'Ser Guardian' && $userNotificationCount > 0)
                            <span class="badge bg-danger ms-4">{{ $userNotificationCount }}</span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="logo-container text-center mb-2">
        <img src="{{ asset('img/mishi_dance.gif') }}" alt="Logo" class="rounded-circle">
    </div>

    <form action="{{ route('users.logout') }}" method="POST" class="mt-auto">
        @csrf
        <button class="btn btn-danger btn-sm logout-button" type="submit">
            <i class="bx bx-log-out"></i> Cerrar Sesión 
        </button>
    </form>
</div>
