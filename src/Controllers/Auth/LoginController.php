<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;

class LoginController extends Controller
{
    public function loginIndex() {
        if (!empty($_SESSION['errors'])) {
            session_destroy();
        }
        if(isset($_SESSION['user'])) {
            $this->redirect('/');
        }
        $this->renderView('auth.login');
    }


    public function login() {
        if (!empty($_POST)) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            $result_login = User::loginUser([
                "email" => $email,
                "password" => $password,
            ]);

            if($result_login) {
                if ($_SESSION['user']->role === 'visiteur') {
                    $this->redirect('/');
                }
                elseif ($_SESSION['user']->role === 'admin') {
                    $this->redirect('/admin/dashboard');
                }
            }
            else {
                $_SESSION['errors']['login'] = "L'un des champs est incorrect.";
                $this->redirect('/login');
            }
        }
    }


    public function logout() {
        session_destroy();
        unset($_SESSION['user']);
        $this->redirect('/');
    }

}

