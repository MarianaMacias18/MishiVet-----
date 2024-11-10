<div class="container mt-5 position-relative">
    <!-- Modal de éxito -->
    @if (session('success'))
        <div class="modal fade show" id="successModal" tabindex="-1" role="dialog" style="display: block; background-color: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-success text-white rounded-4 shadow-lg border-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold">¡Mishi-éxito!</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="$('#successModal').modal('hide');"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-pill shadow-sm" data-bs-dismiss="modal" onclick="$('#successModal').modal('hide');">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Título -->
    <h1 class="text-center mb-4 text-warning fw-bold display-5">{{ $title }}</h1>

    <!-- Formulario con fondo transparente -->
    <form action="{{ $action }}" method="POST" class="p-4 rounded-4 shadow-lg bg-transparent position-relative" enctype="multipart/form-data" style="max-width: 700px; margin: auto; background-color: rgba(255, 255, 255, 0.7);">
        @csrf
        @method($method)

        {{ $slot }}
        <!-- Botón de envío estilizado -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success w-50 shadow rounded-pill">Guardar Cambios</button>
        </div>
    </form>

    <!-- Botones de navegación y eliminar -->
    <div class="mt-4 d-flex justify-content-center gap-3">
        <a href="{{ $backRoute }}" class="btn btn-outline-primary px-4 rounded-pill shadow-sm border-2 border-secondary">Volver</a>
        @if ($deleteAction)
            <form id="delete-form" action="{{ $deleteAction }}" method="POST" class="m-0">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger rounded-pill shadow-sm" id="delete-btn">
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
                event.preventDefault();
                if (confirm('¿Estás seguro de que deseas eliminar este {{ strtolower($title) }}? Esta acción no se puede deshacer.')) {
                    $('#delete-form').submit();
                }
            });
        @endif
    });
    // Función para mostrar la vista previa de la imagen cargada
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            const preview = document.getElementById('image-preview');
            preview.src = reader.result;
            preview.style.display = 'block'; // Muestra la imagen
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
