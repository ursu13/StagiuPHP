<?php

namespace BookStore\service;
use PDO;

class DatabaseConnectionService
{

    public PDO $connection;

    public function __construct()
    {
        require 'src/BookStore/config/config.php';
        $this->connection = new PDO('mysql:host=' . SERVERNAME . ';dbname=' . DATABASE, USERNAME, PASSWORD);

        return $this->connection;
    }


    public function databaseInstance()
    {
        return $this->connection;
    }

    /**
     * Functie care bind-uieste statement-ul la un array asociativ de valori, folosindu-se de adrese
     */
    public static function PDOBindArray(&$statement, &$values)
    {
        foreach ($values as $key => $value) {
            @$statement->bindValue(':' . $key, $value);
        }
    }


}