<?php

require_once 'common.php';

//verifica input.ul inainte de update in baza de date

$sql = 'UPDATE books SET title = :title,author_name=:author_name,publisher_name=:publisher_name
,publish_year=:publish_year,updated_at=NOW() 
WHERE id = :id';
$stmt = $conn->prepare($sql);
$values = [
    'id' => $_POST['id'],
    'title' => $_POST['title'],
    'author_name' => $_POST['author_name'],
    'publisher_name' => $_POST['publisher_name'],
    'publish_year' => $_POST['publish_year']
];

PDOBindArray($stmt, $values);
$stmt->execute();

header('Location: /index.php');
exit();



