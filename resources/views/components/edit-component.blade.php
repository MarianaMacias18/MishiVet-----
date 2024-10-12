<div class="container mt-5 position-relative">
    <!-- Modal de éxito -->
    @if (session('success'))
        <div class="modal fade show" id="successModal" tabindex="-1" role="dialog" style="display: block; background-color: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">¡Mishi-éxito!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="$('#successModal').modal('hide');"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ session('success') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#successModal').modal('hide');">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <h1 class="text text-center">{{ $title }}</h1>

    <form action="{{ $action }}" method="POST" class="p-4 border rounded shadow-sm bg-light position-relative" enctype="multipart/form-data">
        @csrf
        @method($method)

        {{ $slot }}
        <br>
        <div class="text-center">
            <button type="submit" class="btn btn-success">{{ $submitText }}</button>
        </div>
    </form>

    <div class="mt-3 text-center d-flex justify-content-center">
        <a href="{{ $backRoute }}" class="btn btn-outline-secondary me-2">Volver</a>
        @if ($deleteAction)
            <form id="delete-form" action="{{ $deleteAction }}" method="POST" class="m-0">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger" id="delete-btn">
                    Eliminar {{ strtolower($title) }}
                </button>
            </form>
        @endif
    </div>
</div>

<!-- jQuery y Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        @if (session('success'))
            $('#successModal').modal('show');
        @endif

        @if ($deleteAction)
            $('#delete-btn').on('click', function(event) {
                event.preventDefault(); // Prevenir el comportamiento por defecto del botón
                if (confirm('¿Estás seguro de que deseas eliminar este {{ strtolower($title) }}? Esta acción no se puede deshacer.')) {
                    $('#delete-form').submit();
                }
            });
        @endif
    });
</script>
