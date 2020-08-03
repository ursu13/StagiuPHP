
<?php

if(isset($_GET['success'])){
    echo '<script type="text/javascript">';
    echo ' alert("'.(string)$_GET['success'].'")';  //not showing an alert box.
    echo '</script>';
}
if(isset($_GET['error'])){
    echo '<script type="text/javascript">';
    echo ' alert("'.(string)$_GET['error'].'")';  //not showing an alert box.
    echo '</script>';
}

?>



<html>
<head>
</head>
<body>
<form class="form" action="index.view.php" method="POST">
    <table border="1">
        <tr>
            <th>Book id</th>
            <th>Author id</th>

            <th>Title</th>
            <th>Author name</th>
            <th>Publisher name</th>
            <th>Publish year</th>
            <th>Created at</th>
            <th>Updated at</th>

        </tr>

        <?php
        foreach ($books as $book): ?>

        <tr>
            <td>
                <?= $book->id; ?>
            </td>
            <td>
                <?= $book->author_id; ?>
            </td>
            <td>
                <?= $book->title; ?>
            </td>
            <td>
                <?= $book->author_name; ?>
            </td>
            <td>
                <?= $book->publisher_name; ?>
            </td>
            <td>
                <?= $book->publish_year; ?>
            </td>
            <td>
                <?= $book->created_at; ?>
            </td>
            <td>
                <?= $book->updated_at; ?>
            </td>
            <td>
                <a href="/edit?id=<?= $book->id ?>">Edit</a>
                <a href="/delete?id=<?= $book->id ?>">Delete</a>
            </td>
            <?php endforeach; ?>
        </tr>
    </table>
</form>
<a href="/create">Create new book</a>


</body>
</html>


