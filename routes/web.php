<?php 

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

/** @var \Slim\App $app */

// $app->options('/{routes:.*}', function (Request $request, Response $response) {
//     // CORS Pre-Flight OPTIONS Request Handler
//     return $response;
// });

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write('Hello world!');
    return $response;
});

$app->group('/users', function (Group $group) {
    $group->get('', ListUsersAction::class);
    $group->get('/{id}', ViewUserAction::class);
});

// $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
//     throw new \Slim\Exception\HttpNotFoundException($request);
// });