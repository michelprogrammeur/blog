<?php
namespace App\Helpers;

trait Helpers
{
    public function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function renderView($path, array $data = []) {
        extract($data);
        include __DIR__ . '/../../resources/Views/' . str_replace(".", "/", $path) . '.php';
    }

    public function redirect($path) {
        header('Location: '. URL . $path);

        return $this;
    }

    protected function with($name, $message) {
        $this->session($name, $message);
    }

    protected function session ($index, $message) {
        $session = $_SESSION['errors'][$index] = $message;

        return $session;
    }

    public function debug($value) {
        echo '<pre>';
        var_dump($value);
        echo '</pre>';
        die;
    }
}