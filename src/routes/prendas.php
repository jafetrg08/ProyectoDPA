<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

require __DIR__ . '/../controllers/PrendasController.php';

return function (App $app) {

    $app->get('/prendas', function (Request $request, Response $response) {
        $controller = new PrendasController();
        $data = $controller->getAll();
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

    
    $app->get('/prendas/{id}', function (Request $request, Response $response, $args) {
        $controller = new PrendasController();
        $data = $controller->getById($args['id']);

        if (!$data) {
            $error = ['error' => 'Prenda no encontrada'];
            $response->getBody()->write(json_encode($error));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

   
    $app->post('/prendas', function (Request $request, Response $response) {
        $controller = new PrendasController();
        $data = json_decode($request->getBody()->getContents(), true);

        if (!is_array($data)) {
            $error = ["error" => "Formato JSON inválido o cuerpo vacío"];
            $response->getBody()->write(json_encode($error));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        if (empty($data['nombre']) || empty($data['marca_id']) || empty($data['precio'])) {
            $error = ["error" => "Datos incompletos. Campos requeridos: nombre, marca_id, precio"];
            $response->getBody()->write(json_encode($error));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $resultado = $controller->create($data);

        if (isset($resultado['error'])) {
            $response->getBody()->write(json_encode($resultado));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $response->getBody()->write(json_encode($resultado));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    });

    
    $app->put('/prendas/{id}', function (Request $request, Response $response, $args) {
        $controller = new PrendasController();
        $id = $args['id'];
        $data = json_decode($request->getBody()->getContents(), true);

        if (!is_array($data)) {
            $error = ["error" => "Formato JSON inválido o cuerpo vacío"];
            $response->getBody()->write(json_encode($error));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $resultado = $controller->update($id, $data);

        if (isset($resultado['error'])) {
            $response->getBody()->write(json_encode($resultado));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $response->getBody()->write(json_encode($resultado));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

    
    $app->delete('/prendas/{id}', function (Request $request, Response $response, $args) {
        $controller = new PrendasController();
        $id = $args['id'];

        $resultado = $controller->delete($id);

        if (isset($resultado['error'])) {
            $response->getBody()->write(json_encode($resultado));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $response->getBody()->write(json_encode($resultado));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });
};

