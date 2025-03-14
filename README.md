# Archivo readme :file_folder:
# Descripción del proyecto. :memo:

El proyecto consiste en diseñar e implementar una base de datos para una tienda de ropa, junto con el desarrollo de un API que permita interactuar con dicha base de datos. El objetivo es gestionar de manera eficiente la información relacionada con las prendas de ropa, las marcas, el inventario (stock), las ventas y otros aspectos relevantes de la tienda. A continuación, se detallan los componentes principales del proyecto:


# Diagrama de la base de datos :bar_chart:

<img width="558" alt="image" src="https://github.com/user-attachments/assets/d01f3daa-492d-48c6-b27d-3961f0d0f663" />


# Integrantes del proyecto :pushpin:

Jafet Ramirez Gonzalez :man_technologist: -
Mario Alfaro Quesada :man_technologist:


ENDPOINTS API

1. Endpoints para "prendas"
   
1.1 Obtener todas las prendas
Método: GET
URL: http://localhost/prendas

1.2 Obtener una prenda por ID

Método: GET
URL: http://localhost/prendas/{id}
Parámetros:
id (int) - ID de la prenda a consultar.

1.3 Insertar una nueva prenda

Método: POST
URL: http://localhost/prendas
Cuerpo (JSON):

{
  "nombre": "Camiseta",
  "marca_id": 1,
  "stock": 50,
  "precio": 19.99
}

1.4 Actualizar una prenda

Método: PUT
URL: http://localhost/prendas/{id}
Cuerpo (JSON):

{
  "nombre": "Camiseta actualizada",
  "marca_id": 1,
  "stock": 45,
  "precio": 18.99
}

1.5 Eliminar una prenda

Método: DELETE
URL: http://localhost/prendas/{id}

2. Endpoints para "marcas"

2.1 Obtener todas las marcas

Método: GET
URL: http://localhost/marcas

2.2 Obtener una marca por ID

Método: GET
URL: http://localhost/marcas/{id}

2.3 Insertar una nueva marca

Método: POST
URL: http://localhost/marcas
Cuerpo (JSON):

{
  "nombre": "Nike"
}

2.4 Actualizar una marca

Método: PUT
URL: http://localhost/marcas/{id}
Cuerpo (JSON):

{
  "nombre": "Nike actualizado"
}

2.5 Eliminar una marca

Método: DELETE
URL: http://localhost/marcas/{id}

3. Endpoints para "ventas"

3.1 Obtener todas las ventas

Método: GET
URL: http://localhost/ventas

3.2 Obtener una venta por ID

Método: GET
URL: http://localhost/ventas/{id}

3.3 Insertar una nueva venta

Método: POST
URL: http://localhost/ventas
Cuerpo (JSON):

{
  "prenda_id": 2,
  "cantidad": 3,
  "fecha": "2024-03-14"
}

3.4 Actualizar una venta

Método: PUT
URL: http://localhost/ventas/{id}
Cuerpo (JSON):

{
  "prenda_id": 2,
  "cantidad": 5,
  "fecha": "2024-03-15"
}

3.5 Eliminar una venta

Método: DELETE
URL: http://localhost/ventas/{id}

4. Endpoints para Reportes

4.1 Listar marcas con al menos una venta

Método: GET
URL: http://localhost/reportes/marcas-con-ventas

4.2 Mostrar prendas vendidas con stock restante
Método: GET
URL: http://localhost/reportes/prendas-vendidas-stock

4.3 Listar las 5 marcas más vendidas

Método: GET
URL: http://localhost/reportes/top-5-marcas
