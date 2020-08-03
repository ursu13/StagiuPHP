<?php
namespace BookStore\router;

class Functions{
    public static function loadView(string $viewName, array $parameters = [])
    {
        if (!empty($parameters)) {
            extract($parameters);
        }
        require "src/BookStore/view" . DIRECTORY_SEPARATOR . $viewName;
    }

}

