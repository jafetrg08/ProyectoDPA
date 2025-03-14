<?php
require_once __DIR__ . '/../models/Prenda.php';
require_once __DIR__ . '/../db/Database.php';

class PrendasController {
    private $db;
    private $prenda;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->prenda = new Prenda($this->db);
    }

    // Obtener todas las prendas
    public function getAll() {
        $stmt = $this->prenda->read();
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    // Obtener una prenda por ID
    public function getById($id) {
        if (!is_numeric($id) || intval($id) <= 0) {
            return ["error" => "ID inválido. Debe ser un número entero positivo."];
        }

        $stmt = $this->prenda->read_single($id);
        $prenda = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;

        return $prenda ?: ["error" => "Prenda no encontrada."];
    }

    // Crear una nueva prenda
    public function create($data) {
        file_put_contents('debug.log', print_r($data, true));

        if (empty($data['nombre']) || empty($data['marca_id']) || empty($data['precio'])) {
            return ["error" => "Datos incompletos. Campos requeridos: nombre, marca_id, precio."];
        }

        if (!is_numeric($data['marca_id']) || intval($data['marca_id']) <= 0) {
            return ["error" => "El campo 'marca_id' debe ser un número entero válido."];
        }

        if (!is_numeric($data['precio']) || floatval($data['precio']) <= 0) {
            return ["error" => "El campo 'precio' debe ser un número válido."];
        }

        $this->prenda->nombre = htmlspecialchars(strip_tags($data['nombre']));
        $this->prenda->marca_id = intval($data['marca_id']);
        $this->prenda->precio = floatval($data['precio']);
        $this->prenda->stock = isset($data['stock']) && is_numeric($data['stock']) ? intval($data['stock']) : 0;

        if ($this->prenda->create()) {
            return ["mensaje" => "Prenda creada exitosamente.", "id" => $this->prenda->id];
        } else {
            return ["error" => "Error al crear la prenda."];
        }
    }

    // Actualizar una prenda existente
    public function update($id, $data) {
        if (!is_numeric($id) || intval($id) <= 0) {
            return ["error" => "ID inválido. Debe ser un número entero positivo."];
        }

        if (empty($data['nombre']) || empty($data['marca_id']) || empty($data['precio'])) {
            return ["error" => "Datos incompletos. Campos requeridos: nombre, marca_id, precio."];
        }

        if (!is_numeric($data['marca_id']) || intval($data['marca_id']) <= 0) {
            return ["error" => "El campo 'marca_id' debe ser un número entero válido."];
        }

        if (!is_numeric($data['precio']) || floatval($data['precio']) <= 0) {
            return ["error" => "El campo 'precio' debe ser un número válido."];
        }

        $this->prenda->id = $id;
        $this->prenda->nombre = htmlspecialchars(strip_tags($data['nombre']));
        $this->prenda->marca_id = intval($data['marca_id']);
        $this->prenda->precio = floatval($data['precio']);
        $this->prenda->stock = isset($data['stock']) && is_numeric($data['stock']) ? intval($data['stock']) : 0;

        if ($this->prenda->update()) {
            return ["mensaje" => "Prenda actualizada correctamente."];
        } else {
            return ["error" => "No se pudo actualizar la prenda o no existe."];
        }
    }

    // Eliminar una prenda
    public function delete($id) {
        if (!is_numeric($id) || intval($id) <= 0) {
            return ["error" => "ID inválido. Debe ser un número entero positivo."];
        }

        $this->prenda->id = $id;

        if ($this->prenda->delete()) {
            return ["mensaje" => "Prenda eliminada correctamente."];
        } else {
            return ["error" => "No se pudo eliminar la prenda o no existe."];
        }
    }
}
