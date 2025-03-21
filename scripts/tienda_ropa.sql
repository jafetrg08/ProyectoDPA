Base de datos

CREATE DATABASE tienda_ropa;
USE tienda_ropa;
 
Tablas
CREATE TABLE marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);
 
CREATE TABLE prendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    marca_id INT,
    stock INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (marca_id) REFERENCES marcas(id)
);
 
CREATE TABLE ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenda_id INT,
    cantidad INT NOT NULL,
    fecha DATE NOT NULL,
    FOREIGN KEY (prenda_id) REFERENCES prendas(id)
);
 
Inserción de datos de ejemplo

INSERT INTO marcas (nombre) VALUES ('Nike'), ('Adidas'), ('Puma'), ('Reebok'), ('Under Armour');
 
INSERT INTO prendas (nombre, marca_id, stock, precio) VALUES
('Camiseta deportiva', 1, 50, 29.99),
('Pantalón de entrenamiento', 2, 30, 49.99),
('Zapatillas running', 3, 20, 79.99),
('Chaqueta impermeable', 4, 15, 59.99),
('Short de entrenamiento', 5, 40, 24.99);
 
INSERT INTO ventas (prenda_id, cantidad, fecha) VALUES
(1, 5, '2024-02-01'),
(2, 2, '2024-02-02'),
(3, 3, '2024-02-03'),
(4, 1, '2024-02-04'),
(5, 4, '2024-02-05');
 
Eliminación de un dato (Una prenda específica)

-- Eliminar las ventas asociadas a la prenda con id = 3
DELETE FROM ventas WHERE prenda_id = 3;

-- Ahora eliminar la prenda
DELETE FROM prendas WHERE id = 3;
 
Actualización de un dato (Actualizar el stock)
UPDATE prendas SET stock = 45 WHERE id = 1;
 
Consultas (SELECT)
-- a) Obtener la cantidad vendida de prendas por fecha filtrada con una fecha específica
SELECT fecha, SUM(cantidad) AS total_vendido FROM ventas WHERE fecha = '2024-02-01' GROUP BY fecha;
 
Creación de vistas
-- a) Lista de marcas con al menos una venta
CREATE VIEW marcas_con_ventas AS
SELECT DISTINCT m.id, m.nombre FROM marcas m
JOIN prendas p ON m.id = p.marca_id
JOIN ventas v ON p.id = v.prenda_id;
 
-- b) Prendas vendidas y su cantidad restante en stock
CREATE VIEW prendas_vendidas_stock AS
SELECT p.id, p.nombre, SUM(v.cantidad) AS total_vendido, p.stock
FROM prendas p
JOIN ventas v ON p.id = v.prenda_id
GROUP BY p.id;
 
-- c) Listado de las 5 marcas más vendidas y su cantidad de ventas
CREATE VIEW top_5_marcas_vendidas AS
SELECT m.id, m.nombre, SUM(v.cantidad) AS total_ventas
FROM marcas m
JOIN prendas p ON m.id = p.marca_id
JOIN ventas v ON p.id = v.prenda_id
GROUP BY m.id
ORDER BY total_ventas DESC
LIMIT 5;
