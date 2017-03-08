<?php

namespace App\Controllers;


use App\Helpers\Helpers;
use App\Models\User;

class UserController
{
    use Helpers;

    public function show() {
        $this->renderView('user.show');
    }

    public function modificationPassword() {
        $userId = $_SESSION['user']['id'];

        if (!empty($_POST)) {
            $data_post = [
                "old_password" => htmlspecialchars($_POST['old_password']),
                "new_password" => htmlspecialchars($_POST['new_password']),
                "new_password_confirm" => htmlspecialchars($_POST['new_password_confirm'])
            ];

            $check_password = User::changePassword($data_post, $userId);


            if ($check_password) {
                $this->redirect('/account');
            } else {
                $this->redirect('/');
            }
        }
    }

    public function modificationEmail() {

        $userId = $_SESSION['user']['id'];

        if (!empty($_POST)) {
            $data_post = [
                "old_email" => htmlspecialchars($_POST['old_email']),
                "new_email" => htmlspecialchars($_POST['new_email']),
            ];

            $check_email = User::changeEmail($data_post, $userId);

            if ($check_email) {
                $this->redirect('/account');
            } else {
                $this->redirect('/account');
            }
        }
    }
}