<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 07/03/17
 * Time: 11:57
 */

namespace App\Models;


class User
{
    public static function changePassword($data, $id) {
        global $connect;

        $old_password = $data['old_password'];
        $new_password = $data['new_password'];
        $new_password_confirm = $data['new_password_confirm'];

        $response = $connect->getPdo()->prepare('SELECT * FROM users WHERE id = :id');
        $response->execute([
            "id" => $id,
        ]);

        $dts = $response->fetch(\PDO::FETCH_OBJ);
        $check_Bdd_password = self::verifyOldPassword($old_password, $dts->password);;

        if($check_Bdd_password) {
            $check_new_password = self::verifyIsPassword($new_password, $new_password_confirm);

            if ($check_new_password) {
                $new_password_hash = self::hashPassword($new_password);

                $response = $connect->getPdo()->prepare('
                    UPDATE users SET password = :password WHERE id = :id
                ');
                $response->execute([
                    "password" => $new_password_hash,
                    "id" => $id
                ]);

                return true;
            } else {

                return false;
            }

        }else {
            return false;
        }
    }

    public static function changeEmail($data, $id) {
        global $connect;

        $old_email = $data['old_email'];
        $new_email = $data['new_email'];

        $response = $connect->getPdo()->prepare('SELECT * FROM users WHERE id = :id');
        $response->execute([
            "id" => $id,
        ]);
        $dts = $response->fetch(\PDO::FETCH_OBJ);

        if($old_email === $dts->email) {
            $check_email = self::verifyEmailExist($new_email);

            if ($check_email) {

                $response = $connect->getPdo()->prepare('
                    UPDATE users SET email = :email WHERE id = :id
                ');
                $response->execute([
                    "email" => $new_email,
                    "id" => $id
                ]);

            } else {

                return false;
            }

        } else {

            return false;
        }
    }

    // Verifie si l'email existe dans la base de données.
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

    // Verifie si l'email est conforme
    private static function verifyIsEmail($field) {
        $regex = '#(?:[A-Z{1}a-z\d]*\@{1}[A-Za-z\d]*\.{1}[A-Za-z\d]+)#i';

        if (empty($field) || !preg_match($regex, $field)) {

            return false;
        }else {

            return true;
        }
    }

    // Vérifie la validité du nouveau password et de sa confirmation
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

    // Vérifie si le mot de passe du champ "old_password" est identique avec celui stoqué en base de données
    private static function verifyOldPassword($password, $password_hash) {
        $password_check = password_verify($password, $password_hash);

        if ($password_check) {

            return true;
        }else {

            return false;
        }
    }

    // Crypte le nouveau password
    private static function hashPassword($password) {
        $hash_password = password_hash($password, PASSWORD_BCRYPT);

        return $hash_password;
    }

}