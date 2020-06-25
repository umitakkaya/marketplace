<?php
declare(strict_types=1);

use Marketplace\Cart\Presentation\Web\Action\AddProductToCartAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use function GuzzleHttp\Psr7\stream_for;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        return $response->withBody(stream_for('Hello!'));
    });

    $app->post('/carts/{cart_id}/products', AddProductToCartAction::class);
};
