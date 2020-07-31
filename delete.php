<?php

require_once 'common.php';

$sql = 'DELETE FROM books WHERE id = ?';
$stmt = $conn->prepare($sql);
$stmt->execute([$_GET['id']]);

header('Location: /index.php');
exit();