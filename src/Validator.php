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
        if (!preg_match('#^[A-Za-z0-9_]+$#', $this->field($field))) {
            $this->errors[$field] = $message;
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
        if (!preg_match('#(?:[A-Z{1}a-z\d]*\@{1}[A-Za-z\d]*\.{1}[A-Za-z\d]+)#i', $this->field($field))) {
            $this->errors[$field] = $message;
        }
    }

    public function password($field, $message) {
        if (empty($this->field($field)) || !preg_match('#^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{8,})\S$#', $this->field($field))) {
            $this->errors[$field] = $message;
        }
    }

    public function valid() {
        return empty($this->errors);
    }

    public function returnMessagesErrors() {
        return $this->errors;
    }
}