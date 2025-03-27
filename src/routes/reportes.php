<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
require_once __DIR__ . '/../db/Database.php';

return function (App $app) {
  
    $app->get('/reportes/marcas-con-ventas', function (Request $request, Response $response) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query("SELECT * FROM marcas_con_ventas");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

   
    $app->get('/reportes/prendas-vendidas-stock', function (Request $request, Response $response) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query("SELECT * FROM prendas_vendidas_stock");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

  
    $app->get('/reportes/top-5-marcas', function (Request $request, Response $response) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query("SELECT * FROM top_5_marcas_vendidas");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });
};
