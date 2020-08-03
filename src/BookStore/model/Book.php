<?php

namespace BookStore\model;

class Book
{
    public int $id;
    public int $author_id;
    public string $title;
    public string $author_name;
    public string $publisher_name;
    public int $publish_year;
    public string $created_at;
    public ?string $updated_at;

    public Author $author;
    public Publisher $publisher;


}