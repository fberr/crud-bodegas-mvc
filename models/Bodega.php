<?php

require_once __DIR__ . '/../config/database.php';

/**
 * Modelo Bodega
 * 
 * Encargado de interactuar con la base de datos
 * para todas las operaciones relacionadas con bodegas
 * y sus encargados.
 */
class Bodega {

    /** @var PDO Conexión a la base de datos */
    private $db;

    /**
     * Constructor
     * 
     * Inicializa la conexión a la base de datos
     */
    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Obtener todas las bodegas
     * 
     * Permite filtrar por estado y agrega los encargados
     * asociados en un solo campo (STRING_AGG).
     * 
     * @param string $estado
     * @return array
     */
    public function getAll($estado = 'todos') {
        $sql = "
        SELECT 
            b.*,
            STRING_AGG(e.nombre || ' ' || e.apellido_paterno, ', ') AS encargados
        FROM bodegas b
        LEFT JOIN bodega_encargado be ON b.id = be.bodega_id
        LEFT JOIN encargados e ON e.id = be.encargado_id
        ";

        $params = [];

        // Filtro opcional por estado
        if ($estado !== 'todos') {
            $sql .= " WHERE b.estado = :estado";
            $params[':estado'] = $estado;
        }

        // Agrupación necesaria por uso de STRING_AGG
        $sql .= " GROUP BY b.id ORDER BY b.id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    /**
     * Obtener una bodega por ID
     * 
     * @param int $id
     * @return array|false
     */
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM bodegas WHERE id = :id");
        $stmt->execute([':id' => $id]);

        return $stmt->fetch();
    }

    /**
     * Crear nueva bodega
     * 
     * @param array $data
     * @return bool
     */
    public function create($data) {
        $sql = "INSERT INTO bodegas (codigo, nombre, direccion, dotacion, estado)
                VALUES (:codigo, :nombre, :direccion, :dotacion, :estado)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':codigo' => $data['codigo'],
            ':nombre' => $data['nombre'],
            ':direccion' => $data['direccion'],
            ':dotacion' => $data['dotacion'],
            ':estado' => $data['estado']
        ]);
    }

    /**
     * Actualizar bodega existente
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        $sql = "UPDATE bodegas SET
                    codigo = :codigo,
                    nombre = :nombre,
                    direccion = :direccion,
                    dotacion = :dotacion,
                    estado = :estado
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':codigo' => $data['codigo'],
            ':nombre' => $data['nombre'],
            ':direccion' => $data['direccion'],
            ':dotacion' => $data['dotacion'],
            ':estado' => $data['estado'],
            ':id' => $id
        ]);
    }

    /**
     * Eliminar bodega
     * 
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM bodegas WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Obtener todos los encargados
     * 
     * @return array
     */
    public function getEncargados() {
        $stmt = $this->db->query("
            SELECT id, nombre, apellido_paterno 
            FROM encargados 
            ORDER BY nombre
        ");
        return $stmt->fetchAll();
    }

    /**
     * Obtener IDs de encargados asociados a una bodega
     * 
     * @param int $bodega_id
     * @return array
     */
    public function getEncargadosByBodega($bodega_id) {
        $stmt = $this->db->prepare("
            SELECT encargado_id 
            FROM bodega_encargado 
            WHERE bodega_id = :id
        ");
        $stmt->execute([':id' => $bodega_id]);

        // Retorna array plano de IDs
        return array_column($stmt->fetchAll(), 'encargado_id');
    }

    /**
     * Asignar encargado a una bodega
     * 
     * Relación muchos a muchos
     * 
     * @param int $bodega_id
     * @param int $encargado_id
     * @return bool
     */
    public function assignEncargado($bodega_id, $encargado_id) {
        $stmt = $this->db->prepare("
            INSERT INTO bodega_encargado (bodega_id, encargado_id)
            VALUES (:bodega, :encargado)
        ");

        return $stmt->execute([
            ':bodega' => $bodega_id,
            ':encargado' => $encargado_id
        ]);
    }

    /**
     * Eliminar todos los encargados de una bodega
     * 
     * @param int $bodega_id
     * @return bool
     */
    public function clearEncargados($bodega_id) {
        $stmt = $this->db->prepare("
            DELETE FROM bodega_encargado
            WHERE bodega_id = :id
        ");

        return $stmt->execute([':id' => $bodega_id]);
    }

    /**
     * Obtener último ID insertado
     * 
     * @return string
     */
    public function getLastId() {
        return $this->db->lastInsertId();
    }
}