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
<form class="form" action="/update" method="POST">
    <input type="hidden" name="id" value=<?= $book->id ?>><br><br>
    <label>Title:</label>
    <input type="text" name="title" placeholder=<?= $book->title ?>><br><br>
    <label>Author name:</label>
    <input type="text" name="author_name" placeholder=<?= $book->author_name ?>><br><br>
    <label>Publisher name:</label>
    <input type="text" name="publisher_name" placeholder=<?= $book->publisher_name ?>><br><br>
    <label>Publish year:</label>
    <input type="text" name="publish_year" placeholder=<?= $book->publish_year ?>><br><br>
    <button type="submit" name="save">Save</button>
</form>
</body>
</html>


