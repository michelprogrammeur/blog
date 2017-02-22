<?php

namespace App\Models\Auth;

class Register {

    public static function registerUser(array $data) {
        global $connect;

        $pseudo = $data['pseudo'];
        $email = $data['email'];
        $hash_password = self::hashPassword($data['password']);

        $response = $connect->getPdo()->prepare('
            INSERT INTO users(pseudo, email, password) 
            VALUES(:pseudo, :email, :password)
        ');
        $response->execute([
            "pseudo" => $pseudo,
            "email" => $email,
            "password" => $hash_password,
        ]);
    }

    private static function hashPassword($password) {
        $hash_password = password_hash($password, PASSWORD_BCRYPT);

        return $hash_password;
    }


}