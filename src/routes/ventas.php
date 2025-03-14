<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

require __DIR__ . '/../controllers/VentasController.php';

return function (App $app) {
    // Obtener todas las ventas
    $app->get('/ventas', function (Request $request, Response $response) {
        $controller = new VentasController();
        $data = $controller->getAll();
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

    // Obtener una venta por ID
    $app->get('/ventas/{id}', function (Request $request, Response $response, $args) {
        $controller = new VentasController();
        $data = $controller->getById($args['id']);
        $status = isset($data['error']) ? 404 : 200;
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    });

    // Crear una nueva venta
    $app->post('/ventas', function (Request $request, Response $response) {
        $controller = new VentasController();
        $data = json_decode($request->getBody()->getContents(), true);
        
        if (!is_array($data) || empty($data['prenda_id']) || empty($data['cantidad']) || empty($data['fecha'])) {
            $error = ['error' => 'Datos incompletos. Campos requeridos: prenda_id, cantidad, fecha'];
            $response->getBody()->write(json_encode($error));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $resultado = $controller->create($data);
        $status = isset($resultado['error']) ? 400 : 201;
        $response->getBody()->write(json_encode($resultado));
        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    });

    // Actualizar una venta existente
    $app->put('/ventas/{id}', function (Request $request, Response $response, $args) {
        $controller = new VentasController();
        $id = $args['id'];
        $data = json_decode($request->getBody()->getContents(), true);

        if (!is_array($data) || empty($data['prenda_id']) || empty($data['cantidad']) || empty($data['fecha'])) {
            $error = ['error' => 'Datos incompletos. Campos requeridos: prenda_id, cantidad, fecha'];
            $response->getBody()->write(json_encode($error));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $resultado = $controller->update($id, $data);
        $status = isset($resultado['error']) ? 400 : 200;
        $response->getBody()->write(json_encode($resultado));
        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    });

    // Eliminar una venta
    $app->delete('/ventas/{id}', function (Request $request, Response $response, $args) {
        $controller = new VentasController();
        $id = $args['id'];
        $resultado = $controller->delete($id);
        $status = isset($resultado['error']) ? 400 : 200;
        $response->getBody()->write(json_encode($resultado));
        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    });
};
