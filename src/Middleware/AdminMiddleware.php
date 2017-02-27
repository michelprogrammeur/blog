<?php

namespace App\Middleware;


class AdminMiddleware
{
    public function middleware($sessionRole) {
        if($sessionRole === 'admin') {

            return true;
        }else {

            return false;
        }
    }
}