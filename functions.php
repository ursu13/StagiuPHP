<?php

function loadView(string $viewName, array $parameters = [])
{
    if (!empty($parameters)) {
        extract($parameters);
    }
    require "view" . DIRECTORY_SEPARATOR . $viewName;
}

function dd($parameter)
{
    echo "<pre>";
    var_dump($parameter);
    echo "</pre>";
    die;
}