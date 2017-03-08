<?php

namespace App\Controllers\Auth;

use App\Models\Auth\Register;
use App\Helpers\Helpers;

class RegisterController
{
    use Helpers;

    public function registerIndex() {
        if(isset($_SESSION['user'])) {
            $this->redirect('/');
        }
        $this->renderView('auth.register');
    }

    public function register() {

        if (!empty($_POST)) {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $password_confirm = htmlspecialchars($_POST['password_confirm']);

            $register = Register::registerUser([
                "pseudo" => $pseudo,
                "email" => $email,
                "password" => $password,
                "password_confirm" => $password_confirm
            ]);

            if (isset($register["error_pseudo"]) && $register['error_pseudo'] === true) {
                $this->redirect('/register')->with('error_pseudo', 'Le pseudo ne peut être vide ou il existe déjà, veuillez en choisir un autre');
            }
            if (isset($register["error_email"]) && $register['error_email'] === true) {
                $this->redirect('/register')->with('error_email', 'L\'addresse email choisie est déjà prise ou n\'est pas valide');
            }
            if (isset($register["error_password"]) && $register['error_password'] === true) {
                $this->redirect('/register')->with('error_password', 'Votre mot de passe doit contenir au minimun 8 caractères dont 1 majuscule, 1 minuscule, 1 chiffre et ëtre confirmé.');
            }
            if ($register === true) {
                $this->redirect('/login');
            }
        }
    }
}