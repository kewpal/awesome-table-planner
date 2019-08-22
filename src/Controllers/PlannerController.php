<?php

namespace App\Controller;

class PlannerController extends Controller {

    public function index($request, $response, $args)
    {
        return $this->view->render($response, 'planner/index.phtml', ["data" => ""]);
    }

    public function test($request, $response, $args)
    {
        $body = $request->getParsedBody();
        $values = [];

        foreach ($body as $key => $value){
            $values[] = $value;
        }
        return  print_r($values);
    }
}
