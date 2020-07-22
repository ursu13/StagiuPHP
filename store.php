<?php

require_once 'common.php';
//folosesc param binding ptr sql
$sql = 'INSERT INTO books(title,author_name,publisher_name,publish_year) 
VALUES(?,?,?,?)';
$stmt = $conn->prepare($sql);
$stmt->execute(array($title, $authorName, $publisherName, $publishYear));
if (!$stmt) {
    header('Location: create.php');
    exit();
}
?>

<html>
<head>
</head>
<body>
<h1>Product created! </h1>
<a href="/index.php">Go to index</a>
</body>
</html>


