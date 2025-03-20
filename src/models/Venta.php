<?php
require_once __DIR__ . '/../db/Database.php';

class Venta {
    private $conn;
    private $table_name = "ventas";

    public $id;
    public $prenda_id;
    public $cantidad;
    public $fecha;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todas las ventas
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Obtener una venta por ID
    public function read_single($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }

    // Crear una nueva venta
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (prenda_id, cantidad, fecha) VALUES (:prenda_id, :cantidad, :fecha)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':prenda_id', $this->prenda_id);
        $stmt->bindParam(':cantidad', $this->cantidad);
        $stmt->bindParam(':fecha', $this->fecha);
        
        return $stmt->execute();
    }

    // Actualizar una venta existente
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET prenda_id = :prenda_id, cantidad = :cantidad, fecha = :fecha WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':prenda_id', $this->prenda_id);
        $stmt->bindParam(':cantidad', $this->cantidad);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':id', $this->id);
        
        return $stmt->execute();
    }

    // Eliminar una venta
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }
}
