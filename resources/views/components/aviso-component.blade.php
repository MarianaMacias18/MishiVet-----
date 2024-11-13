<div>
    <button type="button" class="btn btn-primary d-none" id="openModalBtn" data-bs-toggle="modal" data-bs-target="#avisoModal">
        Abrir Modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="avisoModal" tabindex="-1" aria-labelledby="avisoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="avisoModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ $mensaje }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{ $botonTexto }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para abrir el modal automáticamente -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('openModalBtn').click();
        });
    </script>
</div>