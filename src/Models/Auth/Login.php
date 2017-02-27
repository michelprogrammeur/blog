<?php

namespace App\Models\Auth;

class Login
{

    public static function loginUser(array $data) {
        global $connect;

        $response = $connect->getPdo()->prepare('SELECT * FROM users WHERE email = :email');
        $response->execute([
            "email" => $data['email'],
        ]);
        $d = $response->fetch(\PDO::FETCH_OBJ);
        $result = self::verifyPassword($data['password'], $d->password);

        if($result) {
            $response = $connect->getPdo()->prepare('SELECT id, pseudo, email, role FROM users WHERE email = :email');
            $response->execute([
                "email" => $d->email,
            ]);
            $user = $response->fetch(\PDO::FETCH_OBJ);

            if (isset($_SESSION['user'])) {
                session_destroy();
                unset($_SESSION['user']);
            }else {
                $_SESSION['user'] = $user;
            }
            return true;
        }else {

            return false;
        }
    }


    private static function verifyPassword($password, $password_hash) {
        $password_check = password_verify($password, $password_hash);

        if ($password_check) {

            return true;
        }else {

            return false;
        }
    }
}

