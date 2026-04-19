<?php 
ob_start(); 

// Obtener filtro actual desde la URL
$estadoActual = $_GET['estado'] ?? 'todos';
?>

<!-- 
    Alertas de sesión (mensajes flash)
    ----------------------------------------
    - success → operación exitosa
    - error → ocurrió un problema
-->
<?php foreach (['success', 'error'] as $type): ?>
    <?php if (!empty($_SESSION[$type])): ?>
        
        <div class="alert alert-<?= $type === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION[$type] ?>

            <!-- Botón cerrar alerta -->
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <!-- Limpiar mensaje después de mostrar -->
        <?php unset($_SESSION[$type]); ?>
        
    <?php endif; ?>
<?php endforeach; ?>

<!-- Header con título y botón crear -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fa-solid fa-warehouse"></i> Bodegas</h2>

    <!-- Redirige al formulario de creación -->
    <a href="?action=create" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Nueva
    </a>
</div>

<!-- 
    Filtro por estado
    ----------------------------------------
    Se envía por GET → afecta la consulta en el modelo
-->
<form method="GET" class="mb-3">
    <select name="estado" class="form-select w-auto d-inline">

        <option value="todos" <?= $estadoActual == 'todos' ? 'selected' : '' ?>>
            Todos
        </option>

        <option value="Activada" <?= $estadoActual == 'Activada' ? 'selected' : '' ?>>
            Activadas
        </option>

        <option value="Desactivada" <?= $estadoActual == 'Desactivada' ? 'selected' : '' ?>>
            Desactivadas
        </option>

    </select>

    <button class="btn btn-secondary btn-sm">Filtrar</button>
</form>

<div class="card shadow-sm">
    <div class="card-body">

        <!-- Tabla de bodegas -->
        <table class="table table-hover align-middle">
            <thead class="table-secondary">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Dotación</th>
                    <th>Encargados</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>

            <tbody>

            <?php if (!empty($bodegas)): ?>

                <?php foreach ($bodegas as $b): ?>
                    <tr>
                        <td><?= $b['codigo'] ?></td>
                        <td><?= $b['nombre'] ?></td>
                        <td><?= $b['direccion'] ?></td>
                        <td><?= $b['dotacion'] ?></td>

                        <td>
                            <?php if (!empty($b['encargados'])): ?>
                                
                                <?php foreach (explode(',', $b['encargados']) as $enc): ?>
                                    <span class="badge bg-info text-dark me-1 mb-1">
                                        <?= trim($enc) ?>
                                    </span>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <span class="text-muted">Sin asignar</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?= date('d-m-Y', strtotime($b['fecha_creacion'])) ?>
                        </td>

                        <td>
                            <span class="badge <?= $b['estado'] == 'Activada' ? 'bg-success' : 'bg-danger' ?>">
                                <?= $b['estado'] ?>
                            </span>
                        </td>

                        <td class="text-end">
                            <a href="?action=edit&id=<?= $b['id'] ?>" class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <button 
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-id="<?= $b['id'] ?>"
                                data-nombre="<?= htmlspecialchars($b['nombre']) ?>"
                            >
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>

            <?php else: ?>

                <!-- Mensaje cuando no hay datos -->
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="fa-solid fa-box-open"></i> No hay bodegas registradas
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>
</div>

<!-- 
    Modal de eliminación
    ----------------------------------------
    Se reutiliza para cualquier bodega
-->
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form method="POST" action="?action=delete">

        <div class="modal-header">
          <h5 class="modal-title">
            <i class="fa-solid fa-triangle-exclamation text-danger"></i>
            Confirmar eliminación
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <p>¿Estás seguro que deseas eliminar la bodega:</p>

          <!-- Nombre dinámico -->
          <strong id="delete-nombre"></strong>

          <!-- ID oculto -->
          <input type="hidden" name="id" id="delete-id">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancelar
          </button>

          <button type="submit" class="btn btn-danger">
            <i class="fa-solid fa-trash"></i> Eliminar
          </button>
        </div>

      </form>

    </div>
  </div>
</div>

<?php
/**
 * Captura el contenido de la vista
 */
$content = ob_get_clean();

/** Título de la página */
$title = "Listado de Bodegas";

/** Cargar layout */
require __DIR__ . '/layout.php';