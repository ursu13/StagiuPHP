<?php

$sql = 'DELETE FROM books WHERE id = ?';
$stmt = $conn->prepare($sql);
$stmt->execute(array($_POST['delete']));
//face redirect la index,dupa delete
header('Location: index.php');
exit();