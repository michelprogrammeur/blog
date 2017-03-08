<?php

namespace App\Models\Auth;

class Register {

    private static $errors = [];

    public static function registerUser(array $data) {
        global $connect;

        $pseudo = $data['pseudo'];
        $email = $data['email'];
        $password = $data['password'];
        $confirmPassword = $data['password_confirm'];

        $verifiedPseudo = self::verifyPseudoExist($pseudo);
        $verifiedEmail = self::verifyEmailExist($email);
        $verifiedPassword = self::verifyIsPassword($password, $confirmPassword);

        if(!$verifiedPseudo) {
            self::$errors['error_pseudo'] = true;
        }
        if(!$verifiedEmail) {
            self::$errors['error_email'] = true;
        }
        if(!$verifiedPassword) {
            self::$errors['error_password'] = true;
        }
        if($verifiedPseudo && $verifiedEmail && $verifiedPassword) {
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

            return true;
        }else {

            return self::$errors;
        }
    }

    // verification du pseudo
    private static function verifyPseudoExist($field) {
        global $connect;

        $response = $connect->getPdo()->prepare('
            SELECT id FROM users WHERE pseudo = :pseudo');
        $response->execute([
            "pseudo" => $field,
        ]);
        $data = $response->fetch(\PDO::FETCH_OBJ);

        if(!is_null($data->id)) {

            return false;
        }else {
            if(!empty($field)) {
                return true;
            }else {
                return false;
            }
        }
    }

    // Verifi si l'email existe dans la base de données.
    private static function verifyEmailExist($field) {
        global $connect;

        $response = $connect->query("
            SELECT id FROM users WHERE email = :email",
            [ "email" => $field ]
        );
        $data = $response->fetch(\PDO::FETCH_OBJ);
        if (!is_null($data->id)) {

            return false;
        }else {
            $isEmail = self::verifyIsEmail($field);

            return $isEmail;
        }
    }

    // Verifi si l'email est conforme
    private static function verifyIsEmail($field) {
    $regex = '#(?:[A-Z{1}a-z\d]*\@{1}[A-Za-z\d]*\.{1}[A-Za-z\d]+)#i';

        if (empty($field) || !preg_match($regex, $field)) {

            return false;
        }else {

            return true;
        }
    }

    // verifi la condition pour avoir un mot de passe valide
    private static function verifyIsPassword($field, $confirmPassword) {
        $regex = '#^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{7,})\S$#';

        if(preg_match($regex, $field) == 1 && $field == $confirmPassword) {
            // bon
            return true;
        }else {
            // pas bon
            return false;
        }
    }

    // Crypte le mot de passe
    private static function hashPassword($password) {
        $hash_password = password_hash($password, PASSWORD_BCRYPT);

        return $hash_password;
    }

}