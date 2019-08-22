<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };

    $container['HomeController'] = function($c) {
        $view = $c->get("renderer");
        return new \App\Controller\HomeController($view, $c);
    };

    $container['PlannerController'] = function($c){
        $view = $c->get("renderer");
        return new \App\Controller\PlannerController($view, $c);
    };

    $container['AuthController'] = function($c) {
        $view = $c->get("renderer");
        return new \App\Controller\AuthController($view, $c);
    };
};
