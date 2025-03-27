<?php
class Prenda {
    private $conn;
    private $table = 'prendas';


    public $id;
    public $nombre;
    public $marca_id;
    public $stock;
    public $precio;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_single($id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }


    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (nombre, marca_id, stock, precio) 
                  VALUES (:nombre, :marca_id, :stock, :precio)';
        
        $stmt = $this->conn->prepare($query);


        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->marca_id = intval($this->marca_id);
        $this->stock = intval($this->stock);
        $this->precio = floatval($this->precio);


        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':marca_id', $this->marca_id);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':precio', $this->precio);


        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }


    public function update() {
        $query = 'UPDATE ' . $this->table . ' 
                  SET nombre = :nombre, marca_id = :marca_id, stock = :stock, precio = :precio 
                  WHERE id = :id';

        $stmt = $this->conn->prepare($query);

      
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->marca_id = intval($this->marca_id);
        $this->stock = intval($this->stock);
        $this->precio = floatval($this->precio);
        $this->id = intval($this->id);


        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':marca_id', $this->marca_id);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':id', $this->id);


        return $stmt->execute();
    }


    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);


        $this->id = intval($this->id);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
?>
