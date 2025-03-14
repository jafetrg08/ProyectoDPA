<?php
require_once __DIR__ . '/../models/Marca.php';
require_once __DIR__ . '/../db/Database.php';

class MarcasController {
    private $db;
    private $marca;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->marca = new Marca($this->db);
    }

    // Obtener todas las marcas
    public function getAll() {
        $stmt = $this->marca->read();
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    // Obtener una marca por ID
    public function getById($id) {
        if (!is_numeric($id) || intval($id) <= 0) {
            return ["error" => "ID inválido. Debe ser un número entero positivo."];
        }

        $stmt = $this->marca->read_single($id);
        $marca = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;

        return $marca ?: ["error" => "Marca no encontrada."];
    }

    // Crear una nueva marca
    public function create($data) {
        if (empty($data['nombre'])) {
            return ["error" => "El nombre de la marca es requerido."];
        }

        $this->marca->nombre = htmlspecialchars(strip_tags($data['nombre']));

        if ($this->marca->create()) {
            return ["mensaje" => "Marca creada exitosamente.", "id" => $this->marca->id];
        } else {
            return ["error" => "Error al crear la marca."];
        }
    }

    // Actualizar una marca existente
    public function update($id, $data) {
        if (!is_numeric($id) || intval($id) <= 0) {
            return ["error" => "ID inválido."];
        }
        
        if (empty($data['nombre'])) {
            return ["error" => "El nombre de la marca es requerido."];
        }

        $this->marca->id = $id;
        $this->marca->nombre = htmlspecialchars(strip_tags($data['nombre']));

        if ($this->marca->update($id)) {
            return ["mensaje" => "Marca actualizada correctamente."];
        } else {
            return ["error" => "No se pudo actualizar la marca."];
        }
    }

    // Eliminar una marca
    public function delete($id) {
        if (!is_numeric($id) || intval($id) <= 0) {
            return ["error" => "ID inválido."];
        }

        if ($this->marca->delete($id)) {
            return ["mensaje" => "Marca eliminada correctamente."];
        } else {
            return ["error" => "No se pudo eliminar la marca."];
        }
    }
}
