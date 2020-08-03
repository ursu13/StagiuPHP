<?php

require_once "vendor/autoload.php";

use BookStore\router\Router;

$uri    = explode('?', trim($_SERVER['REQUEST_URI'], '/'))[0];
$router = new Router(require 'src/BookStore/router/routes.php');

try {
    $router->direct($uri);
} catch (Exception $exception) {
    echo $exception;

    require 'view/404.error.php';
}