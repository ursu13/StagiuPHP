<?php

namespace BookStore\service;

class BookStoreService
{
    //TODO Refactoring: Not the greatest code in my life

    /**
     *functie de sanitizare, din prima tema
     */
    public static function sanitizeInput($values)
    {
        if ($values['title'] === '') {
            return false;
        } else {
            $values['title'] = filter_var($values['title'], FILTER_SANITIZE_STRING);
        }
        if ($values['author_name'] === '') {
            return false;
        } else {
            $values['author_name'] = filter_var($values['author_name'], FILTER_SANITIZE_STRING);
        }

        if ($values['publisher_name'] === '') {
            return false;

        } else {
            $values['publisher_name'] = filter_var($values['publisher_name'], FILTER_SANITIZE_STRING);
        }
        if ($values['publish_year'] !== '' && is_numeric($values['publish_year']) && ! is_float($values['publish_year'])) {
            $values['publish_year'] = filter_var($values['publish_year'], FILTER_SANITIZE_STRING);
        } else {
            return false;
        }
            return $values;
    }
}