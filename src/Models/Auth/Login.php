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
        $user = $response->fetch(\PDO::FETCH_OBJ);
        $result = self::verifyPassword($data['password'], $user->password);

        if($result) {
            $_SESSION['user']['id'] = $user->id;
            $_SESSION['user']['pseudo'] = $user->pseudo;
            $_SESSION['user']['email'] = $user->email;
            $_SESSION['user']['role'] = $user->role;

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

