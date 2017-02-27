<?php

namespace App\Controllers;


class Controller
{
    public function __construct() {
        session_start();
    }

    public function renderView($path, array $data = []) {
        extract($data);
        include __DIR__ . '/../../resources/Views/' . str_replace(".", "/", $path) . '.php';
    }

    public function redirect($path) {
        header('Location: '. URL . $path);
        exit();
    }


}