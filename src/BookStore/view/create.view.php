<?php
//TODO Custom error messages
namespace BookStore\view;

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
