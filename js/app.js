
/**
 * Modal de eliminación dinámico
 * ----------------------------------------
 * - Captura el botón que abre el modal
 * - Obtiene data-id y data-nombre
 * - Los inyecta en el modal
 */
const deleteModal = document.getElementById('deleteModal');

if(deleteModal) {
    deleteModal.addEventListener('show.bs.modal', function (event) {

        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const nombre = button.getAttribute('data-nombre');

        // Asignar ID al input hidden
        deleteModal.querySelector('#delete-id').value = id;

        // Mostrar nombre en el modal
        deleteModal.querySelector('#delete-nombre').textContent = nombre;
    });
}

/**
 * Auto cierre de alertas (UX)
 * ----------------------------------------
 * - Busca todas las alertas Bootstrap
 * - Las cierra automáticamente después de 2 segundos
 */
setTimeout(() => {

    const alerts = document.querySelectorAll('.alert');

    // Evita ejecutar si no hay alertas
    if (!alerts.length) return;

    alerts.forEach(alert => {

        // Si Bootstrap está disponible
        if (typeof bootstrap !== 'undefined') {

            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            bsAlert.close();

        } else {
            // Fallback simple
            alert.style.display = 'none';
        }
    });

}, 2000);