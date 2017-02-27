<?php

namespace App\Controllers;


use App\Helpers\Helpers;

class FrontController
{
    use Helpers;

    public function index() {
        $this->renderView('index');
    }
}