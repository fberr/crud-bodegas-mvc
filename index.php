<?php

/**
 * Punto de entrada de la aplicación (Front Controller)
 * ---------------------------------------------------
 * Este archivo es el primero en ejecutarse cuando el usuario
 * accede al sistema desde el navegador.
 */

/**
 * Inicia la sesión
 * ---------------------------------------------------
 * Permite:
 * - Guardar mensajes (success, error)
 * - Mantener datos entre peticiones (flash messages)
 */
session_start();

/**
 * Carga el sistema de rutas
 * ---------------------------------------------------
 * - Define qué controlador ejecutar
 * - Evalúa el parámetro ?action=
 * - Redirige al método correspondiente del controlador
 */
require_once __DIR__ . '/routes.php';