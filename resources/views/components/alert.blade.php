<div class="alert alert-{{ $type }} alert-dismissible fade show position-fixed top-50 start-50 translate-middle w-50" id="autoDismissAlert" role="alert" style="z-index: 1050; border-radius: 10px; padding: 20px;">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<script>
    // Cerrar automáticamente la alerta después de 2 segundos
    setTimeout(function() {
        var alertElement = document.getElementById('autoDismissAlert');
        if (alertElement) {
            var alert = new bootstrap.Alert(alertElement);
            alert.close();
        }
    }, 2000); // 2000 ms = 2 segundos
</script>