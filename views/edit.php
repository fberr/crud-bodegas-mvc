<?php ob_start(); ?>

<!-- 
    Vista: Editar Bodega
    ----------------------------------------
    Permite modificar los datos de una bodega existente
    y actualizar sus encargados asociados.
-->

<h2><i class="fa-solid fa-pen"></i> Editar Bodega</h2>

<div class="card shadow-sm mt-3">
    <div class="card-body">

        <!-- 
            Formulario de actualización
            action="?action=update" → ejecuta método update() del controlador
        -->
        <form method="POST" action="?action=update">

            <!-- ID oculto necesario para identificar la bodega -->
            <input type="hidden" name="id" value="<?= $bodega['id'] ?>">

            <!-- Código -->
            <div class="mb-3">
                <label class="form-label">Código</label>
                <input type="text" name="codigo" class="form-control" 
                       value="<?= $bodega['codigo'] ?>" required>
            </div>

            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" 
                       value="<?= $bodega['nombre'] ?>" required>
            </div>

            <!-- Dirección -->
            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" 
                       value="<?= $bodega['direccion'] ?>" required>
            </div>

            <!-- Dotación -->
            <div class="mb-3">
                <label class="form-label">Dotación</label>
                <input type="number" name="dotacion" class="form-control" 
                       value="<?= $bodega['dotacion'] ?>" required>
            </div>

            <!-- 
                Estado
                Se selecciona automáticamente según el valor actual
            -->
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select">
                    <option value="Activada" <?= $bodega['estado']=='Activada'?'selected':'' ?>>
                        Activada
                    </option>
                    <option value="Desactivada" <?= $bodega['estado']=='Desactivada'?'selected':'' ?>>
                        Desactivada
                    </option>
                </select>
            </div>

            <!-- 
                Encargados (relación muchos a muchos)
                ----------------------------------------
                - Se listan todos los encargados disponibles
                - Se marcan como "checked" los que ya están asociados
           
                Marca checkbox si el encargado ya está asignado
                in_array → verifica si el ID está en el array
            -->
            <div class="mb-3">
                <label class="form-label">Encargados</label>

                <?php foreach ($encargados as $e): ?>
                    <div class="form-check">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            name="encargados[]" 
                            value="<?= $e['id'] ?>"

                            
                            <?= in_array($e['id'], $encargadosSeleccionados) ? 'checked' : '' ?>>

                        <label class="form-check-label">
                            <?= $e['nombre'] . ' ' . $e['apellido_paterno'] ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Botón actualizar -->
            <button class="btn btn-primary">
                <i class="fa-solid fa-save"></i> Actualizar
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
 * Captura el contenido HTML de la vista
 */
$content = ob_get_clean();

/** Título dinámico */
$title = "Editar Bodega";

/** Cargar layout principal */
require __DIR__ . '/layout.php';