<?php

require_once 'config.php';

try {
    $conn = new PDO('mysql:host=' . SERVERNAME . ';dbname=' . DATABASE, USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    header('HTTP/1.1 500 SERVER ERROR');
    exit();
}
function PDOBindArray(&$poStatement, &$paArray)
{
    foreach ($paArray as $k => $v) {

        @$poStatement->bindValue(':' . $k, $v);
    }
}