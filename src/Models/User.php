<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 24/02/17
 * Time: 11:26
 */

namespace App\Models;

class User
{
    // Permet de créer un utilisateur en base de données, à l'inscription.
    public static function registerUser(array $data) {
        global $connect;

        $pseudo = $data['pseudo'];
        $email = $data['email'];
        $hash_password = self::hashPassword($data['password']);

        $connect->query('
            INSERT INTO users(pseudo, email, password) 
            VALUES(:pseudo, :email, :password)',
            ["pseudo" => $pseudo, "email" => $email, "password" => $hash_password]
        );

    }

    // Permet la connexion d'un utilisateur
    public static function loginUser(array $data) {
        global $connect;

        $email = $data['email'];
        $password = $data['password'];

        $response = $connect->query('
            SELECT * FROM users WHERE email = :email',
            ["email" => $email]
        );
        $d = $response->fetch(\PDO::FETCH_OBJ);
        $result = self::verifyPassword($password, $d->password);

        if($result) {
            if(isset($_SESSION['user'])) {
                session_destroy();
                unset($_SESSION['user']);
            }else {
                $_SESSION['user']->pseudo = $d->pseudo;
                $_SESSION['user']->email = $d->email;
                $_SESSION['user']->role = $d->role;
            }

            return true;
        }else {

            return false;
        }
    }

    // Permet de hash le password avec la fonction php "passwor_hash"
    private static function hashPassword($password) {
        $hash_password = password_hash($password, PASSWORD_BCRYPT);

        return $hash_password;
    }

    // Permet de verifier le password
    private static function verifyPassword($password, $password_hash) {
        $password_check = password_verify($password, $password_hash);

        if ($password_check) {

            return true;
        }else {

            return false;
        }
    }


}