# Archivo readme :file_folder:

# Descripción del proyecto. :memo:
El proyecto consiste en diseñar e implementar una base de datos para una tienda de ropa, junto con el desarrollo de un API que permita interactuar con dicha base de datos. El objetivo es gestionar de manera eficiente la información relacionada con las prendas de ropa, las marcas, el inventario (stock), las ventas y otros aspectos relevantes de la tienda. A continuación, se detallan los componentes principales del proyecto:


# Diagrama de la base de datos :bar_chart:

<img width="558" alt="image" src="https://github.com/user-attachments/assets/d01f3daa-492d-48c6-b27d-3961f0d0f663" />

Estructura principal:
- `prendas` (id, nombre, marca_id, stock, precio)
- `marcas` (id, nombre)
- `ventas` (id, prenda_id, cantidad, fecha)

## 👥 Equipo
| Rol | Integrante |
|------|------------|
| Desarrollador | Jafet Ramirez Gonzalez :man_technologist: -
| Desarrollador | Mario Alfaro Quesada :man_technologist:


ENDPOINTS API

## 🔌 Endpoints API
### 🧥 Prendas
| Método | Endpoint | Descripción |
|--------|----------|-------------|
| `GET` | `/prendas` | Obtener todas las prendas |
| `GET` | `/prendas/{id}` | Obtener prenda por ID |
| `POST` | `/prendas` | Crear nueva prenda |
| `PUT` | `/prendas/{id}` | Actualizar prenda |
| `DELETE` | `/prendas/{id}` | Eliminar prenda |

**Ejemplo POST**:
```json
{
  "nombre": "Camiseta",
  "marca_id": 1,
  "stock": 50,
  "precio": 19.99
}

🏷️ Marcas
| Método | Endpoint | Descripción |
|--------|----------|-------------|
| `GET` | `/marcas` | Obtener todas las maarcas |
| `GET` | `/marcas/{id}` | Obtener marca por ID |
| `POST` | `/marcas` | Crear nueva marca |
| `PUT` | `/marcas/{id}` | Actualizar marca |
| `DELETE` | `/marcas/{id}` | Eliminar marca |

💰 Ventas
| Método | Endpoint | Descripción |
|--------|----------|-------------|
| `GET` | `/ventas` | Obtener todas las ventas |
| `GET` | `/ventas/{id}` | Obtener venta por ID |
| `POST` | `/ventas` | Crear nueva venta |
| `PUT` | `/ventas/{id}` | Actualizar venta |
| `DELETE` | `/ventas/{id}` | Eliminar venta |

📊 Reportes
💰 Ventas
| Método | Endpoint | Descripción |
|--------|----------|-------------|
| `GET` | `/reportes/marcas-con-ventas` | Marcas con al menos una venta |
| `GET` | `/reportes/prendas-vendidas-stock` | Prendas vendidas con stock restante |
| `GET` | `/reportes/top-5-marcas` | Top 5 marcas más vendidas |
