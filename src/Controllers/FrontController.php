<?php

namespace App\Controllers;


class FrontController extends Controller
{
    public function index() {
        $this->renderView('index');
    }
}