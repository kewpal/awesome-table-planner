<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Middleware\HeaderMiddleware;


return function (App $app) {
    $container = $app->getContainer();

    // $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
    //     // Sample log message
    //     $container->get('logger')->info("Slim-Skeleton '/' route");

    //     // Render index view
    //     return $container->get('renderer')->render($response, 'index.phtml', $args);
    // });

    $app->get('/', \HomeController::class . ':home')->setName('home')->add(new HeaderMiddleware($container));

    $app->group("/", function(App $app){
        $app->get('getting-started', \HomeController::class . ':gettingStarted');
    })->add(new HeaderMiddleware($container));


    $app->group("/planner", function(App $app){
        $app->get('', \PlannerController::class . ':index');

        $app->post('/test', \PlannerController::class . ':test');
    });
};
