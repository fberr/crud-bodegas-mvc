<?php

/**
 * Archivo de rutas (Router simple)
 * 
 * Se encarga de recibir la acción desde la URL (GET)
 * y delegar la ejecución al método correspondiente
 * del controlador BodegaController.
 */

// Cargar controlador principal
require_once __DIR__ . '/controllers/BodegaController.php';

// Instanciar el controlador
$controller = new BodegaController();

/**
 * Obtener acción desde la URL
 * 
 * Ejemplo:
 * ?action=edit&id=1
 * 
 * Si no se especifica, se usa 'index' por defecto
 */
$action = $_GET['action'] ?? 'index';

/**
 * Enrutamiento de acciones
 */
switch ($action) {

    case 'create':
        // Mostrar formulario de creación
        $controller->create();
        break;

    case 'store':
        // Guardar nueva bodega (POST)
        $controller->store();
        break;

    case 'edit':
        // Mostrar formulario de edición
        $controller->edit();
        break;

    case 'update':
        // Actualizar bodega existente (POST)
        $controller->update();
        break;

    case 'delete':
        // Eliminar bodega (POST)
        $controller->delete();
        break;

    default:
        // Acción por defecto: listar bodegas
        $controller->index();
        break;
}