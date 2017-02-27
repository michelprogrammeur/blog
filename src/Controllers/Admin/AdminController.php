<?php
namespace App\Controllers\Admin;


use App\Controllers\Controller;

class AdminController extends Controller
{
    public function index() {
        $this->renderView('admin.index');
    }
}