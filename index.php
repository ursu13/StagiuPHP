<?php

require_once 'common.php';

$sql = 'SELECT * FROM books';
$stmt = $conn->prepare($sql);
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
<head>
</head>
<body>
<form class="form" action="index.php" method="POST">
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Author name</th>
            <th>Publisher name</th>
            <th>Publish year</th>
            <th>Created at</th>
            <th>Updated at</th>

        </tr>

        <?php
        foreach ($books as $value): ?>

        <tr>
            <td>
                <?= $value['id']; ?>
            </td>
            <td>
                <?= $value['title']; ?>
            </td>
            <td>
                <?= $value['author_name']; ?>
            </td>
            <td>
                <?= $value['publisher_name']; ?>
            </td>
            <td>
                <?= $value['publish_year']; ?>
            </td>
            <td>
                <?= $value['created_at']; ?>
            </td>
            <td>
                <?= $value['updated_at']; ?>
            </td>
            <td>
                <a href="/edit.php?id=<?= $value['id'] ?>">Edit</a>
                <a href="/delete.php?id=<?= $value['id'] ?>">Delete</a>
            </td>
            <?php endforeach; ?>
        </tr>
    </table>
</form>
<a href="/create.php">Create new book</a>

</body>
</html>


