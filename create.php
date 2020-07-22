<?php

//aici incerc sa fac sanitize la input, in asa fel incat sa nu ajunga date gresite in DB
//chiar daca request-ul e facut prin postman, si afiseaza in realtime ce este gresit
$titleErr = $authorErr = $publisherErr = $yearErr = '';
$title = $authorName = $publisherName = $publishYear = '';
if (isset($_POST['save'])) {
    if (empty($_POST['title'])) {
        $titleErr = 'Title is required';
    } else {
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    }
    if (empty($_POST['author_name'])) {
        $authorErr = 'Author name is required';
    } else {
        $authorName = filter_var($_POST['author_name'], FILTER_SANITIZE_STRING);
    }
    if (empty($_POST['publisher_name'])) {
        $publisherErr = 'Publisher name is required';
    } else {
        $publisherName = filter_var($_POST['publisher_name'], FILTER_SANITIZE_STRING);
    }
    if (empty($_POST['publish_year'])) {
        $yearErr = 'Publish year is required';
    } else if (is_numeric($_POST['publish_year']) && !is_float($_POST['publish_year']) && intval($_POST['publish_year']) > 1901 && intval($_POST['publish_year']) < 2155) {
        $publishYear = filter_var($_POST['publish_year'], FILTER_SANITIZE_STRING);
    } else {
        $yearErr = 'Publish year is wrong';
    }
    if ($titleErr == '' && $authorErr == '' && $publisherErr == '' && $yearErr == '') {
        require_once 'store.php';
        exit();
    }
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

<form class="form" action="create.php" method="POST">
    <table>

        <tr>
            <td><label>Title:</label></td>
            <td><input type="text" name="title">
                <span class="error">* <?= $titleErr; ?></span><br><br>
            </td>

        </tr>

        <tr>

            <td><label>Author name:</label></td>
            <td><input type="text" name="author_name">
                <span class="error">* <?= $authorErr; ?></span><br><br></td>
        </tr>

        <tr>

            <td><label>Publisher name:</label></td>
            <td><input type="text" name="publisher_name">
                <span class="error">* <?= $publisherErr; ?></span><br><br></td>
        </tr>
        <tr>

            <td><label>Publish year:</label></td>
            <td><input type="text" name="publish_year">
                <span class="error">* <?= $yearErr; ?></span><br><br></td>
        </tr>
        <td>
            <button type="submit" name="save">Save</button>
        </td>


    </table>
</form>
</body>
</html>
