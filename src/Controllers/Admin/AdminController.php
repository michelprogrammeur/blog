<?php
namespace App\Controllers\Admin;


use App\Controllers\Controller;
use App\Helpers\Helpers;


class AdminController
{
    use Helpers;

    public function index() {
        $this->renderView('admin.index');
    }
}