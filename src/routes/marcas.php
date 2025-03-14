<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

require __DIR__ . '/../controllers/MarcasController.php';

return function (App $app) {
    // Ruta GET para todas las marcas
    $app->get('/marcas', function (Request $request, Response $response) {
        $controller = new MarcasController();
        $data = $controller->getAll();
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

    // Ruta GET para una marca por ID
    $app->get('/marcas/{id}', function (Request $request, Response $response, $args) {
        $controller = new MarcasController();
        $data = $controller->getById($args['id']);

        if (!$data) {
            $error = ['error' => 'Marca no encontrada'];
            $response->getBody()->write(json_encode($error));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

    // Ruta POST para crear una nueva marca
    $app->post('/marcas', function (Request $request, Response $response) {
        $controller = new MarcasController();
        $data = json_decode($request->getBody()->getContents(), true);

        if (!is_array($data) || empty($data['nombre'])) {
            $error = ['error' => 'Datos incompletos. Campo requerido: nombre'];
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

    // Ruta PUT para actualizar una marca
    $app->put('/marcas/{id}', function (Request $request, Response $response, $args) {
        $controller = new MarcasController();
        $id = $args['id'];
        $data = json_decode($request->getBody()->getContents(), true);

        if (!is_array($data) || empty($data['nombre'])) {
            $error = ['error' => 'Datos incompletos. Campo requerido: nombre'];
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

    // Ruta DELETE para eliminar una marca
    $app->delete('/marcas/{id}', function (Request $request, Response $response, $args) {
        $controller = new MarcasController();
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
