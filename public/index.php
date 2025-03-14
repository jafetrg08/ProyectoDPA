<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php'; // Cargar Slim

$app = AppFactory::create(); // Crear instancia de la app

$app->addBodyParsingMiddleware(); // ✅ Manejar JSON en PUT y DELETE
$app->addRoutingMiddleware(); // ✅ Asegura que Slim maneja las rutas correctamente
$app->addErrorMiddleware(true, true, true); // ✅ Manejo de errores

(require __DIR__ . '/../src/routes/prendas.php')($app); // Cargar rutas de prendas
(require __DIR__ . '/../src/routes/marcas.php')($app); // Cargar rutas de marcas
(require __DIR__ . '/../src/routes/ventas.php')($app); // ✅ Cargar rutas de ventas
(require __DIR__ . '/../src/routes/reportes.php')($app); // ✅ Cargar rutas de reportes

$app->run(); // Ejecutar la aplicación
