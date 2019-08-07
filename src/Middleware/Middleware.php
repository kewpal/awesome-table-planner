<?php

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

abstract class Middleware
{
    protected $container;

	public function __construct($container)
	{
		$this->container = $container;
    }

    public abstract function __invoke(Request $request, Response $response, callable $next);
}
