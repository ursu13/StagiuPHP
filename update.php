<?php


//verifica input.ul inainte de update in baza de date

$sql = 'UPDATE books SET title = ?,author_name=?,publisher_name=?,publish_year=?,updated_at=NOW() 
WHERE id = ?';
$stmt = $conn->prepare($sql);
$stmt->execute(array($_POST['title'], $_POST['author_name'], $_POST['publisher_name'],  $_POST['publish_year'], $_POST['id']));
?>

<html>
<head>
</head>
<body>
<h1>Product edited! </h1>
<a href="/index.php">Go to index</a>
</body>
</html>



