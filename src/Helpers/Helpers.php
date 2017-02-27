<?php
namespace App\Helpers;

trait Helpers
{
    public function __construct() {

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