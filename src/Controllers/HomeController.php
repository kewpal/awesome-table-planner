<?php

namespace App\Controller;

class HomeController extends Controller {

    public function home($request, $response, $args)
    {
        return $this->view->render($response, 'home/index.phtml', ["data" => ""]);
    }
}
