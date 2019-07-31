<?php

namespace App\Controller;

class Controller {

    protected $view;
    protected $container;

    public function __construct(\Slim\Views\PhpRenderer $view, $container)
    {
        $this->view = $view;
        $this->container = $container;
    }

    public function __get($property)
	{
		if ($this->container->{$property}) {
			return $this->container->{$property};
		}
	}
}
