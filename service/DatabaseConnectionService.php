<?php


class DatabaseConnectionService
{

    public static ?PDO $connection = null;

    public static function databaseInstance()
    {
        require 'config/config.php';
        if (is_null(self::$connection)) {
            self::$connection = new PDO('mysql:host=' . SERVERNAME . ';dbname=' . DATABASE, USERNAME, PASSWORD);
        }

        return self::$connection;
    }

    /**
     * Functie care bind-uieste statement-ul la un array asociativ de valori, folosindu-se de adrese
     */
    public static function PDOBindArray(&$poStatement, &$paArray)
    {
        foreach ($paArray as $k => $v) {
            @$poStatement->bindValue(':' . $k, $v);
        }
    }



}