<?php

/**
 * Clase Database
 * 
 * Encargada de gestionar la conexión a la base de datos PostgreSQL
 * utilizando PDO.
 */
class Database {

    /** @var string Host del servidor de base de datos */
    private static $host = 'localhost';

    /** @var string Puerto de PostgreSQL */
    private static $port = '5432';

    /** @var string Nombre de la base de datos */
    private static $dbname = 'prueba_tecnica';

    /** @var string Usuario de conexión */
    private static $user = 'felipeberrios';

    /** @var string Contraseña del usuario */
    private static $password = '';

    /**
     * Establece y retorna una conexión a la base de datos.
     *
     * @return PDO Instancia de conexión PDO
     */
    public static function connect() {
        try {

            // DSN: Data Source Name para conexión PostgreSQL
            $dsn = "pgsql:host=" . self::$host . 
                   ";port=" . self::$port . 
                   ";dbname=" . self::$dbname;

            // Crear instancia PDO con configuración recomendada
            $pdo = new PDO($dsn, self::$user, self::$password, [

                // Manejo de errores mediante excepciones
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

                // Retornar resultados como array asociativo
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

            return $pdo;

        } catch (PDOException $e) {

            // Detiene la ejecución mostrando el error de conexión
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }
}