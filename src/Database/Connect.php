<?php

namespace App\Database;

class Connect {

    private $host;
    private $dbname;
    private $login;
    private $password;

    public function __construct($host, $name, $login, $password) {
        $this->host = $host;
        $this->dbname = $name;
        $this->login = $login;
        $this->password = $password;
    }

    public function getPdo() {
        try {
            $database = new \PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->login, $this->password
            );
        }catch (\Exception $exception) {
            die('Erreur' . $exception->getMessage());
        }

        return $database;
    }

}