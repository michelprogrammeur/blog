<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Auth\Register;
use App\Models\User;
use App\Validator;

class RegisterController extends Controller
{
    //public $errors = [];

    public function registerIndex() {
        if (!empty($_SESSION['errors'])) {
            session_destroy();
        }
        if(isset($_SESSION['user'])) {
            $this->redirect('/');
        }
        $this->renderView('auth.register');
    }

    public function register() {

        if (!empty($_POST)) {
            $validation = $this->registerValidation($_POST);

            if ($validation === true) {
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                User::registerUser([
                    "pseudo" => $pseudo,
                    "email" => $email,
                    "password" => $password,
                ]);

                $this->redirect('/login');
            }else {
                $_SESSION['errors'] = $validation;

                $this->redirect('/register');
            }
        }
    }

    public function registerValidation($data) {
        $validator = new Validator($data);
        $validator->alphaNum('pseudo', 'Votre pseudo n\'est pas valide, il doit contenier de caractères alphanumériques.');
        if ($validator->valid()) {
            $validator->unique('pseudo', 'users' ,'Ce pseudo est déjà utilisé par un utilisateur.');
        }
        $validator->email('email', 'Votre adresse mail n\'est pas valide.');
        if ($validator->valid()) {
            $validator->unique('email', 'users', 'L\'adresse mail rentrée est déjà utilisée, merci d\'en choisir une autre');
        }
        $validator->password('password', 'Votre mot de passe n\'est pas valide, il doit contenir au minimun 8 caractères dont 1 majuscule, 1 minuscule et 1 chiffre..');

        if ($validator->valid()) {
            return true;
        }else {
            return $validator->returnMessagesErrors();
        }
    }
}