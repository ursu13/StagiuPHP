<?php
//TODO Custom error messages
//if (isset($_GET['errors'])) {
//
//    $errorMessages = [
//        0 => "Title required",
//        1 => 'Author required',
//        2 => 'Publisher required',
//        3 => 'Publish year required'
//    ];
//    if ($_GET['errors'] == '0-0-0-0') {
//        echo "Book created !";
//    }
//
//    $errors = explode('-', $_GET['errors']);
//    foreach ($errorMessages as $key => $value) {
//        if ($errors[$key] == 1) {
//            echo $errorMessages[$key] . '<br>';
//        }
//    }
//}

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

<form class="form" action="/store" method="POST">
    <table>

        <tr>
            <td><label>Title:</label></td>
            <td><input type="text" name="title">
            </td>

        </tr>

        <tr>

            <td><label>Author name:</label></td>
            <td><input type="text" name="author_name">
        </tr>

        <tr>

            <td><label>Publisher name:</label></td>
            <td><input type="text" name="publisher_name">
        </tr>
        <tr>

            <td><label>Publish year:</label></td>
            <td><input type="text" name="publish_year">
        </tr>
        <td>
            <button type="submit" name="save">Save</button>
        </td>


    </table>
</form>
<a href="/">Go to index</a>
</body>
</html>
