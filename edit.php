<?php

require_once 'common.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $sql = 'SELECT * FROM books WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($_GET['id']));
    $books = $stmt->fetch(PDO::FETCH_ASSOC);
}
if (isset($_POST['save'])) {
    require_once 'update.php';
    exit();
}

?>
<html>
<head>
    <style>
        label {
            float: left;
            width: 10em;
            margin-right: 1em;
            text-align: right;
        }
    </style>
</head>
<body>

<form class="form" action="edit.php" method="POST">
    <input type="hidden" name="id" value=<?= $books['id'] ?>><br><br>
    <label>Title:</label>
    <input type="text" name="title" placeholder=<?= $books['title'] ?>><br><br>
    <label>Author name:</label>
    <input type="text" name="author_name" placeholder=<?= $books['author_name'] ?>><br><br>
    <label>Publisher name:</label>
    <input type="text" name="publisher_name" placeholder=<?= $books['publisher_name'] ?>><br><br>
    <label>Publish year:</label>
    <input type="text" name="publish_year" placeholder=<?= $books['publish_year'] ?>><br><br>
    <button type="submit" name="save">Save</button>
</form>


</body>
</html>


