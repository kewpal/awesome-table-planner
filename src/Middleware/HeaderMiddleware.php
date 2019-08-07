<?php

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

class HeaderMiddleware extends Middleware
{
    public function __invoke (Request $request, Response $response, callable $next) {
        $renderer = $this->container->get('renderer'); // or maybe its $this->get('renderer');

        $response = $renderer->render($response, 'header.phtml');
        $response = $next($request, $response);

        return $response;
    }
}
