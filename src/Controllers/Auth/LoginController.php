<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Helpers\Helpers;
use App\Models\Auth\Login;

class LoginController
{
    use Helpers;

    public function loginIndex() {
        if(isset($_SESSION['user'])) {
            $this->redirect('/');
        }
        $this->renderView('auth.login');
    }


    public function login() {
        if (!empty($_POST)) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            $result_login = Login::loginUser([
                "email" => $email,
                "password" => $password,
            ]);

            if($result_login === true) {
                if ($_SESSION['user']['role'] === 'visiteur') {
                    $this->redirect('/')->with("login_success", "Vous êtes bien connecté !");;
                }
                elseif ($_SESSION['user']['role'] === 'admin') {
                    $this->redirect('/admin/dashboard')->with("login_success", "Vous êtes bien connecté !");
                }
            }
            else {
                $this->redirect('/login')->with("error_login", "Un des champs renseigné est invalide.");;
            }
        }
    }


    public function logout() {
        session_destroy();
        $this->redirect('/');
    }

}

