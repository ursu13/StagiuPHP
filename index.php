<?php

require_once 'common.php';
//in loc sa verific daca sunt setate campurile, verific daca sunt setate butoanele
if (isset($_POST['edit'])) {
    header('Location: edit.php?id='.$_POST['edit']);
    exit();
}
if (isset($_POST['delete'])) {
    require_once 'delete.php';
}

//in cazul in care nu este niciun buton apasat, face query
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
        //ca si best practice, in partea de view am folosit sintaxa alternativa de php, si in loc de echo am
        //am folosit operatorul echivalent <?=
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
                <button type="submit" name="edit" value=<?= $value['id'] ?>>Edit</button>
                <button type="submit" name="delete" value=<?= $value['id'] ?>>Delete</button>
            </td>
            <?php endforeach; ?>
        </tr>
    </table>
</form>
<a href="/create.php">Create new book</a>

</body>
</html>


