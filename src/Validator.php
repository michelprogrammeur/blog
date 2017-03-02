<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 21/02/17
 * Time: 17:34
 */

namespace App;


class Validator
{
    private $data;
    private $errors;

    public function  __construct($data)
    {
        $this->data = $data;
    }

    private function field($field) {
        if(!isset($this->data[$field])) {
           return null;
        }
        return $this->data[$field];
    }

    public function alphaNum($field, $message) {
        $regex = '#^[A-Za-z0-9_]+$#';

        if (!preg_match($regex, $this->field($field))) {
            $this->errors[$field] = $message;
        }
    }

    public function min($field, $numeric, $message) {
        if ($this->field($field) < $numeric) {
            $this->errors[$field . 'Min'] = $message;
        }
    }

    public function unique($field, $table, $message) {
        global $connect;

        $response = $connect->getPdo()->prepare("
            SELECT id FROM $table WHERE $field = :field
        ");
        $response->execute([
            "field" => $this->field($field)
        ]);
        $data = $response->fetch(\PDO::FETCH_OBJ);
        if ($data) {
            $this->errors[$field] = $message;
        }
    }

    public function email($field, $message) {
        $regex = '#(?:[A-Z{1}a-z\d]*\@{1}[A-Za-z\d]*\.{1}[A-Za-z\d]+)#i';

        if (!preg_match($regex, $this->field($field))) {
            $this->errors[$field] = $message;
        }
    }

    public function password($field, $message) {
        $regex = '#^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{7,})\S$#';

        if (empty($this->field($field)) || !preg_match($regex, $this->field($field))) {
            $this->errors[$field] = $message;
        }
    }

    public function password_confirm($field, $suffix, $message) {
        $value = $this->field($field);
        if (empty($value) || $value != $this->field($field . '_confirm')) {
            $this->errors[$field . $suffix] = $message;
        }
    }

    public function valid() {
        return empty($this->errors);
    }

    public function returnMessagesErrors() {
        return $this->errors;
    }
}