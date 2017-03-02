<?php

namespace App\Middleware;


use App\Helpers\Helpers;

class AdminMiddleware
{
    use Helpers;

    public function middleware() {
        if($_SESSION['user']['role'] === 'admin') {

            return true;
        }else {
            $this->redirect('/');

            return false;
        }
    }
}