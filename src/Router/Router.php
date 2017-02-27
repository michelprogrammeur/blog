<?php

use App\Controllers\FrontController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Admin\AdminController;
use App\Middleware\AdminMiddleware;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
$middleware = new AdminMiddleware();
$admin_middleware = $middleware->middleware($_SESSION['user']->role);



if($method == 'GET') {
    switch ($uri) {

        case '/blog/':
            $posts = new FrontController();
            $posts->index();
            break;

        // REGISTER ---------
        case preg_match('#\/blog\/register$#', $uri) == 1:
            $register = new RegisterController();
            $register->registerIndex();
            break;

        // CONNECTION-----
        case preg_match('#\/blog\/login$#', $uri) == 1:
            $login = new LoginController();
            $login->loginIndex();
            break;

        // DECONNECTION-----
        case preg_match('#\/blog\/logout$#', $uri) == 1:
            $logout = new LoginController();
            $logout->logout();
            break;

        case preg_match('#\/blog\/admin\/dashboard$#', $uri) == 1:
            if($admin_middleware) {
                $login = new AdminController();
                $login->index();
            }else {
                header('Location:'. URL);
            }
            break;
        
        /*case preg_match('#\/blog-obj\/post\/([0-9]+)$#', $uri, $matches) == 1:
            $posts = new PostController();
            $posts->show($matches[1]);
            break;

        case preg_match('#\/blog-obj\/post\/create#', $uri) == 1:
            $posts = new PostController();
            $posts->create();
            break;

        case preg_match('#\/blog-obj\/post\/([0-9]+)\/edit$#', $uri, $matches) == 1:
            $posts = new PostController();
            $posts->edit($matches[1]);
            break;
        */

    }
}

if($method == 'POST') {
    switch ($uri) {

        // REGISTER --------
        case preg_match('#\/blog\/register$#', $uri) == 1:
            $register = new RegisterController();
            $register->register();
            break;

        // CONNECTION-----
        case preg_match('#\/blog\/login$#', $uri) == 1:
            $login = new LoginController();
            $login->login();
            break;


        /*case preg_match('#\/blog-obj\/post\/store#', $uri) == 1:
            $posts = new PostController();
            $posts->store();
            break;

        case preg_match('#\/blog-obj\/post\/([0-9]+)\/update$#', $uri, $matches) == 1:
            $posts = new PostController();
            $posts->update($matches[1]);
            break;

        case preg_match('#\/blog-obj\/post\/([0-9]+)\/delete$#', $uri, $matches) == 1:
            $posts = new PostController();
            $posts->destroy($matches[1]);
            break;
        */
    }



}

