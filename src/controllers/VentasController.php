<?php
require_once __DIR__ . '/../models/Venta.php';
require_once __DIR__ . '/../db/Database.php';

class VentasController {
    private $db;
    private $venta;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->venta = new Venta($this->db);
    }

    // Obtener todas las ventas
    public function getAll() {
        $stmt = $this->venta->read();
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    // Obtener una venta por ID
    public function getById($id) {
        if (!is_numeric($id) || intval($id) <= 0) {
            return ["error" => "ID inválido. Debe ser un número entero positivo."];
        }

        $stmt = $this->venta->read_single($id);
        $venta = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;

        return $venta ?: ["error" => "Venta no encontrada."];
    }

    // Crear una nueva venta
    public function create($data) {
        if (empty($data['prenda_id']) || empty($data['cantidad']) || empty($data['fecha'])) {
            return ["error" => "Todos los campos (prenda_id, cantidad, fecha) son requeridos."];
        }

        $this->venta->prenda_id = intval($data['prenda_id']);
        $this->venta->cantidad = intval($data['cantidad']);
        $this->venta->fecha = htmlspecialchars(strip_tags($data['fecha']));

        if ($this->venta->create()) {
            return ["mensaje" => "Venta creada exitosamente.", "id" => $this->venta->id];
        } else {
            return ["error" => "Error al crear la venta."];
        }
    }

    // Actualizar una venta existente
    public function update($id, $data) {
        if (!is_numeric($id) || intval($id) <= 0) {
            return ["error" => "ID inválido."];
        }
        
        if (empty($data['prenda_id']) || empty($data['cantidad']) || empty($data['fecha'])) {
            return ["error" => "Todos los campos (prenda_id, cantidad, fecha) son requeridos."];
        }

        $this->venta->id = $id;
        $this->venta->prenda_id = intval($data['prenda_id']);
        $this->venta->cantidad = intval($data['cantidad']);
        $this->venta->fecha = htmlspecialchars(strip_tags($data['fecha']));

        if ($this->venta->update()) {
            return ["mensaje" => "Venta actualizada correctamente."];
        } else {
            return ["error" => "No se pudo actualizar la venta."];
        }
    }

    // Eliminar una venta
    public function delete($id) {
        if (!is_numeric($id) || intval($id) <= 0) {
            return ["error" => "ID inválido."];
        }

        if ($this->venta->delete($id)) {
            return ["mensaje" => "Venta eliminada correctamente."];
        } else {
            return ["error" => "No se pudo eliminar la venta."];
        }
    }
}
