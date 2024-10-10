<div class="d-flex flex-column bg-dark sidebar" id="sidebar">
    <div class="p-3 text-white d-flex align-items-center justify-content-center position-relative">
        <span class="fs-4 logo-text text-warning">MishiVet</span> 
        <i class='bx bx-menu ms-auto' id="btn"></i>
    </div>

    <div id="sidebarContent">
        <ul class="nav flex-column">
            @foreach($sidebarOptions as $option)
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ $option['label'] === 'Volver a adopciones' ? 'text-warning' : 'text-white' }}" href="{{ route($option['route'], $option['params'] ?? []) }}">
                        <i class="{{ $option['icon'] }} bx-md"></i>
                        <span class="ms-3">{{ $option['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="logo-container text-center mb-2">
        <img src="{{ asset('img/Logo1.png') }}" alt="Logo" class="rounded-circle">
    </div>

    @if(request()->route()->getName() === 'dashboard.index') 
        <div class="text-warning text-center mt-1 fs-5 welcome-message"> 
            <strong>¡Welcome {{ $userName }}!</strong>
        </div>
    @endif

    <form action="{{ route('users.logout') }}" method="POST" class="mt-auto">
        @csrf
        <button class="btn btn-danger btn-sm logout-button" type="submit">
            <i class="bx bx-log-out"></i> Salir
        </button>
    </form>
</div>
