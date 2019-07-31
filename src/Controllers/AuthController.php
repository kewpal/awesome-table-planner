<?php

namespace App\Controller;

class AuthController extends Controller {

    public function signin($request, $response, $args)
    {
        return $this->view->render($response, 'home/signin.phtml', ["data" => ""]);
    }

    public function signout($request, $response, $args)
    {
        $this->auth->logout();
        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function postSignIn($request, $response)
	{
		$auth = $this->auth->attempt(
			$request->getParam('email'),
			$request->getParam('password')
        );

		if (!$auth) {
			// $this->flash->addMessage('error', 'Could not sign you in with those details');
			return $response->withRedirect($this->router->pathFor('auth.signin'));
        }

		return $response->withRedirect($this->router->pathFor('restricted'));
	}

}
