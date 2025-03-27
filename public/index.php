<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php'; 

$app = AppFactory::create(); 

$app->addBodyParsingMiddleware(); 
$app->addRoutingMiddleware(); 
$app->addErrorMiddleware(true, true, true); 

(require __DIR__ . '/../src/routes/prendas.php')($app); 
(require __DIR__ . '/../src/routes/marcas.php')($app); 
(require __DIR__ . '/../src/routes/ventas.php')($app);  
(require __DIR__ . '/../src/routes/reportes.php')($app);  

$app->run(); // Ejecutar la aplicación
