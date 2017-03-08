<?php

use App\Middleware\AdminMiddleware;
use App\Controllers\UserController;
use App\Controllers\FrontController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Admin\AdminController;
use App\Controllers\Admin\PostController;
use App\Controllers\CommentController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
$admin = 'admin';

$admin_middleware = new AdminMiddleware();

if($method == 'GET') {
    switch ($uri) {

        case '/blog/':
            $posts = new FrontController();
            $posts->index();
            break;

        // REGISTER ---------
        case preg_match('#\/blog\/register(\/?)$#', $uri) == 1:
            $register = new RegisterController();
            $register->registerIndex();
            break;

        // CONNECTION-----
        case preg_match('#\/blog\/login(\/?)$#', $uri) == 1:
            $login = new LoginController();
            $login->loginIndex();
            break;

        // DECONNECTION-----
        case preg_match('#\/blog\/logout(\/?)$#', $uri) == 1:
            $logout = new LoginController();
            $logout->logout();
            break;

        case preg_match('#\/blog\/post\/([0-9]+)(\/?)$#', $uri, $matches) == 1:
            $logout = new FrontController();
            $logout->showSinglePost($matches[1]);
            break;

        case preg_match('#\/blog\/account$#', $uri) == 1:
            $user = new UserController();
            $user->show();
            break;

        // ADMIN GET ROOTS ------------------
        case preg_match('#\/blog\/' . $admin . '(\/?)$#', $uri) == 1:
            if($admin_middleware) {
                header('Location:' . URL . '/admin/dashboard');
            }
            break;

        case preg_match('#\/blog\/' . $admin . '\/dashboard(\/?)$#', $uri) == 1:
            if($admin_middleware) {
                $login = new AdminController();
                $login->index();
            }
            break;

        case preg_match('#\/blog\/' . $admin . '\/comments$#', $uri) == 1:
            if($admin_middleware) {
                $comments = new CommentController();
                $comments->CommentsReported();
            }
            break;

        // CRUD POSTS
        case preg_match('#\/blog\/' . $admin . '\/posts(\/?)$#', $uri) == 1:
            if($admin_middleware) {
                $posts = new PostController();
                $posts->index();
            }
            break;

        case preg_match('#\/blog\/' . $admin . '\/post\/([0-9]+)(\/?)$#', $uri, $matches) == 1:
            if($admin_middleware) {
                $posts = new PostController();
                $posts->show($matches[1]);
            }
            break;

        case preg_match('#\/blog\/' . $admin . '\/post\/create(\/?)$#', $uri) == 1:
            if($admin_middleware) {
                $posts = new PostController();
                $posts->create();
            }
            break;

        case preg_match('#\/blog\/' . $admin . '\/post\/([0-9]+)\/edit$#', $uri, $matches) == 1:
            if($admin_middleware) {
                $posts = new PostController();
                $posts->edit($matches[1]);
            }
            break;


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

        // ----------- USER POST ROOTS ------------ //
        case preg_match('#\/blog\/account\/email-update$#', $uri) == 1:
            $user = new UserController();
            $user->modificationEmail();
            break;

        case preg_match('#\/blog\/account\/password-update$#', $uri) == 1:
            $user = new UserController();
            $user->modificationPassword();
            break;

        // ----------- ADMIN POST ROOTS ------------ //

        // POSTS
        case preg_match('#\/blog\/'. $admin .'\/post\/store#', $uri) == 1:
            if($admin_middleware) {
                $posts = new PostController();
                $posts->store();
            }
            break;

        case preg_match('#\/blog\/'. $admin .'\/post\/([0-9]+)\/update$#', $uri, $matches) == 1:
            if($admin_middleware) {
                $posts = new PostController();
                $posts->update($matches[1]);
            }
            break;

        case preg_match('#\/blog\/'. $admin .'\/post\/([0-9]+)\/delete$#', $uri, $matches) == 1:
            if($admin_middleware) {
                $posts = new PostController();
                $posts->destroy($matches[1]);
            }
            break;

        // COMMENTS
        case preg_match('#\/blog\/'. $admin .'\/comments#', $uri) == 1:
            if($admin_middleware) {
                $comments = new CommentController();
            }
            break;

        case preg_match('#\/blog\/post\/([0-9]+)\/add$#', $uri, $matches) == 1:
            $comment = new CommentController();
            $comment->add($matches[1], $_POST);
            break;

        case preg_match('#\/blog\/comments\/add\/reply\/([0-9]+)$#', $uri, $matched) == 1 :
            $comments = new CommentController();
            $comments->add($matched[1], $_POST);
            break;

        case preg_match('#\/blog\/comments\/report\/post\/([0-9]+)\/comment\/([0-9]+)$#', $uri, $matches) == 1 :
            $comments = new CommentController();
            $comments->report($matches[1], $matches[2]);
            break;

        case preg_match('#\/blog\/'. $admin .'\/comment\/([0-9]+)\/delete$#', $uri, $matches) == 1:
            if($admin_middleware) {
                $comments = new CommentController();
                $comments->delete($matches[1]);
            }
            break;

        case preg_match('#\/blog\/'. $admin .'\/comment\/([0-9]+)\/restore$#', $uri, $matches) == 1:
            if($admin_middleware) {
                $comments = new CommentController();
                $comments->restore($matches[1]);
            }
            break;
    }
}

