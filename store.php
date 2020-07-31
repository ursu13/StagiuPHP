<?php

require_once 'common.php';
$titleErr = $authorErr = $publisherErr = $yearErr = '';
$title = $authorName = $publisherName = $publishYear = '';
$errors = [0, 0, 0, 0];
if (isset($_POST['save'])) {
    if (empty($_POST['title'])) {
        $errors[0] = 1;
    } else {
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    }
    if (empty($_POST['author_name'])) {
        $errors[1] = 1;
    } else {
        $authorName = filter_var($_POST['author_name'], FILTER_SANITIZE_STRING);
    }
    if (empty($_POST['publisher_name'])) {
        $errors[2] = 1;
    } else {
        $publisherName = filter_var($_POST['publisher_name'], FILTER_SANITIZE_STRING);
    }
    if (empty($_POST['publish_year'])) {
        $yearErr = 'Publish year is required';
        $errors[3] = 1;
    } else {
        if (is_numeric($_POST['publish_year']) && !is_float($_POST['publish_year']) && intval($_POST['publish_year']) > 1901 && intval($_POST['publish_year']) < 2155) {
            $publishYear = filter_var($_POST['publish_year'], FILTER_SANITIZE_STRING);
        } else {
            $errors[3] = 1;
        }
    }
    if ($titleErr == '' && $authorErr == '' && $publisherErr == '' && $yearErr == '') {
        $sql = 'INSERT INTO books(title,author_name,publisher_name,publish_year) VALUES(?,?,?,?)';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$title, $authorName, $publisherName, $publishYear]);
        header('Location: /create.php?errors=0-0-0-0');
        exit();
    } else {
        header('Location: /create.php?errors=' . implode('-', $errors));
    }
}



