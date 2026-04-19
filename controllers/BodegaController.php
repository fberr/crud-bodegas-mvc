<?php

require_once __DIR__ . '/../models/Bodega.php';

/**
 * Controlador de Bodegas
 * 
 * Se encarga de manejar las solicitudes del usuario,
 * interactuar con el modelo y cargar las vistas correspondientes.
 */
class BodegaController {

    /**
     * Listar bodegas
     * 
     * Obtiene todas las bodegas (con filtro opcional por estado)
     * y carga la vista principal.
     */
    public function index() {
        $model = new Bodega();

        // Obtener filtro desde la URL
        $estado = $_GET['estado'] ?? 'todos';

        // Obtener bodegas desde el modelo
        $bodegas = $model->getAll($estado);

        // Cargar vista
        require __DIR__ . '/../views/index.php';
    }

    /**
     * Mostrar formulario de creación
     * 
     * Obtiene la lista de encargados disponibles
     * para asignarlos a la nueva bodega.
     */
    public function create() {
        $model = new Bodega();

        // Obtener encargados disponibles
        $encargados = $model->getEncargados();

        require __DIR__ . '/../views/create.php';
    }

    /**
     * Guardar nueva bodega
     * 
     * Procesa los datos del formulario (POST),
     * crea la bodega y asigna encargados.
     */
    public function store() {
        $model = new Bodega();

        try {
            // Datos del formulario
            $data = [
                'codigo' => $_POST['codigo'],
                'nombre' => $_POST['nombre'],
                'direccion' => $_POST['direccion'],
                'dotacion' => $_POST['dotacion'],
                'estado' => $_POST['estado']
            ];

            // Crear bodega
            $model->create($data);

            // Obtener ID generado
            $bodega_id = $model->getLastId();

            // Asignar encargados (relación muchos a muchos)
            if (!empty($_POST['encargados'])) {
                foreach ($_POST['encargados'] as $encargado_id) {
                    $model->assignEncargado($bodega_id, $encargado_id);
                }
            }

            // Mensaje de éxito
            $_SESSION['success'] = "Bodega creada correctamente";

        } catch (Exception $e) {

            // Mensaje de error
            $_SESSION['error'] = "Error al crear la bodega";
        }

        // Redirección (PRG pattern)
        header('Location: ./');
        exit;
    }

    /**
     * Mostrar formulario de edición
     * 
     * Obtiene la bodega, todos los encargados
     * y los encargados ya asignados.
     */
    public function edit() {
        $model = new Bodega();

        $id = $_GET['id'];

        // Datos de la bodega
        $bodega = $model->getById($id);

        // Lista completa de encargados
        $encargados = $model->getEncargados();

        // Encargados asignados a la bodega
        $encargadosSeleccionados = $model->getEncargadosByBodega($id);

        require __DIR__ . '/../views/edit.php';
    }

    /**
     * Actualizar bodega
     * 
     * Actualiza los datos de la bodega
     * y sincroniza los encargados asociados.
     */
    public function update() {
        $model = new Bodega();

        try {
            $id = $_POST['id'];

            $data = [
                'codigo' => $_POST['codigo'],
                'nombre' => $_POST['nombre'],
                'direccion' => $_POST['direccion'],
                'dotacion' => $_POST['dotacion'],
                'estado' => $_POST['estado']
            ];

            // Actualizar bodega
            $model->update($id, $data);

            // Limpiar relaciones actuales
            $model->clearEncargados($id);

            // Reasignar encargados
            if (!empty($_POST['encargados'])) {
                foreach ($_POST['encargados'] as $encargado_id) {
                    $model->assignEncargado($id, $encargado_id);
                }
            }

            $_SESSION['success'] = "Bodega actualizada correctamente";

        } catch (Exception $e) {

            $_SESSION['error'] = "Error al actualizar la bodega";
        }

        header('Location: ./');
        exit;
    }

    /**
     * Eliminar bodega
     * 
     * Elimina la bodega por ID.
     */
    public function delete() {
        $model = new Bodega();

        $id = $_POST['id'];

        $model->delete($id);

        header('Location: ./');
        exit;
    }
}