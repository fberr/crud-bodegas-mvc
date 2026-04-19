<?php ob_start(); ?>

<!-- 
    Vista: Crear Bodega
    ----------------------------------------
    Muestra un formulario para registrar una nueva bodega.
    Permite ingresar datos básicos y asignar encargados.
-->

<h2><i class="fa-solid fa-plus"></i> Nueva Bodega</h2>

<div class="card shadow-sm mt-3">
    <div class="card-body">

        <!-- 
            Formulario de creación
            method="POST" → envía datos al servidor
            action="?action=store" → ejecuta método store() del controlador
        -->
        <form method="POST" action="?action=store">

            <!-- Código de la bodega -->
            <div class="mb-3">
                <label class="form-label">Código</label>
                <input type="text" name="codigo" class="form-control" required>
            </div>

            <!-- Nombre de la bodega -->
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <!-- Dirección -->
            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" required>
            </div>

            <!-- Dotación (cantidad de personal) -->
            <div class="mb-3">
                <label class="form-label">Dotación</label>
                <input type="number" name="dotacion" class="form-control" required>
            </div>

            <!-- Estado de la bodega -->
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select">
                    <option value="Activada">Activada</option>
                    <option value="Desactivada">Desactivada</option>
                </select>
            </div>

            <!-- 
                Lista de encargados
                Se genera dinámicamente desde el controlador
                Permite seleccionar múltiples encargados (checkbox)
            -->
            <div class="mb-3">
                <label class="form-label">Encargados</label>

                <?php foreach ($encargados as $e): ?>
                    <div class="form-check">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            name="encargados[]" 
                            value="<?= $e['id'] ?>">

                        <label class="form-check-label">
                            <?= $e['nombre'] . ' ' . $e['apellido_paterno'] ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Botón guardar -->
            <button class="btn btn-success">
                <i class="fa-solid fa-save"></i> Guardar
            </button>

            <!-- Botón volver -->
            <a href="./" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>

        </form>

    </div>
</div>

<?php
/**
 * Captura el contenido generado por la vista
 * para insertarlo dentro del layout principal.
 */
$content = ob_get_clean();

/** Título dinámico de la página */
$title = "Crear Bodega";

/** Cargar layout base */
require __DIR__ . '/layout.php';