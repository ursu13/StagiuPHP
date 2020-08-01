<?php

require "functions.php";
require 'service'.DIRECTORY_SEPARATOR.'BookStoreService.php';
require 'repository'.DIRECTORY_SEPARATOR.'BookStoreRepository.php';
require "service/DatabaseConnectionService.php";
require "model" . DIRECTORY_SEPARATOR . "Book.php";
require "model" . DIRECTORY_SEPARATOR . "Author.php";
require "model" . DIRECTORY_SEPARATOR . "Publisher.php";

require "controller" . DIRECTORY_SEPARATOR . "BookStoreController.php";
require "Router.php";

$uri = explode('?', trim($_SERVER['REQUEST_URI'], '/'))[0];

$router = new Router();
$router->setRoutes(require 'routes.php');

try {
    $router->direct($uri);
} catch(Exception $exception) {
    echo $exception;

    require 'view/404.error.php';
}